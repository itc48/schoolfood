<?php

namespace App\Repositories;


use App\Models\Review;
use App\Models\School;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardRepository extends CoreRepository {

    private $model;

    public function __construct() {
        $this->model = new School();
    }

    protected function getModel() {
        return $this->model;
    }

    // 1
    public function getEveryDayCount(Request $request) {
        $reviews = $this->prepareReviewsQuery($request);

        if ($uuid = $request->school_uuid) {
            $reviews->whereSchoolUuid($uuid);
        }

        return $this->associateDates($reviews->get(), $request);
    }

    // 2
    public function getEverydayNegativeCount(Request $request) {
        $reviews = $this->prepareReviewsQuery($request)->whereScore(-1);

        if ($uuid = $request->school_uuid) {
            $reviews->whereSchoolUuid($uuid);
        }

        return $this->associateDates($reviews->get(), $request);
    }

    // 3
    public function getSchoolPositiveCount(Request $request) {
        if ($uuid = $request->school_uuid) {
            $schools = $this->getModel()->forAdmin()->findByUuid($uuid)->get();
        } else {
            $schools = $this->getAllForAdmin();
        }

        return $this->associateSchoolsPositiveCount($schools);
    }


    // 4
    public function getSchoolsCount() {
        $schools = $this->getAllForAdmin();

        return [
            [
                'Общее количество школ'
            ],
            [
                $schools->count()
            ]
        ];
    }


    // 5
    public function getSchoolsSummaryCount(Request $request) {
        if ($uuid = $request->school_uuid) {
            $schools = $this->getModel()->forAdmin()->findByUuid($uuid)->get();
        } else {
            $schools = $this->getAllForAdmin();
        }

        return $this->associateSchoolsSummary($schools);
    }

    // 6
    public function getEverydayPositiveNegativeCount(Request $request) {
        $reviews = $this->prepareReviewsQuery($request);

        $reviews->select(
            DB::raw('date("created_at")'),
            DB::raw('count("created_at")'),
            DB::raw('count("score") filter (where score = 1) as positive_count'),
            DB::raw('count("score") filter (where score = -1) as negative_count')
        );

        if ($uuid = $request->school_uuid) {
            $reviews->whereSchoolUuid($uuid);
        }

        return $this->associateDatesPositiveNegative($reviews->get(), $request);
    }

    // 7
    public function getSchoolsPositiveNegativeCount(Request $request) {
        //        $reviews = $this->prepareReviewsQuery($request);

        $reviews = Review::select(
            'school_uuid',
            DB::raw('count("school_uuid")'),
            DB::raw('count("score") filter (where score = 1) as positive_count'),
            DB::raw('count("score") filter (where score = -1) as negative_count')
        )->where('created_at', '>=', $request->start)->where('created_at', '<=', $request->stop)
            ->orderBy('negative_count', 'DESC')
            ->groupBy('school_uuid');

        if ($uuid = $request->school_uuid) {
            $reviews->whereSchoolUuid($uuid);
        }

        return $this->associateSchoolsPositiveNegative($reviews->get(), $request);
    }

    private function prepareReviewsQuery(Request $request) {
        return Review::select(DB::raw('date("created_at")'), DB::raw('count("created_at")'))
            ->where('created_at', '>=', $request->start)
            ->where('created_at', '<=', $request->stop)
            ->groupBy(DB::raw('date("created_at")'));
    }

    private function associateDates(Collection $reviews, Request $request) {
        $list = [
            [], []
        ];

        $reviewsDates = array_column($reviews->toArray(), 'date');

        $period = new \DatePeriod(
            new \DateTime($request->start),
            new \DateInterval('P1D'),
            new \DateTime($request->stop)
        );

        foreach ($period as $key => $value) {
            $date = $value->format('Y-m-d');
            $list[0][] = $date;
            if (($index = array_search($date, $reviewsDates)) !== false) {
                $list[1][] = $reviews[$index]->count;
            } else {
                $list[1][] = 0;
            }
        }

        return $list;
    }

    private function associateSchoolsPositiveNegative(Collection $reviews, Request $request) {
        $list = [
            [], [], [], []
        ];

        foreach ($reviews as $review) {
            $list[0][] = $review->school['title'];
            $list[1][] = $review->school_uuid;
            $list[2][] = $review->negative_count;
            $list[3][] = $review->positive_count;
            $list[4][] = $review->count;
        }

        return $list;
    }

    private function associateDatesPositiveNegative(Collection $reviews, Request $request) {
        $list = [
            [], [], [], []
        ];

        $reviewsDates = array_column($reviews->toArray(), 'date');

        $period = new \DatePeriod(
            new \DateTime($request->start),
            new \DateInterval('P1D'),
            new \DateTime($request->stop)
        );

        foreach ($period as $key => $value) {
            $date = $value->format('Y-m-d');
            $list[0][] = $date;
            if (($index = array_search($date, $reviewsDates)) !== false) {
                $list[1][] = $reviews[$index]->negative_count;
                $list[2][] = $reviews[$index]->positive_count;
                $list[3][] = $reviews[$index]->count;
            } else {
                $list[1][] = 0;
                $list[2][] = 0;
                $list[3][] = 0;
            }
        }

        return $list;
    }

    private function associateSchoolsPositiveCount($schools) {
        $list = [
            [], []
        ];

        foreach ($schools as $school) {
            $list[0][] = $school->title;
            $list[1][] = $school->reviewsPositive->count();
        }

        return $list;
    }

    private function associateSchoolsSummary($schools) {
        $list = [
            [], []
        ];

        foreach ($schools as $school) {
            $list[0][] = $school->title;
            $list[1][] = $school->reviewsSum();
        }

        return $list;
    }
}
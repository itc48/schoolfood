<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ReviewsExport;
use App\Exports\SchoolsUsersExport;
use App\Http\Controllers\Controller;
use App\Repositories\DistrictRepository;
use App\Repositories\ReviewRepository;
use App\Repositories\SchoolRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ReviewController extends Controller {

    protected $repository;

    protected $school_repository;

    protected $district_repository;

    public function __construct() {
        $this->repository = new ReviewRepository();
        $this->school_repository = new SchoolRepository();
        $this->district_repository = new DistrictRepository();
    }


    public function index(Request $request) {
        if (is_null($request->dateStart) && is_null($request->dateEnd)) {
            $request->merge([
                'dateStart' => Carbon::now()->subDays(3),//->format('Y-m-d H:i:s'),
                'dateEnd' => Carbon::now()->addDay()//->format('Y-m-d H:i:s')
            ]);
        }
        $schools = $this->school_repository->getAllForAdmin();
        $districts = $this->district_repository->getAllForAdmin();
        $reviews = $this->repository->getFilteredForAdmin($request);
        $meta = [
            'school' => $request->school,
            'district' => $request->district,
            'score' => $request->score,
            'dateStart' => $request->dateStart,
            'dateEnd' => $request->dateEnd,
        ];

        $positive = $reviews->filter(function ($review) {
            return $review->score > 0;
        });

        $negative = $reviews->filter(function ($review) {
            return $review->score < 0;
        });

        return view('admin.review.index', compact('meta', 'schools', 'districts', 'reviews', 'positive', 'negative'));
    }

    public function export(Request $request) {
        $export = new ReviewsExport();
        $export->reviews = $this->repository->getFilteredForAdmin($request)->map(function ($review) {
            return [
                $review->created_at['date'],
                $review->created_at['time'],
                $review->district_title,
                $review->school_title,
                $review->text,
                $review->score
            ];
        })->toArray();

        array_unshift($export->reviews, [
            'Дата', 'Время', 'Район', 'Школа', 'Текст', 'Оценка'
        ]);

        array_push($export->reviews, [
            'Количество оценок:', count($export->reviews) - 1
        ]);

        Excel::store($export, 'Отчёт по отзывам.xlsx');

        return Excel::download($export, 'Отчёт по отзывам.xlsx');
    }

}

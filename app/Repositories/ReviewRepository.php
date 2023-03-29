<?php

namespace App\Repositories;


use App\Models\Review;
use App\Models\School;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReviewRepository extends CoreRepository {

    private $model;

    public function __construct() {
        $this->model = new Review();
    }

    protected function getModel() {
        return $this->model;
    }

    public function getLastByFingerprint(string $fingerprint) {
        $next_day = Carbon::now();
        //$next_day = $next_day->addDays(1);
        $next_day = $next_day->setHours(0);
        $next_day = $next_day->setMinutes(0);
        $next_day = $next_day->setSeconds(0);

        return $this
            ->getModel()
            ->whereFingerprint($fingerprint)
            ->where('created_at', '>', $next_day)
            ->orderBy('created_at', 'DESC')
            ->first();
    }

    public function getFilteredForModerator(Request $request) {
        $query = $this->getModel()
            ->selectRaw('reviews.*, schools.title as school_title, districts.title as district_title')
            ->leftJoin('schools', 'reviews.school_uuid', '=', 'schools.uuid')
            ->leftJoin('districts', 'schools.district_id', '=', 'districts.id')
            ->orderBy('created_at', 'DESC');

        if ($request->has('school') && $request->school !== 'null') {
            $query = $query->whereSchoolUuid($request->school);
        }

        if ($request->has('score') && $request->score !== 'null') {
            $query = $query->whereScore($request->score);
        }

        if ($request->has('district') && $request->district !== 'null') {
            $query = $query->whereDistrictId($request->district);
        }

        if ($request->has('dateStart') && $request->has('dateEnd') && $request->dateStart !== 'null' && $request->dateEnd !== 'null' && !is_null($request->dateStart) && !is_null($request->dateEnd)) {
            $query = $query->whereBetween('reviews.created_at', [date($request->dateStart), date($request->dateEnd)]);
        }

        return $query->get();
    }

    public function getFilteredForAdmin(Request $request) {
        $query = $this->getModel()
            ->selectRaw('reviews.*, schools.title as school_title, districts.title as district_title')
            ->leftJoin('schools', 'reviews.school_uuid', '=', 'schools.uuid')
            ->leftJoin('districts', 'schools.district_id', '=', 'districts.id')
            ->orderBy('created_at', 'DESC');

        if ($request->has('school') && $request->school !== 'null') {
            $query = $query->whereSchoolUuid($request->school);
        }

        if ($request->has('score') && $request->score !== 'null') {
            $query = $query->whereScore($request->score);
        }

        if ($request->has('district') && $request->district !== 'null') {
            $query = $query->whereDistrictId($request->district);
        }

        if ($request->has('dateStart') && $request->has('dateEnd') && $request->dateStart !== 'null' && $request->dateEnd !== 'null' && !is_null($request->dateStart) && !is_null($request->dateEnd)) {
            $query = $query->whereBetween('reviews.created_at', [date($request->dateStart), date($request->dateEnd)]);
        }

        return $query->get();
    }

}
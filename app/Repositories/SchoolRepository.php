<?php

namespace App\Repositories;


use App\Models\School;
use Illuminate\Support\Facades\Auth;

class SchoolRepository extends CoreRepository {

    private $model;

    public function __construct() {
        $this->model = new School();
    }

    protected function getModel() {
        return $this->model;
    }

    public function getAllForModerator() {
        $query_builder = $this->getModel()
            ->forAdmin()
            ->whereNotNull('district_id')
            ->whereDistrictId(Auth::user()->district_id)
            ->orderBy('created_at', 'DESC')
            ->get();

        return $query_builder;
    }

    public function getAllForSchoolchildren() {
        $query_builder = $this->getModel()
            ->forAdmin()
            ->whereUuid(Auth::user()->school_uuid)
            ->orderBy('created_at', 'DESC')
            ->get();

        return $query_builder;
    }

    public function getAllForAdminFiltered($request) {
        $query_builder = $this->getModel()
            ->forAdmin()
            ->orderBy('created_at', 'DESC');

        if ($request->has('district') && $request->district !== 'null') {
            $query_builder = $query_builder->whereDistrictId($request->district);
        }

        return $query_builder->get();
    }

}
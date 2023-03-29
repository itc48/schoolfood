<?php

namespace App\Repositories;


use App\Models\District;
use Illuminate\Support\Facades\Auth;

class DistrictRepository extends CoreRepository {

    private $model;

    public function __construct() {
        $this->model = new District();
    }

    protected function getModel() {
        return $this->model;
    }

    public function getAllForModerator() {
        $query_builder = $this->getModel()
            ->forAdmin()
            ->whereId(Auth::user()->district_id)
            ->orderBy('created_at', 'DESC')
            ->get();

        return $query_builder;
    }
}
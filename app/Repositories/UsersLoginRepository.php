<?php

namespace App\Repositories;


use App\Models\Review;
use App\Models\School;
use App\Models\UsersLogin;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UsersLoginRepository extends CoreRepository {

    private $model;

    public function __construct() {
        $this->model = new UsersLogin();
    }

    protected function getModel() {
        return $this->model;
    }

    public function getAllByLastDay() {
        return $this->getModel()->where('created_at', '>=', Carbon::now()->subDay())->orderBy('id', 'DESC')->get();
    }

    public function getUniqueByLastDay($request) {
        $query = $this->getModel();

        if (!is_null($request->date_from) && !is_null($request->date_to)) {
            $query = $query
                ->where('created_at', '>=', $request->date_from)
                ->where('created_at', '<=', $request->date_to);
        } else {
            $query = $query->where('created_at', '>=', Carbon::now()->subDay());
        }

        return $query->distinct('user_id')
            ->get();
    }

}
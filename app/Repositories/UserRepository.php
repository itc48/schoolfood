<?php

namespace App\Repositories;


use App\Models\User;

class UserRepository extends CoreRepository {

    private $model;

    public function __construct() {
        $this->model = new User();
    }

    protected function getModel() {
        return $this->model;
    }

}
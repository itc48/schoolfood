<?php

namespace App\Repositories;


use App\Models\UserRole;

class UserRoleRepository extends CoreRepository {

    private $model;

    public function __construct() {
        $this->model = new UserRole();
    }

    protected function getModel() {
        return $this->model;
    }

}
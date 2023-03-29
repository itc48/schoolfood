<?php

namespace App\Builders;


use App\Models\UsersLogin;

class UsersLoginBuilder extends CoreBuilder {

    public function createEmpty(): CoreBuilder {
        $this->model = new UsersLogin();

        return $this;
    }

}
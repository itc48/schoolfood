<?php

namespace App\Builders;


use App\Models\User;

class UserBuilder extends CoreBuilder {

    public function createEmpty(): CoreBuilder {
        $this->model = new User();

        return $this;
    }

    public function setPassword(string $password) {
        $this->model->password = bcrypt($password);

        return $this;
    }

    public function setSchoolUuid(string $school_uuid = null) {
        $this->model->school_uuid = $school_uuid;

        return $this;
    }

}
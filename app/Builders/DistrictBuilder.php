<?php

namespace App\Builders;


use App\Models\District;

class DistrictBuilder extends CoreBuilder {

    public function createEmpty(): CoreBuilder {
        $this->model = new District();

        return $this;
    }

}
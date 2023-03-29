<?php

namespace App\Builders;


use App\Models\ReviewLog;

class ReviewLogBuilder extends CoreBuilder {

    public function createEmpty(): CoreBuilder {
        $this->model = new ReviewLog();

        return $this;
    }

}
<?php

namespace App\Builders;


use App\Models\School;

class SchoolBuilder extends CoreBuilder {

    public function createEmpty(): CoreBuilder {
        $this->model = new School();

        return $this;
    }

    public function setLatitudeFromExcel($latitude): CoreBuilder {
        $this->model->latitude = $this->convertDoubleFormExcel($latitude);

        return $this;
    }

    public function setLongitudeFromExcel($longitude): CoreBuilder {
        $this->model->longitude = $this->convertDoubleFormExcel($longitude);

        return $this;
    }

    private function convertDoubleFormExcel($double) {
        return floatval(mb_substr(join(".", explode(",", $double)), 0, 9));
    }

    public function setStatus($status): CoreBuilder {
        if (!is_null($status)) {
            $this->model->status = $status === 'юридическое лицо' ? 'JURIDICAL' : 'GENERAL_EDUCATIONAL';
        } else {
            $this->model->status = null;
        }

        return $this;
    }

}
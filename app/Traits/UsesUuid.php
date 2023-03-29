<?php

namespace App\Traits;


use Illuminate\Support\Str;

trait UsesUuid {

    protected static function bootUsesUuid() {
        static::creating(function ($model) {
            if (!$model->getKey() && $model->getKeyName() === 'uuid') {
                $model->uuid = (string)Str::uuid();
            }
        });
    }


    public function getIncrementing() {
        return false;
    }


    public function getKeyType() {
        return 'string';
    }

}
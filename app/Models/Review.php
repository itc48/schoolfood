<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends CoreModel {

    private static $public_fields = [];

    private static $admin_fields = ['uuid', 'school_uuid', 'text', 'file', 'fingerprint', 'score', 'created_at', 'updated_at'];

    public function getCreatedAtAttribute($value) {
        $new_date = strtotime($value);

        return [
            'date' => date('d.m.Y', $new_date),
            'time' => date('H:i:s', $new_date),
        ];
    }

    public function school() {
        return $this->hasOne('App\Models\School', 'uuid', 'school_uuid');
    }

    public static function getPublicFields() {
        return self::$public_fields;
    }

    public static function getAdminFields() {
        return array_merge(self::$public_fields, self::$admin_fields);
    }

}
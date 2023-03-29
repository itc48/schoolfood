<?php

namespace App\Models;


class ReviewLog extends CoreModel {

    private static $public_fields = [];

    private static $admin_fields = [];

    protected $primaryKey = 'id';

    public $timestamps = false;

    public static function getPublicFields() {
        return self::$public_fields;
    }

    public static function getAdminFields() {
        return array_merge(self::$public_fields, self::$admin_fields);
    }


}

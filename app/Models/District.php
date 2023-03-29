<?php

namespace App\Models;


class District extends CoreModel {

    private static $public_fields = [];

    private static $admin_fields = ['id', 'title'];

    protected $primaryKey = 'id';

    public static function getPublicFields() {
        return self::$public_fields;
    }

    public static function getAdminFields() {
        return array_merge(self::$public_fields, self::$admin_fields);
    }


}

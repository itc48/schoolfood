<?php

namespace App\Models;


class UserRole extends CoreModel {

    private static $public_fields = [];

    private static $admin_fields = ['id', 'code'];


    public static function getPublicFields() {
        return self::$public_fields;
    }

    public static function getAdminFields() {
        return array_merge(self::$public_fields, self::$admin_fields);
    }


}

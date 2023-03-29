<?php

namespace App\Models;


class UsersLogin extends CoreModel {

    private static $public_fields = [];

    private static $admin_fields = ['id', 'user_id', 'created_at'];

    protected $primaryKey = 'id';

    protected $table = 'users_login';

    public static function getPublicFields() {
        return self::$public_fields;
    }

    public static function getAdminFields() {
        return array_merge(self::$public_fields, self::$admin_fields);
    }

    public function getCreatedAtAttribute($value) {
        $new_date = strtotime($value);

        return [
            'date' => date('d.m.Y', $new_date),
            'time' => date('H:i:s', $new_date),
        ];
    }

    public function user() {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }

}

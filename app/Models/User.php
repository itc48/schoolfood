<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Notifications\Notifiable;

class User extends CoreModel implements
    AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract {

    use Notifiable, Authenticatable, Authorizable, CanResetPassword, MustVerifyEmail;

    protected $fillable = ['name', 'password', 'role_id', 'district_id', 'school_uuid'];

    protected $hidden = ['password'];

    private static $public_fields = [];

    private static $admin_fields = ['id', 'name', 'role_id', 'district_id', 'school_uuid'];

    protected $primaryKey = 'id';

    public static function getPublicFields() {
        return self::$public_fields;
    }

    public static function getAdminFields() {
        return array_merge(self::$public_fields, self::$admin_fields);
    }

    public function school() {
        return $this->hasOne('App\Models\School', 'uuid', 'school_uuid');
    }

    public function role() {
        return $this->hasOne('App\Models\UserRole', 'id', 'role_id');
    }

    public function district() {
        return $this->hasOne('App\Models\District', 'id', 'district_id');
    }
}
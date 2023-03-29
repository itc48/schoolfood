<?php

namespace App\Models;


use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

abstract class CoreModel extends Model {

    use UsesUuid, SoftDeletes;

    protected $guarded = [];

    protected $primaryKey = 'uuid';

    abstract static public function getPublicFields();

    abstract static public function getAdminFields();

    public function scopeForPublic($query) {
        return $query->select($this->getPublicFields());
    }

    public function scopeForAdmin($query) {
        return $query->select($this->getAdminFields());
    }

    public function scopeFindByUuid($query, string $uuid) {
        return $query->where('uuid', '=', $uuid);
    }

    public function scopeWhereLike($query, $column, $value) {
        return $query->where($column, 'like', '%' . $value . '%');
    }

    public function scopeOrWhereLike($query, $column, $value) {
        return $query->orWhere($column, 'like', '%' . $value . '%');
    }

    public function isUuid() {
        return true;
    }

}
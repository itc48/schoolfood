<?php

namespace App\Repositories;


abstract class CoreRepository {

    abstract protected function getModel();

    public function getByUuidForPublic(string $uuid) {
        $model = $this->getModel()->forPublic()->findByUuid($uuid)->firstOrFail();

        return $model;
    }

    public function getByUuidForAdmin(string $uuid) {
        $model = $this->getModel()->forAdmin()->findByUuid($uuid)->firstOrFail();

        return $model;
    }

    public function getByIdForPublic(int $id) {
        $model = $this->getModel()->forPublic()->findOrFail($id);

        return $model;
    }

    public function getByIdForAdmin(int $id) {
        $model = $this->getModel()->forAdmin()->findOrFail($id);

        return $model;
    }

    public function getAllForPublic() {
        $query_builder = $this->getModel()->forPublic()->get();

        return $query_builder;
    }

    public function getAllForAdmin() {
        $query_builder = $this->getModel()->forAdmin()->orderBy('created_at', 'DESC')->get();

        return $query_builder;
    }

}
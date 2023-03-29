<?php


namespace App\Builders;


use App\Models\CoreModel;

abstract class CoreBuilder {

    protected $model;

    abstract public function createEmpty(): CoreBuilder;


    public function __construct() {
        $this->createEmpty();
    }


    public function getModel(): CoreModel {
        return $this->model;
    }


    public function loadModel(CoreModel $model): CoreBuilder {
        $this->model = $model;

        return $this;
    }


    public function save(): bool {
        return $this->model->save();
    }


    public function __call($attribute, $value = []): CoreBuilder {
        $this->model->{$this->getAttributeName($attribute)} = $value[0];

        return $this;
    }


    private function getAttributeName(string $attribute): string {
        $splitted_attribute = preg_split("/(?=[A-Z])/", $attribute);

        array_shift($splitted_attribute);

        return strtolower(join('_', $splitted_attribute));
    }

}
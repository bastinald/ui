<?php

namespace Bastinald\Ui\Traits;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;

trait WithModel
{
    public $model = [];

    public function getModel($key = null, $default = null)
    {
        if (!$key) {
            return $this->model;
        } else if (is_array($key)) {
            return Arr::only($this->model, $key);
        } else {
            return Arr::get($this->model, $key, $default);
        }
    }

    public function setModel($key, $value = null)
    {
        if (is_array($key)) {
            foreach ($key as $arrayKey => $arrayValue) {
                Arr::set($this->model, $arrayKey, $arrayValue);
            }
        } else {
            Arr::set($this->model, $key, $value);
        }
    }

    public function resetModel()
    {
        $this->reset('model');
    }

    public function validateModel($rules = null)
    {
        $validator = Validator::make($this->model, $rules ?? $this->getRules());
        $validatedModel = $validator->validate();

        $this->resetErrorBag();

        return $validatedModel;
    }
}

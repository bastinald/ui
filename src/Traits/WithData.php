<?php

namespace Bastinald\UI\Traits;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;
use Livewire\TemporaryUploadedFile;

trait WithData
{
    public $data = [];

    public function getData($key = null)
    {
        if (!$key) {
            return $this->data;
        } else if (is_array($key)) {
            return Arr::only($this->data, $key);
        } else {
            return Arr::get($this->data, $key);
        }
    }

    public function setData($key, $value = null)
    {
        if (is_array($key)) {
            foreach ($key as $k => $v) {
                Arr::set($this->data, $k, $v);
            }
        } else {
            Arr::set($this->data, $key, $value);
        }
    }

    public function validateData($rules = null)
    {
        $validator = Validator::make($this->data, $rules ?? $this->getRules());

        $validatedData = $validator->validate();

        $this->resetErrorBag();

        return $validatedData;
    }

    public function hasUploadedData($key)
    {
        return $this->getData($key) instanceof TemporaryUploadedFile;
    }
}

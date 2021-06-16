<?php

namespace DummyFactoryNamespace;

use DummyModelNamespace\DummyModelClass;
use Illuminate\Database\Eloquent\Factories\Factory;

class DummyFactoryClass extends Factory
{
    protected $model = DummyModelClass::class;

    public function definition()
    {
        return app($this->model)->definition($this->faker);
    }
}

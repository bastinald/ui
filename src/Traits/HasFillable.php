<?php

namespace Bastinald\UI\Traits;

use Illuminate\Support\Facades\Schema;

trait HasFillable
{
    public function getFillable()
    {
        return Schema::getColumnListing($this->getTable());
    }
}

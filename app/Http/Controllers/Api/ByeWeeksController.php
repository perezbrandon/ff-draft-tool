<?php

namespace App\Http\Controllers\Api;

use CloudCreativity\LaravelJsonApi\Http\Controllers\EloquentController;
use App\ByeWeek;

class ByeWeeksController extends EloquentController
{
    public function __construct()
    {
        parent::__construct(new ByeWeek());
    }
}

<?php

namespace App\Http\Controllers\Api;

use CloudCreativity\LaravelJsonApi\Http\Controllers\EloquentController;
use App\Team;

class TeamsController extends EloquentController
{
    /**
     * TeamController constructor.
     */
    public function __construct()
    {
        parent::__construct(new Team());
    }
}

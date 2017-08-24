<?php

namespace App\Http\Controllers\Api;

use CloudCreativity\LaravelJsonApi\Http\Controllers\EloquentController;
use App\UserLeague;

class UserLeaguesController extends EloquentController
{
    /**
     * TeamController constructor.
     */
    public function __construct()
    {
        parent::__construct(new UserLeague());
    }
}

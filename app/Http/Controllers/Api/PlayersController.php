<?php

namespace App\Http\Controllers\Api;

use CloudCreativity\LaravelJsonApi\Http\Controllers\EloquentController;
use App\Player;

class PlayersController extends EloquentController
{
    /**
     * TeamController constructor.
     */
    public function __construct()
    {
        parent::__construct(new Player());
    }
}

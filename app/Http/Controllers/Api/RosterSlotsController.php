<?php

namespace App\Http\Controllers\Api;

use CloudCreativity\LaravelJsonApi\Http\Controllers\EloquentController;
use App\RosterSlot;

/**
 *
 */
class RosterSlotsController extends EloquentController
{
    public function __construct()
    {
        parent::__construct(new RosterSlot());
    }
}

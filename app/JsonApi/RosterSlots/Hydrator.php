<?php

namespace App\JsonApi\RosterSlots;

use CloudCreativity\LaravelJsonApi\Hydrator\EloquentHydrator;

class Hydrator extends EloquentHydrator
{

    /**
     * @var array|null
     */
    protected $attributes = [
        'position',
        'user_league_id' => 'userLeagueId'
    ];

    /**
     * @var array
     */
    protected $relationships = [
        //
    ];
}

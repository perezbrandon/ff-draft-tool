<?php

namespace App\JsonApi\RosterSlots;

use CloudCreativity\LaravelJsonApi\Schema\EloquentSchema;

class Schema extends EloquentSchema
{

    /**
     * @var string
     */
    protected $resourceType = 'roster-slots';

    /**
     * @var array|null
     */
    protected $attributes = [
        'position',
        'user_league_id' => 'userLeagueId'
    ];
}

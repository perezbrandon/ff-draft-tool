<?php

namespace App\JsonApi\Players;

use CloudCreativity\LaravelJsonApi\Schema\EloquentSchema;

class Schema extends EloquentSchema
{

    /**
     * @var string
     */
    protected $resourceType = 'players';

    /**
     * @var array|null
     */

    protected $attributes = [
        'player_id' => 'playerId',
        'active',
        'jersey',
        'fname',
        'lname',
        'display_name' => 'displayName',
        'team',
        'position',
        'height',
        'weight',
        'dob'
    ];
}

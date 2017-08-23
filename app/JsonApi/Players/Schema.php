<?php

namespace App\JsonApi\Players;

use CloudCreativity\LaravelJsonApi\Schema\EloquentSchema;

class Schema extends EloquentSchema
{

    /**
     * @var string
     */
    protected $resourceType = 'players';

    protected $createdAt = false;

    protected $updatedAt = false;

    /**
     * @var array|null
     */

    protected $attributes = [
        // 'updated_at' => 'updatedAt',
        // 'created_at' => 'createdAt',
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

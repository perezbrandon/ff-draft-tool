<?php

namespace App\JsonApi\UserLeagues;

use CloudCreativity\LaravelJsonApi\Schema\EloquentSchema;

class Schema extends EloquentSchema
{

    /**
     * @var string
     */
    protected $resourceType = 'user-leagues';

    /**
     * @var array|null
     */
    protected $attributes = [
        'name',
        'user_id' => 'userId'
    ];
}

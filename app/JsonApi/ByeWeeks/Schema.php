<?php

namespace App\JsonApi\ByeWeeks;

use CloudCreativity\LaravelJsonApi\Schema\EloquentSchema;

class Schema extends EloquentSchema
{

    /**
     * @var string
     */
    protected $resourceType = 'bye-weeks';

    /**
     * @var array|null
     */
    protected $attributes = [
        'bye_week' => 'byeWeek',
        'team_code' => 'teamCode',
        'team_name' => 'teamName'
    ];
}

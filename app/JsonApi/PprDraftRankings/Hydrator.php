<?php

namespace App\JsonApi\PprDraftRankings;

use CloudCreativity\LaravelJsonApi\Hydrator\EloquentHydrator;

class Hydrator extends EloquentHydrator
{

    /**
    * @var array|null
    */
    protected $attributes = [
        'position',
        'display_name',
        'fname',
        'lname',
        'team',
        'bye_week',
        'nerd_rank',
        'position_rank',
        'overall_rank',
        'player_id',
    ];

    /**
    * @var array
    */
    protected $relationships = [];
}

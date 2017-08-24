<?php

namespace App\JsonApi\UserDraftSelections;

use CloudCreativity\LaravelJsonApi\Hydrator\EloquentHydrator;

class Hydrator extends EloquentHydrator
{

    /**
     * @var array|null
     */
    protected $attributes = null;

    /**
     * @var array
     */
    protected $relationships = [
        //
    ];

}

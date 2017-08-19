<?php

namespace App\JsonApi\PprDraftRankings;

use CloudCreativity\LaravelJsonApi\Schema\EloquentSchema;

class Schema extends EloquentSchema
{

    /**
     * @var string
     */
    protected $resourceType = 'ppr-draft-rankings';

    /**
     * @var array|null
     */
    protected $attributes = null;

}


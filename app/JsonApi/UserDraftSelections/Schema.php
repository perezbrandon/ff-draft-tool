<?php

namespace App\JsonApi\UserDraftSelections;

use CloudCreativity\LaravelJsonApi\Schema\EloquentSchema;

class Schema extends EloquentSchema
{

    /**
     * @var string
     */
    protected $resourceType = 'user-draft-selections';

    /**
     * @var array|null
     */
    protected $attributes = null;

}


<?php

namespace App\JsonApi\Players;

use CloudCreativity\JsonApi\Contracts\Validators\RelationshipsValidatorInterface;
use CloudCreativity\LaravelJsonApi\Validators\AbstractValidatorProvider;

class Validators extends AbstractValidatorProvider
{

    /**
     * @var string
     */
    protected $resourceType = 'players';

    /**
     * Get the validation rules for the resource attributes.
     *
     * @param object|null $record
     *      the record being updated, or null if it is a create request.
     * @return array
     */
    protected function attributeRules($record = null)
    {
        return [
            //
        ];
    }

    /**
     * Define the validation rules for the resource relationships.
     *
     * @param RelationshipsValidatorInterface $relationships
     * @param object|null $record
     *      the record being updated, or null if it is a create request.
     * @return void
     */
    protected function relationshipRules(RelationshipsValidatorInterface $relationships, $record = null)
    {
        //
    }

    protected $allowedSortParameters = [
        'playerId',
        'active',
        'jersey',
        'fname',
        'lname',
        'displayName',
        'team',
        'position',
        'height',
        'weight',
        'dob',
    ];
}

<?php

namespace App\JsonApi\DraftProjections;

use CloudCreativity\LaravelJsonApi\Schema\EloquentSchema;

class Schema extends EloquentSchema
{

    /**
     * @var string
     */
    protected $resourceType = 'draft-projections';

    /**
     * @var array|null
     */

    protected $attributes = [
        'player_id' => 'playerId',
        'completions',
        'attempts',
        'passing_yards' => 'passingYards',
        'passing_td' => 'passingTd',
        'passing_int' => 'passingInt',
        'rush_yards' => 'rushYards',
        'rush_td' => 'rushTd',
        'fantasy_points' => 'fantasyPoints',
        'display_name' => 'displayName',
        'team'
    ];
}

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
     protected $attributes = [
         'position',
         'display_name' => 'displayName',
         'fname',
         'lname',
         'team',
         'bye_week' => 'byeWeek',
         'nerd_rank' => 'nerdRank',
         'position_rank' => 'positionRank',
         'overall_rank' => 'overallRank',
         'player_id' => 'playerId',
     ];

}

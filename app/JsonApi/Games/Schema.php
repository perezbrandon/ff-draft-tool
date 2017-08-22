<?php

namespace App\JsonApi\Games;

use CloudCreativity\LaravelJsonApi\Schema\EloquentSchema;

class Schema extends EloquentSchema
{

    /**
     * @var string
     */
    protected $resourceType = 'games';

    /**
     * @var array|null
     */

    protected $attributes = [
        'game_id' => 'gameId',
        'game_week' => 'gameWeek',
        'game_date' => 'gameDate',
        'away_team' => 'awayTeam',
        'home_team' => 'homeTeam',
    ];
}

<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\JsonApiSpecHelper;
use App\Game;

class GamesTest extends TestCase
{
    use DatabaseTransactions;
    use JsonApiSpecHelper;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testListTeamsSuccessful()
    {
        factory(Game::class, 1)->create();

        $response = $this->getApi('/api/games');

        $expectedResult = [
            'data' => [
                [
                    'type',
                    'id',
                    'attributes' => [
                        'gameId',
                        'gameWeek',
                        'gameDate',
                        'awayTeam',
                        'homeTeam'
                    ]
                ],
            ]
        ];

        $response->assertStatus(200)
                 ->assertJsonStructure($expectedResult);
    }


    public function testMultiFilterGamesSuccessful()
    {
        factory(Game::class, 4)->create([
            'game_week' => 3,
            'home_team' => 'ARI'
        ]);
        $response = $this->getApi('/api/games?filter[game_week]=3&filter[home_team]=ARI');



        $response->assertStatus(200)
                 ->assertJsonFragment([
                     'gameWeek' => 3,
                     'homeTeam' => 'ARI'
                 ]);
    }
}

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
}

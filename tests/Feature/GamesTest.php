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

    public function testListTeamsSuccessful()
    {
        factory(Game::class, 2)->create();

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
        $data = $this->getData($response);
        $this->assertEquals(count($data), 2);
    }
}

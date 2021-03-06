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

        $response->assertStatus(200)->assertJsonStructure($expectedResult);
        $this->assertEquals($this->countData($response), 2);
    }


    public function testMultiFilterGamesSuccessful()
    {
        factory(Game::class, 3)->create([
            'game_week' => 3,
            'home_team' => 'ARI'
        ]);
        $response = $this->getApi('/api/games?filter[game_week]=3&filter[home_team]=ARI');

        $response->assertStatus(200)
            ->assertJsonFragment([
                'gameWeek' => 3,
                'homeTeam' => 'ARI'
            ]);

        $this->assertEquals($this->countData($response), 3);
    }

    public function testSortAcendingGamesSuccessful()
    {
        factory(Game::class, 1)->create(['home_team' => 'BAL']);
        factory(Game::class, 1)->create(['home_team' => 'ZOO']);
        factory(Game::class, 1)->create(['home_team' => 'ARI']);
        factory(Game::class, 1)->create(['home_team' => 'COL']);

        $response = $this->getApi('/api/games?sort=homeTeam');

        $data = $this->getData($response);
        $data = array_map(function ($value) {
            return $value['attributes']['homeTeam'];
        }, $data);

        $response->assertStatus(200);
        $this->assertEquals($data, ['ARI', 'BAL', 'COL' ,'ZOO']);
    }
}

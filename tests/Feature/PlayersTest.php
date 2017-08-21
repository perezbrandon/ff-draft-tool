<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\JsonApiSpecHelper;
use App\Player;

class PlayersTest extends TestCase
{
    use DatabaseTransactions;
    use JsonApiSpecHelper;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testListPlayersSuccessful()
    {
        factory(Player::class, 1)->create();
        $response = $this->get('/api/players');

        $expectedResult = [
            'data' => [
                [
                    'type',
                    'id',
                    'attributes' => [
                        'playerId',
                        'active',
                        'jersey',
                        'lname',
                        'fname',
                        'displayName',
                        'team',
                        'position',
                        'height',
                        'weight',
                        'dob'
                    ]
                ],
            ]
        ];

        $response->assertStatus(200)
                 ->assertJsonStructure($expectedResult);
    }
}

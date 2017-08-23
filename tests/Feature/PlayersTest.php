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

    public function testListPlayersSuccessful()
    {
        factory(Player::class, 2)->create();

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
        $data = $this->getData($response);
        $this->assertEquals(count($data), 2);
    }

    public function testListDefaultFilterActiveOnly()
    {
        factory(Player::class, 3)->create([
            'active' => true
        ]);
        factory(Player::class, 2)->create([
            'active' => false
        ]);

        $response = $this->get('/api/players');

        $data = $this->getData($response);
        $this->assertEquals(count($data), 3);
    }

    public function testNoTimeStampFields()
    {
        factory(Player::class, 1)->create();
        $response = $this->get('/api/players');
        $attributes = $this->getData($response);
        $attributes = $attributes[0]['attributes'];
        $this->assertEquals(isset($attributes['updatedAt']), false);
        $this->assertEquals(isset($attributes['createdAt']), false);
    }

    public function testMultiFilterPlayersSuccessful()
    {
        factory(Player::class, 3)->create([
            'team' => 'ARI',
            'position' => 'RB',
        ]);
        $response = $this->getApi('/api/players?filter[team]=ARI&filter[position]=RB');

        $response->assertStatus(200)
                 ->assertJsonFragment([
                     'team' => 'ARI',
                     'position' => 'RB'
                 ]);
        $data = $this->getData($response);
        $this->assertEquals(count($data), 3);
    }
}

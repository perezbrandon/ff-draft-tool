<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\JsonApiSpecHelper;
use App\UserLeague;

class UserLeaguesTest extends TestCase
{
    use DatabaseTransactions;
    use JsonApiSpecHelper;

    public function testListRosterSlotsSucessful()
    {
        factory(UserLeague::class, 2)->create();

        $response = $this->getApi('/api/user-leagues');

        $expectedResult = [
            'data' => [
                [
                    'type',
                    'id',
                    'attributes' => [
                        'name',
                        'userId'
                    ]
                ],
            ]
        ];

        $response->assertStatus(200)->assertJsonStructure($expectedResult);
        $this->assertEquals($this->countData($response), 2);
    }

    public function testFilterByUserId()
    {
        factory(UserLeague::class, 1)->create([
            'user_id' => 1
        ]);
        factory(UserLeague::class, 2)->create([
            'user_id' => 2
        ]);

        $response = $this->getApi('/api/user-leagues?filter[user_id]=1');

        $response->assertStatus(200)
            ->assertJsonFragment([
                'userId' => 1,
            ]);

        $this->assertEquals($this->countData($response), 1);
    }
}

<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\JsonApiSpecHelper;
use App\Team;

class TeamsTest extends TestCase
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
        factory(Team::class, 1)->create();

        $response = $this->getApi('/api/teams');

        $expectedResult = [
            'data' => [
                [
                    'type',
                    'id',
                    'attributes' => [
                        'code',
                        'fullName'
                    ]
                ],
            ]
        ];

        $response->assertStatus(200)
                 ->assertJsonStructure($expectedResult);
    }
}

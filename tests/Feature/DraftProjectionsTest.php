<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\DraftProjection;

class DraftProjectionsTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */

    public function testListDraftProjectionsSucessful()
    {
        factory(DraftProjection::class, 1)->create();

        $response = $this->get('/api/draft-projections');

        $expectedResult = [
            'data' => [
                [
                    'type',
                    'id',
                    'attributes' => [
                        'playerId',
                        'completions',
                        'attempts',
                        'passingYards',
                        'passingTd',
                        'passingInt',
                        'rushYards',
                        'rushTd',
                        'fantasyPoints',
                        'displayName',
                        'team'
                    ]
                ],
            ]
        ];

        $response->assertStatus(200)
                 ->assertJsonStructure($expectedResult);
    }
}

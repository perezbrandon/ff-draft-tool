<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\PprDraftRanking;
use Tests\JsonApiSpecHelper;

class PprDraftRankingsTest extends TestCase
{
    use DatabaseTransactions;
    use JsonApiSpecHelper;

    public function testListDraftRankingsSuccessful()
    {
        factory(PprDraftRanking::class, 2)->create();

        $response = $this->getApi('api/ppr-draft-rankings');

        $expectedResult = [
            'data' => [
                [
                    'type',
                    'id',
                    'attributes' => [
                        'position',
                        'displayName',
                        'fname',
                        'lname',
                        'team',
                        'byeWeek',
                        'nerdRank',
                        'positionRank',
                        'overallRank',
                        'playerId'
                    ]
                ],
            ]
        ];

        $response->assertStatus(200)
            ->assertJsonStructure($expectedResult);
        $data = $this->getData($response);
        $this->assertEquals(count($data), 2);
    }

    public function testMultiFilterDraftRankingSuccessfull()
    {
        factory(PprDraftRanking::class, 3)->create([
            "bye_week" => 6,
            "position" => 'WR'
        ]);
        $response = $this->getApi('api/ppr-draft-rankings?filter[position]=WR&filter[bye_week]=6');



        $response->assertStatus(200)
                 ->assertJsonFragment([
                     "byeWeek" => 6,
                     "position" => "WR"
                 ]);
        $data = $this->getData($response);
        $this->assertEquals(count($data), 3);
    }
}

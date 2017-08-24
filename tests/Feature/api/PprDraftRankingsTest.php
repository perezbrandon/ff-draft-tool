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

        $response->assertStatus(200)->assertJsonStructure($expectedResult);
        $this->assertEquals($this->countData($response), 2);
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

        $this->assertEquals($this->countData($response), 3);
    }



    public function testSortAcendingPprDraftRankingSuccessful()
    {
        factory(PprDraftRanking::class, 1)->create(['overall_rank' => 4]);
        factory(PprDraftRanking::class, 1)->create(['overall_rank' => 5]);
        factory(PprDraftRanking::class, 1)->create(['overall_rank' => 100]);
        factory(PprDraftRanking::class, 1)->create(['overall_rank' => 25]);

        $response = $this->getApi('/api/ppr-draft-rankings?sort=overallRank');

        $data = $this->getData($response);
        $data = array_map(function ($value) {
            return $value['attributes']['overallRank'];
        }, $data);

        $response->assertStatus(200);
        $this->assertEquals($data, [ 4, 5, 25, 100]);
    }
}

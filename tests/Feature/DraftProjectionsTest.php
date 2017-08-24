<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\JsonApiSpecHelper;
use App\DraftProjection;

class DraftProjectionsTest extends TestCase
{
    use DatabaseTransactions;
    use JsonApiSpecHelper;

    public function testListDraftProjectionsSucessful()
    {
        factory(DraftProjection::class, 2)->create();

        $response = $this->getApi('/api/draft-projections');

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

        $response->assertStatus(200)->assertJsonStructure($expectedResult);
        $this->assertEquals($this->countData($response), 2);
    }


    public function testMultiFilterDraftProjectionSuccessful()
    {
        factory(DraftProjection::class, 3)->create([
            'team' => 'ARI'
        ]);
        $response = $this->getApi('/api/draft-projections?filter[team]=ARI');

        $response->assertStatus(200)
            ->assertJsonFragment([
                'team' => 'ARI',
            ]);

        $this->assertEquals($this->countData($response), 3);
    }

    public function testSortAcendingDraftProjectionsSuccessful()
    {
        factory(DraftProjection::class, 2)->create(['completions' => 2]);
        factory(DraftProjection::class, 1)->create(['completions' => 1]);
        factory(DraftProjection::class, 1)->create(['completions' => 4]);

        $response = $this->getApi('/api/draft-projections?sort=completions');
        $response->assertStatus(200);
        $data = $this->getData($response);

        $data = array_map(function ($value) {
            return $value['attributes']['completions'];
        }, $data);

        $this->assertEquals($data, [1, 2, 2 ,4]);
    }
}

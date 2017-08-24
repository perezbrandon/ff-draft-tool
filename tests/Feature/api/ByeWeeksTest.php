<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\JsonApiSpecHelper;
use App\ByeWeek;

class ByeWeeksTest extends TestCase
{
    use DatabaseTransactions;
    use JsonApiSpecHelper;

    public function testListByeWeeksSuccessful()
    {
        factory(ByeWeek::class, 2)->create();

        $response = $this->getApi('/api/bye-weeks');

        $expectedResult = [
            'data' => [
                [
                    'type',
                    'id',
                    'attributes' => [
                        'byeWeek',
                        'teamCode',
                        'teamName'
                    ]
                ],
            ]
        ];

        $response->assertStatus(200)->assertJsonStructure($expectedResult);
        $this->assertEquals($this->countData($response), 2);
    }

    public function testMultiFilterByeWeeksSuccessful()
    {
        factory(ByeWeek::class, 3)->create([
            'bye_week' => 6,
            'team_code' => 'ARI'
        ]);

        $response = $this->getApi('/api/bye-weeks?filter[bye_week]=6&filter[team_code]=ARI');

        $response->assertStatus(200)
            ->assertJsonFragment([
                'byeWeek' => 6,
                'teamCode' => 'ARI'
            ]);

        $this->assertEquals($this->countData($response), 3);
    }

    public function testSortAcendingByeWeeksSuccessful()
    {
        factory(ByeWeek::class, 1)->create(['bye_week' => 2]);
        factory(ByeWeek::class, 1)->create(['bye_week' => 3]);
        factory(ByeWeek::class, 1)->create(['bye_week' => 1]);


        $response = $this->getApi('/api/bye-weeks?sort=byeWeek');
        $data = $this->getData($response);

        $data = array_map(function ($val) {
            return $val['attributes']['byeWeek'];
        }, $data);

        $this->assertEquals($data, [1, 2 ,3]);
    }
}

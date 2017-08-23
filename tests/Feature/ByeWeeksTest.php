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

        $response->assertStatus(200)
            ->assertJsonStructure($expectedResult);
        $data = $this->getData($response);
        $this->assertEquals(count($data), 2);
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
        $data = $this->getData($response);
        $this->assertEquals(count($data), 3);
    }
}

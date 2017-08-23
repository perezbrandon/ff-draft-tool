<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\JsonApiSpecHelper;
use Illuminate\Http\Response;
use App\ByeWeek;

class ByeWeeksTest extends TestCase
{
    use DatabaseTransactions;
    use JsonApiSpecHelper;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testListByeWeeksSuccessful()
    {
        factory(ByeWeek::class, 1)->create();

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
    }





    public function testMultiFilterByeWeeksSuccessful()
    {
        factory(ByeWeek::class, 4)->create([
            'bye_week' => 6,
            'team_code' => 'ARI'
        ]);

        $response = $this->getApi('/api/bye-weeks?filter[bye_week]=6&filter[team_code]=ARI');

        $response->assertStatus(200)
                 ->assertJsonFragment([
                'byeWeek' => 6,
                'teamCode' => 'ARI'
                ]);
    }
}

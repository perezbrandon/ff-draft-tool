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

        $response = $this->get('/api/bye-weeks');

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
}

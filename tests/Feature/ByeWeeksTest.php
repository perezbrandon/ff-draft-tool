<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\ByeWeek;

class ByeWeeksTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testListByeWeeksSuccessful()
    {
        factory(ByeWeek::class, 1)->create();

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
    }
}

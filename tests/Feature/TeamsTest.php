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

    public function testListTeamsSuccessful()
    {
        factory(Team::class, 2)->create();

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
        $data = $this->getData($response);
        $this->assertEquals(count($data), 2);
    }


    public function testMultiFilterTeamsSuccessfull()
    {
        factory(Team::class, 3)->create([
            'code' => 'ARI',
            'full_name' => 'Arizona Cardinals'
        ]);
        $response = $this->getApi('/api/teams?filter[code]=ARI&filter[full_name]=Arizona%20Cardinals');

        $response->assertStatus(200)
                 ->assertJsonFragment([
                     'code' => 'ARI',
                     'fullName' => 'Arizona Cardinals'
                 ]);
        $data = $this->getData($response);
        $this->assertEquals(count($data), 3);
    }
}

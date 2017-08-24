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

        $response->assertStatus(200)->assertJsonStructure($expectedResult);
        $this->assertEquals($this->countData($response), 2);
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

        $this->assertEquals($this->countData($response), 3);
    }


    public function testSortAcendingGamesSuccessful()
    {
        factory(Team::class, 1)->create(['full_name' => 'LOS ANGELES']);
        factory(Team::class, 1)->create(['full_name' => 'ARIZONA']);
        factory(Team::class, 1)->create(['full_name' => 'CHICAGO']);
        factory(Team::class, 1)->create(['full_name' => 'ATLANTA']);

        $response = $this->getApi('/api/teams?sort=fullName');

        $data = $this->getData($response);
        $data = array_map(function ($value) {
            return $value['attributes']['fullName'];
        }, $data);

        $response->assertStatus(200);
        $this->assertEquals($data, [ 'ARIZONA', 'ATLANTA', 'CHICAGO', 'LOS ANGELES']);
    }
}

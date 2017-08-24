<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\JsonApiSpecHelper;
use App\RosterSlot;

class RosterSlotsTest extends TestCase
{
    use DatabaseTransactions;
    use JsonApiSpecHelper;

    public function testListRosterSlotsSucessful()
    {
        factory(RosterSlot::class, 2)->create();

        $response = $this->getApi('/api/roster-slots');

        $expectedResult = [
            'data' => [
                [
                    'type',
                    'id',
                    'attributes' => [
                        'position',
                        'userLeagueId'
                    ]
                ],
            ]
        ];

        $response->assertStatus(200)->assertJsonStructure($expectedResult);
        $this->assertEquals($this->countData($response), 2);
    }

    public function testFilterByLeagueId()
    {
        factory(RosterSlot::class, 2)->create([
            'user_league_id' => 1
        ]);
        factory(RosterSlot::class, 1)->create([
            'user_league_id' => 2
        ]);

        $response = $this->getApi('/api/roster-slots?filter[user_league_id]=2');

        $response->assertStatus(200)
            ->assertJsonFragment([
                'userLeagueId' => 2,
            ]);

        $this->assertEquals($this->countData($response), 1);
    }
}

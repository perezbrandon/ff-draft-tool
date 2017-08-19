<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PprDraftRankingsTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testListDraftRankingsSuccessful()
    {
        $headers = array(
            'CONTENT_TYPE' => 'application/vnd.api+json',
            'ACCEPT' => 'application/vnd.api+json'
        );
        echo getenv('APP_ENV');
        $response = $this->get('api/ppr-draft-rankings', $headers);

        echo "---------";
        print_r($response->getContent());
        echo "===========";

        $response->assertStatus(200)
        ->assertJson([
            'data' => [
                'type' => 'ppr_draft_rankings',
                'id' => '1'
            ],
        ]);
    }
}

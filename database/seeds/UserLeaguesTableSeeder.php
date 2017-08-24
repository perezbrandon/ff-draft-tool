<?php

use Illuminate\Database\Seeder;
use App\UserLeague;
use App\User;
use App\RosterSlot;

class UserLeaguesTableSeeder extends Seeder
{
    public $positions = [
        'QB',
        'RB',
        'RB',
        'WR',
        'WR',
        'TE',
        'FLEX',
        'D/ST',
        'K',
        'Bench',
        'Bench',
        'Bench',
        'Bench',
        'Bench',
        'Bench',
        'Bench',
        'Bench',
        'Bench'
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        $user = factory(User::class)->create([
            'name' => 'Jon Doe',
            'email' => 'example@ff-draft-tool.com'
        ]);

        $league = factory(UserLeague::class)->create([
            'user_id' => $user->id,
            'name' => 'Real Dogs'
        ]);

        foreach ($this->positions as $pos) {
            factory(RosterSlot::class, 1)->create([
                'position' => $pos,
                'user_league_id' => $league->id
            ]);
        }
    }
}

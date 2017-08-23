<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use MarkMyers\FFNerd\FFNerd;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use App\PprDraftRanking;
use App\Player;

class ImportFantasyFootballNerdApi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:ffnapi';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import api data from Fantasy Football Nerd';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }



    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Starting import process');
        $importNewCount = 0;
        $importUpdatedCount = 0;

        $api = new FFNerd();
        $rankings = $api->draftRankings(1);
        $rankings->each(function ($item, $key) use (&$importUpdatedCount, &$importNewCount) {
            $rank = null;
            try {
                $rank = PprDraftRanking::where('player_id', '=', $item['playerId'])->firstOrFail();
                $importUpdatedCount++;
            } catch (ModelNotFoundException $e) {
                $rank = new PprDraftRanking();
                $importNewCount++;
            }
            $rank->position = $item['position'];
            $rank->display_name = $item['displayName'];
            $rank->fname = $item['fname'];
            $rank->lname = $item['lname'];
            $rank->team = $item['team'];
            $rank->bye_week = $item['byeWeek'];
            $rank->nerd_rank = $item['nerdRank'];
            $rank->position_rank = $item['positionRank'];
            $rank->overall_rank = $item['overallRank'];
            $rank->player_id = $item['playerId'];
            $rank->save();
        });
        unset($rankings);

        $this->info("Finished import process for PprDraftRanking");
        $this->info("Newly imported: $importNewCount");
        $this->info("Updated: $importUpdatedCount");

        $importNewCount = 0;
        $importUpdatedCount = 0;

        $players = $api->players();
        $players->each(function ($item, $key) use (&$importUpdatedCount, &$importNewCount) {
            $rank = null;
            try {
                $player = Player::where('player_id', '=', $item['playerId'])->firstOrFail();
                $importUpdatedCount++;
            } catch (ModelNotFoundException $e) {
                $player = new Player();
                $importNewCount++;
            }

            try {
                $player->dob = Carbon::createFromFormat('Y-m-d', $item['dob'])->toDateString();
            } catch (\InvalidArgumentException $e) {
            }
            $player->weight = $item['weight'];
            $player->height = $item['height'];
            $player->position = $item['position'];
            $player->team = $item['team'];
            $player->display_name = $item['displayName'];
            $player->lname = $item['lname'];
            $player->fname = $item['fname'];
            $player->jersey = $item['jersey'];
            $player->active = $item['active'];
            $player->player_id = $item['playerId'];
            $player->save();
        });
        unset($players);

        $this->info("Finished import process for Player");
        $this->info("Newly imported: $importNewCount");
        $this->info("Updated: $importUpdatedCount");
    }
}

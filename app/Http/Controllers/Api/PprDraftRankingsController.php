<?php

namespace App\Http\Controllers\Api;

use CloudCreativity\LaravelJsonApi\Http\Controllers\EloquentController;
use App\PprDraftRanking;
/**
 *
 */
class PprDraftRankingsController extends EloquentController
{
    public function __construct()
    {
        parent::__construct(new PprDraftRanking());
    }


}
/*
function index() {

}

function read() {

}
*/

<?php

namespace App\JsonApi\Players;

use CloudCreativity\LaravelJsonApi\Pagination\StandardStrategy;
use CloudCreativity\LaravelJsonApi\Store\EloquentAdapter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use App\Player;

class Adapter extends EloquentAdapter
{

    /**
     * Adapter constructor.
     *
     * @param StandardStrategy $paging
     */
    public function __construct(StandardStrategy $paging)
    {
        parent::__construct(new Player(), $paging);
    }


    protected $sortColumns = [
        'playerId',
        'active',
        'jersey',
        'fname',
        'lname',
        'displayName',
        'team',
        'position',
        'height',
        'weight',
        'dob',
    ];

    /**
     * @param Builder $query
     * @param Collection $filters
     * @return void
     */
    //TODO: dry out this filter functionality
    protected function filter(Builder $query, Collection $filters)
    {
        $first = true;
        $results = "";
        foreach ($filters as $col => $value) {
            if ($first) {
                $query->where($col, 'like', "$value%")->where('active', '=', true)->get();
            } else {
                $query->orWhere($col, 'like', "$value%")->where('active', '=', true)->get();
            }
        }
        if ($filters->isEmpty()) {
            $query->where('active', '=', true);
        }
        //if($filters)
        //$query->where('active', '=', true);
    }

    /**
     * @param Collection $filters
     * @return mixed
     */
    protected function isSearchOne(Collection $filters)
    {
        // TODO
    }
}

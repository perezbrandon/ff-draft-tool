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

    /**
     * @param Builder $query
     * @param Collection $filters
     * @return void
     */
    protected function filter(Builder $query, Collection $filters)
    {
        // TODO
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

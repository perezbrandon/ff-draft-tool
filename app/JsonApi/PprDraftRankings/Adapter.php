<?php

namespace App\JsonApi\PprDraftRankings;

use CloudCreativity\LaravelJsonApi\Pagination\StandardStrategy;
use CloudCreativity\LaravelJsonApi\Store\EloquentAdapter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use App\PprDraftRanking;
use Illuminate\Support\Facades\Log;

class Adapter extends EloquentAdapter
{

    /**
     * Adapter constructor.
     *
     * @param StandardStrategy $paging
     */
    public function __construct(StandardStrategy $paging)
    {
        parent::__construct(new PprDraftRanking(), $paging);
    }

    /**
     * @param Builder $query
     * @param Collection $filters
     * @return void
     */
    protected function filter(Builder $query, Collection $filters)
    {
        //Log::info($query);
        Log::info($filters);

        $first = true;

        foreach ($filters as $column => $value) {
            if ($first) {
                $query->where($column, 'like', "%$value%");
            } else {
                $query->orWhere($column, 'like', "%$value%");
            }
        }
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

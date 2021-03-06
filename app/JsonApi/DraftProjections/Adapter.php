<?php

namespace App\JsonApi\DraftProjections;

use CloudCreativity\LaravelJsonApi\Pagination\StandardStrategy;
use CloudCreativity\LaravelJsonApi\Store\EloquentAdapter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use App\DraftProjection;

class Adapter extends EloquentAdapter
{

    /**
     * Adapter constructor.
     *
     * @param StandardStrategy $paging
     */
    public function __construct(StandardStrategy $paging)
    {
        parent::__construct(new DraftProjection(), $paging);
    }

    protected $sortColumns = [
            'playerId',
            'completions',
            'attempts',
            'passingYards',
            'passingTd',
            'passingInt',
            'rushYards',
            'rushTd',
            'fantasyPoints',
            'displayName',
            'team',
        ];

    /**
     * @param Builder $query
     * @param Collection $filters
     * @return void
     */
    protected function filter(Builder $query, Collection $filters)
    {
        $first = true;
        foreach ($filters as $col => $value) {
            if ($first) {
                $query->where($col, 'like', "$value%")->get();
            } else {
                $query->orWhere($col, 'like', "$value%")->get();
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

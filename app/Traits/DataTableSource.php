<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

trait DataTableSource
{
    /**
     * The attributes that are mass assignable.
     *
     * @return array<string, Closure>
     */
    protected function allowedFilters(): array
    {
        return [];
    }

    /**
     * @param Builder $builder
     */
    public function scopeFilters(Builder $builder): void
    {

        foreach ($this->getAllowedFilters() as $name => $filter) {
            if (is_callable($filter)) {
                call_user_func($filter, $builder, $name, request($name));
            } else {
                $builder->where($name, request($name));
            }
        }
    }

    /**
     * The filters to be applied and can be applied according to the allowed Filters
     */
    function getAllowedFilters(): Collection
    {
        return collect($this->getFilterOptions()->get('allowedFilters'))->only(collect(request()->input())->keys());
    }

    public function getFilterOptions(): Collection
    {
        return collect([
            'allowedFilters' => collect($this->allowedFilters() ?? []),
            'allowedSorts' => collect($this->allowedSorts ?? []),
        ]);
    }
}

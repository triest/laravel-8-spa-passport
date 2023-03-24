<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class TagFilter extends QueryFilter
{
    public function query(string $search): Builder
    {
        return $this->builder->where(function ($query) use ($search) {
            $query->where('title', 'like', "%$search%");
        });
    }


}

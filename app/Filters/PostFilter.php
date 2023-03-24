<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class PostFilter extends QueryFilter
{
    public function query(string $search): Builder
    {
        return $this->builder->where(function ($query) use ($search) {
            $query->where('title', 'like', "%$search%");
        });
    }

    public function my(string $search): Builder
    {
        $user = Auth::user();

        return $this->builder->whereHas('user',function ($q) use ($user){
           $q->where('id',$user->id);
        });
    }


}

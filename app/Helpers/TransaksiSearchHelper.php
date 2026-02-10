<?php

namespace App\Helpers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class TransaksiSearchHelper
{
    public static function apply(Builder $query, Request $request): Builder
    {
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('type', 'like', "%{$search}%");
            });
        }

        return $query;
    }
}

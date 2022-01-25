<?php

namespace App\Traits;

use Carbon\Carbon;

trait HelperTrait
{
    public function scopeLastMonth($query)
    {
        return $query->where('created_at', '>=', Carbon::now()->startOfMonth()->subMonthNoOverflow())
                     ->where('created_at', '<=', Carbon::now()->endOfMonth()->subMonthsNoOverflow());
    }

    public function scopeThisMonth($query)
    {
        return $query->where('created_at', '>=', Carbon::now()->startOfMonth())
                     ->where('created_at', '<=', Carbon::now()->endOfMonth());
    }

    public function scopeSearchBy($query, $type)
    {
        return $query->where(request()->by ?? $type, 'like', '%'. request()->q. '%');
    }

    public function scopeFilterStatus($query, $type)
    {
        return $query->where('status', $type);
    }

    public function scopeSearch($query, $type)
    {
        return $query->where($type, 'like', '%'. request()->q. '%');
    }

    public function scopeSearchRelasi($query, $type)
    {
        return $query->whereHas($type, function($search){
           $search->where(request()->by ?? '{$type}.nama', 'like', '%'. request()->q. '%');
        });
    }

    public function scopeOrSearchRelasi($query, $type)
    {
        return $query->orWhereHas($type, function($search){
            $search->where(request()->by ?? '{$type}.nama', 'like', '%'. request()->q. '%');
         });
    }
}

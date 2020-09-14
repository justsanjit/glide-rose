<?php

namespace App\Traits;

use Appstract\Stock\HasStock as BaseHasStock;
use Appstract\Stock\StockMutation;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

trait HasStock
{
    use BaseHasStock;

    public function getStockAttribute()
    {
        return $this->attributes['stock'] ?? $this->stock();
    }

    /**
     * Add dynamic stock relationship to reduce database queries and
     * resolve n+1 problem caused by appstract\stock package
     */
    public function scopeWithStock(Builder $query, Carbon $date = null)
    {
        $date = $date ?: Carbon::now();

        return $query->addSelect(['stock' =>  StockMutation::select(DB::raw('SUM(amount)'))
            ->whereColumn('stockable_id', $this->getTable()  . '.'  . $this->getKeyName())
            ->where('stockable_type', $this->getMorphClass())
            ->where('created_at', '<=', $date->format('Y-m-d H:i:s'))]);
    }
}

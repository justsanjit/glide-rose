<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasStock;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory, HasStock;

    public function getPriceInDollarsAttribute()
    {
        return number_format($this->price / 100, 2);
    }

    public function getPreviewImageAttribute()
    {
        return Storage::disk('products')->url($this->attributes['preview_image']);
    }
}

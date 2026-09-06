<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductSpecification extends Model
{
    protected $fillable = ['product_id', 'brand', 'processor', 'ram', 'storage', 'gpu', 'display', 'operating_system', 'weight', 'extra'];

    protected function casts(): array
    {
        return ['extra' => 'array'];
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}

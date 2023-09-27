<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand_id',
        'category_id',
        'title',
        'price',
        'image',
        'description',
        'slider',
    ];

    /**
     * @return BelongsToMany
     */
    public function kits(): BelongsToMany
    {
        return $this->belongsToMany(Kit::class, 'kit_product');
    }

    /**
     * @return BelongsToMany
     */
    public function rents(): BelongsToMany
    {
        return $this->belongsToMany(Rent::class, 'rent_product');
    }

    /**
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * @return BelongsTo
     */
    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeWithRelations($query): mixed
    {
        return $query->with(['brand', 'category', 'kits']);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Product extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'brand_id',
        'category_id',
        'title',
        'price',
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
     * @return BelongsToMany
     */
    public function similars(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'similar_product', 'similar', 'product_id');
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
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeWithRelations($query): mixed
    {
        return $query->with(['brand', 'category', 'kits', 'user']);
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeRandomItem($query): mixed
    {
        return $query->inRandomOrder()->limit(6)->get();
    }
}

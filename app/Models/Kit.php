<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kit extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'options',
    ];

    use HasFactory;

    /**
     * @return BelongsToMany
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'kit_product');
    }

    /**
     * @return HasMany
     */
    public function options(): HasMany
    {
        return $this->hasMany(KitOption::class);
    }
}

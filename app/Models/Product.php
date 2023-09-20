<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'price',
        'image',
    ];

    /**
     * @return BelongsToMany
     */
    public function kits(): BelongsToMany
    {
        return $this->belongsToMany(Kit::class, 'kit_product');
    }

    public function rents(): BelongsToMany
    {
        return $this->belongsToMany(Rent::class, 'rent_product');
    }
}

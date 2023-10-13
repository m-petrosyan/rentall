<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Rent extends Model
{
    use HasFactory;


    protected $fillable = [
        'full_name',
        'email',
        'tel',
        'comment',
        'start_date',
        'end_date',
        'total_price',
    ];

    /**
     * @return BelongsToMany
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'rent_product');
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeWithRelations($query): mixed
    {
        return $query->with('products')->get();
    }
}

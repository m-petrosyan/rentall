<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class KitOption extends Model
{
    use HasFactory;

    /**
     * @return BelongsToMany
     */
    public function kit(): BelongsToMany
    {
        return $this->belongsToMany(Kit::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}

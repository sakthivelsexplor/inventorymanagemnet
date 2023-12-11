<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Item extends Model
{
    use HasFactory;

    protected $table ='items';

    public function category(): HasMany
    {
        return $this->hasmany(ItemCategory::class, 'ItemID', 'id');
    }

    

}

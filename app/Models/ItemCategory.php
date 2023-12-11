<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ItemCategory extends Model
{
    use HasFactory;
    protected $table ='itemscategory';

    public function details(): HasOne
    {
        return $this->hasone(category::class, 'id', 'CategoryID');
    }
}

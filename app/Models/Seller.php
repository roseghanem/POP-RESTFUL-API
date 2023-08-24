<?php

namespace App\Models;

use App\Scopes\SellerScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Seller extends User
{

    protected static function boot(){
        parent::boot();
        static::addGlobalScope(new SellerScope);
    }
    use HasFactory;
    public function products(){
        return $this->hasMany(Product::class);
    }
}

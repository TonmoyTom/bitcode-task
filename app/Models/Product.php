<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function purchase(){
        return $this->hasMany(Purchase::class , 'product_id ');
    }

    public static function createProduct(array $data): Product
    {
        return static::create([
            'product_code' => $data['product_code'],
            'product_name' => $data['product_name'],
            'product_price' => $data['product_price'],
        ]);
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Purchase extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public static function createPurchase(array $data): Purchase
    {
        return static::create([
            'customer_id' => $data['customer_id'],
            'product_id' => $data['product_id'],
            'purchase_quantity' => $data['purchase_quantity'],
            'order_no' => $data['order_no'],
        ]);
    }

    public function customers(){
        return $this->belongsTo(Customer::class , 'customer_id');
    }
    public function products(){
        return $this->belongsTo(Product::class , 'product_id');
    }
}

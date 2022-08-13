<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Customer extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function purcchase(){
        return $this->hasMany(Purchase::class , 'customer_id');
    }

    public static function createCustomer(array $data): Customer
    {
        return static::create([
            'name' => $data['name'],
            'user_phone' => $data['user_phone'],
        ]);
    }
}

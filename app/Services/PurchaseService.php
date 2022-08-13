<?php

namespace App\Services;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Purchase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

/**
 * Class PurchaseService.
 */
class PurchaseService
{

    public static  function getPurchaseData(){
        $purchases =  DB::table('purchases')
            ->leftJoin('products','products.id','=','purchases.product_id')
            ->leftJoin('customers','customers.id','=','purchases.customer_id')
            ->selectRaw('products.*, sum(products.product_price*purchases.purchase_quantity) total ,
                                   sum(purchases.purchase_quantity) quantity')
            ->selectRaw('customers.name')
            ->groupBy('purchases.product_id','purchases.customer_id')
            ->orderBy('total','desc')
            ->get();

        return $purchases;
    }

    public static function getPurchaseStore()
    {
        $PurchaseDatas = Http::get('https://raw.githubusercontent.com/Bit-Code-Technologies/mockapi/main/purchase.json')->json();
        foreach ($PurchaseDatas as $PurchaseData){
            if(!Customer::where('name' , $PurchaseData['name'])->exists()){
                $customer = Customer::createCustomer($PurchaseData);
            }
            if(!Product::where('product_code' ,$PurchaseData['product_code'])->exists()){
                $product = Product::createProduct($PurchaseData);
            }
        }

        foreach ($PurchaseDatas as $key =>   $PurchaseData){
            $customer = Customer::where('name' , $PurchaseData['name'])->first();
            $product = Product::where('product_code' ,$PurchaseData['product_code'])->first();
            if(!Purchase::where('order_no' ,$PurchaseData['order_no'])->exists()){
                $PurchaseData['customer_id'] = $customer->id;
                $PurchaseData['product_id'] = $product->id;
                $purchase = Purchase::createPurchase($PurchaseData);
            }
        }
        return 'passed';
    }
}

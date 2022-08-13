<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Purchase;
use App\Services\PurchaseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class PurchaseController extends Controller
{

    public function index()
    {
        $purchases = PurchaseService::getPurchaseData();
        return view('website.purchase.index' , compact('purchases'));
    }

    public function store(Request $request)
    {
        $purchaseStore = PurchaseService::getPurchaseStore();
        if($purchaseStore == 'passed') {
            return back()->with('success', 'All Data Are Store.');
        }
    }

}

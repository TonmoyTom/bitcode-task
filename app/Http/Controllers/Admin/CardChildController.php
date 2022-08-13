<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\TrelloService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CardChildController extends Controller
{
    public function trelloCardChildListDetails($id){
        $response = TrelloService::trelloCardChildListDetails($id);
        return view('website.trello.card.cardChild.show' ,compact('response'));
    }


    public function trelloCardChildCreateDetails($id){
        return view('website.trello.card.cardChild.create' ,compact('id'));

    }
    public function trelloCardChildStoreDetails(Request $request, $id){
        $response = TrelloService::trelloCardChildStoreDetails($request->all(), $id);
        return back()->with('success', 'Data  Store Succesfull.');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\TrelloService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CardController extends Controller
{
    public function trelloCardcreate($id){
        return view('website.trello.card.create' ,compact('id'));
    }

    public function trelloCardStore(Request $request , $id){
        $response = TrelloService::trelloCardStore($request->all() , $id);
        return back()->with('success', 'Data Store Succesfull.');
    }

    public function trelloCardChildList($id){
        $response = TrelloService::trelloCardChildList($id);
        return view('website.trello.card.cardChild.index' ,compact('response' , 'id'));
    }

}

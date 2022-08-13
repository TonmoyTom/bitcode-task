<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Services\TrelloService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    public function index(){
        return view('website.index');
    }
    public function trelloLogin(){
      return view('website.trello.login');
    }
    public function trelloLoginSubmit(Request $request){
        session()->put('api_key' , $request->key);
        session()->put('token' , $request->token);
        $response = TrelloService::trelloInformationMe();
        session()->put('organizations' , $response[0]->id);
        return redirect()->route('trello.information')->with('success', 'All Done.');
    }

    public function trelloInformation(){
       $response = TrelloService::trelloInformationMe();
       $information = TrelloService::trelloInformation();
       return view('website.trello.information' , compact('response' , 'information'));
    }


    public function trelloSetorganizations(Request $request){
        session()->put('organizations' , $request->org_id);
        return back()->with('success', 'Set Org.');
    }

    public function trelloLogout(Request $request){
        session()->forget('organizations');
        session()->forget('api_key');
        session()->forget('token');
        return redirect()->route('home')->with('success', 'Logout.');
    }




}


<?php

namespace App\Services;

use http\Env\Request;
use Illuminate\Support\Facades\Http;

/**
 * Class TrelloService.
 */
class TrelloService
{

    public  static function trelloInformationMe(){
        $response = getContentType()->get(config('trello.trello_server').'/members/me/organizations?key='.apiKey().'&token='.token().'')->object();
        return $response;
    }
    public  static function trelloInformation(){
        $response = Http::get(config('trello.trello_server').'/members/me?key='.apiKey().'&token='.token().'')->object();;
        return $response;
    }

    public  static function boardIndex(){
        $response = getContentType()->get(config('trello.trello_server').'/organizations/'.org().'/boards?key='.apiKey().'&token='.token().'')->object();
        return $response;
    }
    public  static function boardStore($data){
        $response =  Http::post(config('trello.trello_server').'/boards/?name='.$data['name'].'&desc='.$data['desc'].'&key='.apiKey().'&token='.token().'');
        return $response;
    }

    public  static function boardShow($id){
        $response = getContentType()->get(config('trello.trello_server').'/boards/'.$id.'/lists?key='.apiKey().'&token='.token().'')->object();
        return $response;
    }
    public  static function boardEdit($id){
        $response = getContentType()->get(config('trello.trello_server').'/boards/'.$id.'?key='.apiKey().'&token='.token().'')->object();
        return $response;
    }

    public  static function boardUpdate($data , $id){
        $response =  Http::put(config('trello.trello_server').'/boards/'.$id.'?name='.$data['name'].'&desc='.$data['desc'].'&key='.apiKey().'&token='.token().'');
        return $response;
    }
    public  static function boardDelete($id){
        $response =   $data =  Http::delete(config('trello.trello_server').'/boards/'.$id.'?&key='.apiKey().'&token='.token().'');
        return $response;
    }

    public  static function trelloCardChildListDetails($id){

        $response = getContentType()->get(config('trello.trello_server').'/cards/'.$id.'?key='.apiKey().'&token='.token().'')->object();
        return $response;
    }

    public  static function trelloCardChildStoreDetails($data , $id){
        $response = Http::post(config('trello.trello_server').'/cards/?name='.$data['name'].'&desc='.$data['desc'].'&idList='.$id.'&key='.apiKey().'&token='.token().'');
        return $response;
    }

    public  static function trelloCardStore( $data , $id){
        $response =  Http::post(config('trello.trello_server').'/lists?name='.$data['name'].'&idBoard='.$id.'&key='.apiKey().'&token='.token().'');
        return $response;
    }

    public  static function trelloCardChildList($id){
        $response = getContentType()->get(config('trello.trello_server').'/lists/'.$id.'/cards?key='.apiKey().'&token='.token().'')->object();
        return $response;
    }
}

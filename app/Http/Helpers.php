<?php

use App\Models\CompanySetting;
use Illuminate\Support\Facades\Http;

function uploadFile($file, $folder = '/'): ?string
{
    if ($file) {
        $image_name = Rand() . '.' . $file->getClientOriginalExtension();
        return $file->storeAs($folder, $image_name, 'public');
    }
    return null;
}

function setImage($url = null, $type = null, $default_image = true): string
{
    if ($type == 'user') {
        return ($url != null) ? asset('storage/' . $url) : ($default_image ? asset('default/default_user.png') : '');
    }
    return ($url != null) ? asset('storage/' . $url) : ($default_image ? asset('default/default_image.png') : '');
}

function company(): CompanySetting
{
    return CompanySetting::first();
}


if (!function_exists ('codeGenerate')) {
    function codeGenerate()
    {
        $code = "";
        do {
            $uniqueCode = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $code = substr(str_shuffle(str_repeat($uniqueCode, 5)), 0, 6);
        } while (\App\Models\ShortLink::where("code", $code)->first());
        return $code;
    }
}
if (!function_exists ('apiKey')) {
    function apiKey()
    { if(session()->has('api_key')) {
        return session()->get('api_key');
    }
    }
}
if (!function_exists ('token')) {
    function token()
    {
        if(session()->has('token')){
            return session()->get('token');
        }
    }
}
if (!function_exists ('org')) {
    function org()
        { if(session()->has('organizations')) {
            return session()->get('organizations');
        }
    }
}
if (!function_exists ('getContentType')) {
    function getContentType()
        {
            return  Http::withHeaders([
                'Content-Type' => 'application/json'
            ]);
    }
}

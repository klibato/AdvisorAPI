<?php

namespace App\Http\Controllers;
// use Cookie; 
use Symfony\Component\HttpFoundation\Cookie;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use Illuminate\Http\Response;
// use Illuminate\Support\Facades\Response;

class AuthController extends Controller
{
    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function setCookie(Request $request)
    {
        $minutes = 60;
        $response = new Response('Set Cookie');
        $response->withCookie(cookie('name', 'token', $minutes));
        return $response;
    }

    public function getCookie(Request $request)
    {
        $value = $request->cookie('name');
        echo $value;
    }

    public function authenticate(Request $request)
    {
        $response = Http::get('https://auth.etna-alternance.net/api/users/anicet_e/photo');
        $content = response($response)->getContent('content-type'); 

        // $img = $response->getHeader('content-type')[0]; 
        // $img = $response->getContent('content-type')[0]
        
        dd($content);
        return $content; 
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use Socialite;
use Exception;
use Auth;

class LoginFCBController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('facebook')->stateless()->redirect();
    }
    public function callback()
    {
        $serviceUser = Socialite::driver('facebook')->stateless()->user();
        dd($serviceUser);
    }
    // public function loginWithFacebook()
    // {
    //     try {
    
    //         $user = Socialite::driver('facebook')->user();
    //         $isUser = User::where('fb_id', $user->id)->first();
     
    //         if($isUser){
    //             Auth::login($isUser);
    //             $token = $isUser->token;
    //             //  $user = Socialite::driver('github')->userFromToken($token);
    //             return response()->json([
    //                 'status_code' => 200,
    //                 'access_token' => $token,
    //                 'token_type' => 'Bearer',
    //                 'error' => false,
    //             ]);
    //         }else{
    //             return response()->json([
    //                 'status_code' => 500,
    //                 'message' => 'Error in login',
    //                 'error' => true,
    //             ]);
    //         }
    
    //     } catch (Exception $exception) {
    //         dd($exception->getMessage());
    //     }
    // }
}

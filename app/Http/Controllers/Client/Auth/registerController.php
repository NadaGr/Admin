<?php

namespace App\Http\Controllers\Client\Auth;

use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class registerController extends Controller
{
    public function register(Request $request){

        try {

            $validator = Validator::make($request->all(), [
                'nom_user' => 'string|max:255',
                'name' => 'required|string|max:255',
                'prenom' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6|confirmed',
                'role' => 'string|max:255',
                'telephone' => 'required|integer|min:8',
                
            ]);

            if($validator->fails()){
                return response([
                    'error' => $validator->errors()->all()
                ], 422);
            }

           /* $request['password'] = Hash::make($request['password']);
            $request['remember_token'] = Str::random(10);
            $user = User::create($request->toArray());*/
            $user = User::create([
                'name' => $request->name,
                'email'=> $request->email,
                'password'=> bcrypt($request->password),
                'role' => 'cliente'
                ]);
            $client = Client::create([
                'nom_user' => $user->name,
                'prenom'=> $request->prenom,
                'telephone'=> $request->telephone,
                'user_id' => $user->id,
                ]);


            return response()->json([
                'status_code' => 200,
				'data'=>array('id'=>$user->id,'name'=>$user->name),
                'message' => 'Registration Successfull',
            ]);


         }catch(Exception $error){
            return response()->json([
                'status_code' => 500,
                'message' => 'Error in Registration',
                'error' => $error,
            ]);
        }
    }
}

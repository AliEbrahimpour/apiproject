<?php

namespace App\Http\Controllers\Api\v1;

use App\City;
use App\Http\Resources\v1\User as UserResource;
use App\State;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Ipecompany\Smsirlaravel\Smsirlaravel;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $validData = $this->validate($request, [
            'mobile' => 'required|exists:users',
            'password' => 'required'
        ]);

        if(! auth()->attempt($validData)) {
            return response([
                'data' => 'اطلاعات صحیح نیست',
                'status' => 'error'
            ],403);
        }

//        $verifysms = str_random(4);
//        Smsirlaravel::sendVerification($verifysms,auth()->user()->mobile);

        $token = $this->createToken();
        return new UserResource(auth()->user() , $token);
    }

    public function register(Request $request)
    {
        // Validation Data
        $validData = $this->validate($request, [
            'firstname' => 'required|string|max:25',
            'lastname' => 'required|string|max:25',
            'mobile' => 'required|string|max:10|unique:users',
            'password' => 'required|string|min:6',
            'city' =>'required|string',
            'state' =>'required|string',
        ]);


        $user = User::create([
            'firstname' => $validData['firstname'],
            'lastname' => $validData['lastname'],
            'mobile' => $validData['mobile'],
            'password' => bcrypt($validData['password']),
            'api_token' => str_random(100)
        ]);


        $user_id = $user->id;
        $state=State::create([
            'user_id' =>$user_id,
            'name' => $validData['state'],
        ]);

        $state_id = $state->id;
        $city=City::create([
            'state_id' =>$state_id,
            'name' => $validData['city'],
        ]);

        auth()->login($user);
        $token = $this->createToken();
        return new UserResource($user , $token);
    }

    private function createToken()
    {
        auth()->user()->tokens()->delete();
        return auth()->user()->createToken('Api Token')->accessToken;
    }
}

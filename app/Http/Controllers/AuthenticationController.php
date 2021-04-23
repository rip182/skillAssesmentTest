<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
class AuthenticationController extends Controller
{
    public function register(Request $request) {
        $dataFields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|unique:users,email',
            'password' => 'required|string|confirmed'
        ]);

        $user = User::create([
            'name' => $dataFields['name'],
            'email' => $dataFields['email'],
            'password' => bcrypt($dataFields['password'])
        ]);
        $user->assignRole('writer');

        $token = $user->createToken('myapptoken')->plainTextToken;   

        $response = [
            'token' => $token,
            'user'  => $user,
        ];

        return response($response);

    }

    public function logout(Request $request){
        Auth::user()->tokens()->delete();
        return response(['messeage'=>'log out']);
    }

    public function login(Request $request){ 
    $dataFields = $request->validate([
        'email' => 'required',
        'password' => 'required|string'
    ]);

    //check user email exist
    $user = User::firstWhere('email',$request->email);

    if(!$user) {
        return response(['message' => 'user not exist'],401);
    }

    //check user matching password
    if($user and !Hash::check($dataFields['password'], $user->password)){
        return response(['message' => 'wrong password'],401);
    }
    $token = $user->createToken('myapptoken')->plainTextToken;
    $response = [
        'user' => $user,
        'token' => $token
    ];

    return response($response,200);
   }

   public function loginGihub(){
    return Socialite::driver('github')->redirect();
   }

   public function githubCallback(){
    $github = Socialite::driver('github')->user();
    // dd($github->getNickName());
    $user = User::create([
        'email' => $github->getEmail(),
        'name'  => $github->getNickName(),
        'provider_id' => $github->getId()

    ]);
    Auth::login($user, true);
    return redirect('home');
   }
}

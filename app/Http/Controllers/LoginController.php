<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Auth;

class LoginController extends Controller
{
    public function index(){
        return view('login');
    }
    public function redirectToProvider(){
        return Socialite::driver('github')->redirect();
    }

    public function handleProviderCallback(Request $request){
        $user = Socialite::driver('github')->user();

        $users['name'] = $user->nickname;
        $users['email'] = $user->email;
        $data = User::updateOrCreate($users);
        Auth::login($data);
        return redirect()->route('dashboard');

       
    }
}

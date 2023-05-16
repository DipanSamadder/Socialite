<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Auth;
use GuzzleHttp\Client;

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
        return redirect()->route('home');

       
    }
    public function redirectToProviderGoogle(){
        return Socialite::driver('google')->redirect();
    }

    public function handleProviderCallbackGoogle(Request $request){
        $user = Socialite::driver('google')->user();
        $users['name'] = $user->name;
        $users['email'] = $user->email;
        $exist = User::where('email', $user->email)->first();
        if(is_null($exist)){
            $data = User::create($users);
            Auth::login($data);
            return redirect()->route('home');
        }else{
            
            Auth::login($exist);
            return redirect()->route('home');
        }
        
        

       
    }
    
    public function redirectToProviderFacebook(){
        return Socialite::driver('facebook')->redirect();
    }

    public function handleProviderCallbackFacebook(Request $request){
        $user = Socialite::driver('facebook')->user();
        $users['name'] = $user->name;
        $users['email'] = $user->email;
        $exist = User::where('email', $user->email)->first();
        if(is_null($exist)){
            $data = User::create($users);
            Auth::login($data);
            return redirect()->route('home');
        }else{
            
            Auth::login($exist);
            return redirect()->route('home');
        }
        
        

       
    }
        public function redirectToProviderLinkedin(){
        return Socialite::driver('linkedin')->redirect();
    }

    public function handleProviderCallbackLinkedin(Request $request){
        $user = Socialite::driver('linkedin')->user();
        $users['name'] = $user->name;
        $users['email'] = $user->email;
        $exist = User::where('email', $user->email)->first();
        if(is_null($exist)){
            $data = User::create($users);
            Auth::login($data);
            return redirect()->route('home');
        }else{
            
            Auth::login($exist);
            return redirect()->route('home');
        }
        
        

       
    }
     public function redirectToTwitterProvider(){
        return Socialite::driver('twitter')->redirect();
    }

    public function twitterProviderCallback(Request $request){
        $user = Socialite::driver('twitter')->user();

        $users['name'] = $user->name;
        $users['email'] = $user->nickname;
        $exist = User::where('email', $user->nickname)->first();
        if(is_null($exist)){
            $data = User::create($users);
            Auth::login($data);
            return redirect()->route('home');
        }else{
            
            Auth::login($exist);
            return redirect()->route('home');
        }
        
        

       
    }
    
    public function redirectToInstagramProvider(){
        echo $appId = '3444452505795919';
        $redirectUri = urlencode('https://socialite.oyeber.com/login/instagram/callback');
        return redirect()->to("https://api.instagram.com/oauth/authorize?app_id={$appId}&redirect_uri={$redirectUri}&scope=user_profile,user_media&response_type=code");
    }

    public function instagramProviderCallback(Request $request){
        
        $code = $request->code;
        if (empty($code)) return redirect()->route('home')->with('error', 'Failed to login with Instagram.');
    
        $appId = '3444452505795919';
        $secret = 'b5ec3d52be862c36c515ef78878a6345';
        $redirectUri = 'https://socialite.oyeber.com/login/instagram/callback';
    
        $client = new Client();
    
        // Get access token
        $response = $client->request('POST', 'https://api.instagram.com/oauth/access_token', [
            'form_params' => [
                'app_id' => $appId,
                'app_secret' => $secret,
                'grant_type' => 'authorization_code',
                'redirect_uri' => $redirectUri,
                'code' => $code,
            ]
        ]);
    
        if ($response->getStatusCode() != 200) {
            return redirect()->route('home')->with('error', 'Unauthorized login to Instagram.');
        }
    
            $content = $response->getBody()->getContents();
            $content = json_decode($content);
        
            $accessToken = $content->access_token;
            $userId = $content->user_id;
        
            // Get user info
            $response = $client->request('GET', "https://graph.instagram.com/me?fields=id,username,account_type&access_token={$accessToken}");
        
            $content = $response->getBody()->getContents();
            $oAuth = json_decode($content);
        
            $users['name'] = $oAuth->username;
            $users['remember_token'] = $oAuth->id;
            $users['email'] = $oAuth->username;
            $exist = User::where('email', $oAuth->username)->first();
            if(is_null($exist)){
                $data = User::create($users);
                Auth::login($data);
                return redirect()->route('home');
            }else{
                
                Auth::login($exist);
                return redirect()->route('home');
            }
        
    }
}

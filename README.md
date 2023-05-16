## Laravel Socialite 
### Installation Github
```
composer require laravel/socialite
```

### Configuration

These credentials should be placed in your application's config/services.php configuration file

```
'github' => [
    'client_id' => env('GITHUB_CLIENT_ID'),
    'client_secret' => env('GITHUB_CLIENT_SECRET'),
    'redirect' => 'http://example.com/callback-url',
],


```

### Routing

```
use Laravel\Socialite\Facades\Socialite;
 
Route::get('/auth/redirect', function () {
    return Socialite::driver('github')->redirect();
});
 
Route::get('/auth/callback', function () {
    $user = Socialite::driver('github')->user();
 
    // $user->token
});
```


### Authentication & Storage

```
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
 
Route::get('/auth/callback', function () {
    $githubUser = Socialite::driver('github')->user();
 
    $user = User::updateOrCreate([
        'github_id' => $githubUser->id,
    ], [
        'name' => $githubUser->name,
        'email' => $githubUser->email,
        'github_token' => $githubUser->token,
        'github_refresh_token' => $githubUser->refreshToken,
    ]);
 
    Auth::login($user);
 
    return redirect('/dashboard');
});
```

### Video Tutorial
https://www.youtube.com/watch?v=vzT3CQ41gKg&list=PLqf3pJ1mc7x24NCSjWkrd1TiXqQ_iVlYK&index=1

### Documentations
https://laravel.com/docs/10.x/socialite#configuration


### Installation Google/Facebook/Twitter/Instagram/Linkedin
Same as a top. change only CLIENT_ID & CLIENT_SECRET. Only differcen on Instagram code bellow mention.
```
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
```
### Video Tutorial
Google - https://www.youtube.com/watch?v=FNJX_JStGb4&list=PLqf3pJ1mc7x24NCSjWkrd1TiXqQ_iVlYK&index=2&pp=iAQB
Facebook - https://www.youtube.com/watch?v=z4rTbKB5m_w&list=PLqf3pJ1mc7x24NCSjWkrd1TiXqQ_iVlYK&index=3
Linkedin - https://www.youtube.com/watch?v=2rGcpApTk0I&list=PLqf3pJ1mc7x24NCSjWkrd1TiXqQ_iVlYK&index=4
Instagram - https://www.youtube.com/watch?v=eWgjoutCkqg&list=PLqf3pJ1mc7x24NCSjWkrd1TiXqQ_iVlYK&index=5
Twitter - https://www.youtube.com/watch?v=mDxVziiX-eQ&list=PLqf3pJ1mc7x24NCSjWkrd1TiXqQ_iVlYK&index=7

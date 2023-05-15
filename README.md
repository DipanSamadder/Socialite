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
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

    </head>
    <body>
    <a class="btn btn-success" href="{{ route('github.login') }}">Github Login</a>
       <a class="btn btn-success" href="{{ route('google.login') }}">google Login</a>
       <a class="btn btn-success" href="{{ route('facebook.login') }}">Facebook Login</a>
       <a class="btn btn-success" href="{{ route('linkedin.login') }}">linkedin Login</a>
       <a class="btn btn-success" href="{{ route('instagram.login') }}">instagram Login</a>
       <a class="btn btn-success" href="{{ route('twitter.login') }}">twitter Login</a>
    </body>
</html>

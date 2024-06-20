<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    </head>
    <body>
        <div class="container">
            @if (Route::has('login'))
                <div class="text-right">
                    @auth
                        <a href="{{ route('home',app()->getLocale()) }}">Home</a>
                    @else
                        <a href="{{ route('login',app()->getLocale()) }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register',app()->getLocale()) }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>
        <div class="container text-center py-5 my-5">
            <h1>{{__('welcome')}}</h1>
        </div>
        
    </body>
</html>

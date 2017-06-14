<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Login - Creditoo Test</title>
        <link rel="stylesheet" href="/css/app.css">
    </head>
    <body class="login">
        <div class="vertical-center">
            <div class="container app-box-container text-center">
                <h1 class="title">Creditoo Test</h1>

                <div class="app-box">
                    <p>This app show your Github profile</p>

                    <a class="btn btn-warning btn-lg" href="{{ route('login') }}">Sign in with Github</a>
                </div>
            </div>
        </div>
    </body>
</html>

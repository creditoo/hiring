<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Profile - Creditoo Test</title>
        <link rel="stylesheet" href="/css/app.css">
    </head>

    <body class="profile">
        <div class="container">
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-1" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="{{ route('profile') }}">Creditoo Test</a>
                    </div>

                    <div class="collapse navbar-collapse" id="navbar-collapse-1">
                        <ul class="nav navbar-nav navbar-right">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <img src="{{ $user->avatar }}" alt="{{ $user->nickname }} avatar" width="30" height="30">
                                    {{ $user->nickname }} <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{ route('logout') }}">Logout</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <div class="col-xs-12 account">
                <div class="row">
                    <div class="col-sm-6 col-md-4 image">
                        <div><img class="img-responsive center-block" src="{{ $user->avatar }}" alt="{{ $user->nickname }} avatar"></div>
                    </div>

                    <div class="col-sm-6 col-md-8 information">
                        @if (empty($user->name) === false)
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input id="name" class="form-control" type="text" value="{{ $user->name }}" disabled>
                            </div>
                        @endif

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input id="email" class="form-control" type="text" value="{{ $user->email }}" disabled>
                        </div>

                        <a class="btn btn-warning btn-lg pull-right" href="{{ $user->url }}" target="_blank">See your profile on Github</a>
                    </div>
                </div>
            </div>
        </div>

        <script src="/js/app.js"></script>
    </body>
</html>

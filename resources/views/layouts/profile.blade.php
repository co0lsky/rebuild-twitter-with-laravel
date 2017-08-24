<!DOCTYPE html>
<html lang="en" xmlns:v-on="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta id="token" name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ mix('/css/app.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>

    <style type="text/css">
        .no-bottom {
            bottom: 0;
            margin-bottom: 0;
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top no-bottom">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ url('/login') }}">Login</a></li>
                            <li><a href="{{ url('/register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ url('/logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
            <div class="jumbotron no-bottom"></div>
        </nav>

        <nav class="navbar navbar-default">
          <div class="container">
            <div class="navbar-header col-md-2">
                <a href="{{ url('/' . $user->username) }}">
                    <h4><strong>{{ $user->name or 'Full Name' }}</strong></h4>
                </a>
                <a href="{{ url('/' . $user->username) }}">
                    <small>&#64;{{ $user->username or 'username' }}</small>
                </a>
            </div>

            <div class="col-md-8">
              <ul class="nav navbar-nav">
                <li class="{{ !Route::currentRouteNamed('profile') ?: 'active' }}">
                    <a href="{{ url('/' . $user->username) }}" class="text-center">
                        <div class="text-uppercase">Tweets</div>
                        <div>0</div>
                    </a>
                </li>
                @if ($is_edit_profile)
                <li class="{{ !Route::currentRouteNamed('following') ?: 'active' }}">
                    <a href="{{ url('/following') }}" class="text-center">
                        <div class="text-uppercase">Following</div>
                        <div>{{ $following_count }}</div>
                    </a>
                </li>
                @endif
                <li class="{{ !Route::currentRouteNamed('followers') ?: 'active' }}">
                    <a href="{{ url('/' . $user->username . '/followers') }}" class="text-center">
                        <div class="text-uppercase">Followers</div>
                        <div>{{ $followers_count }}</div>
                    </a>
                </li>
              </ul>
              </div>

            <div class="col-md-2">
            @if (Auth::check())
                @if ($is_edit_profile)
                <a href="#" class="navbar-btn navbar-right">
                    <button type="button" class="btn btn-default">Edit Profile</button>
                </a>
                @else
                <button type="button" v-on:click="follows" class="navbar-btn navbar-right btn btn-default">@{{ followBtnText }}</button>
                @endif
            @endif
            </div>
          </div>
        </nav>

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ mix('/js/manifest.js') }}"></script>
    <script src="{{ mix('/js/vendor.js') }}"></script>
    <script src="{{ mix('/js/app.js') }}"></script>

    <script>
        window.App = <?php echo json_encode([
            'username' => $user->username,
            'isFollowing' => $is_following ? 1 : 0,
        ]); ?>
    </script>
    <script src="{{ mix('/js/pages/layout_profile.js') }}"></script>
</body>
</html>

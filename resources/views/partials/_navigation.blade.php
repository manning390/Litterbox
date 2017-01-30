<nav class="navbar navbar-default navbar-static-top">
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
            <a class="navbar-brand" href="{{ route('home') }}">
                The Colorless
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                <li><a href="{{ route('home') }}">Front page</a></li>
                @if($user)
                    <li><a href="http://chat.thecolorless.net/#/channel/main">Chat</a></li>
                    @can('view_admin')
                        <li><a href="{{ route('admin.home') }}">Admin</a></li>
                    @endcan
                @endif
                <li><a href="{{ route('home.search') }}">Search</a></li>
                @if($user)
                    <li><a href="{{ route('auth.logout') }}">Sign out</a></li>
                @else
                    <li><a href="{{ route('auth.login') }}">Login</a></li>
                    <li><a href="{{ route('auth.register') }}">Join</a></li>
                @endif
            </ul>

            <!-- Right Side Of Navbar -->
            <p class="navbar-text navbar-right">
                <!-- Authentication Links -->
                @if(Auth::guest())
                    You are <strong>a guest</strong>
                @else
                    You are <strong><a href="{{ route('user.show', $user->name) }}">{{ $user->name }}</a></strong> • <a href="{{ route('user.edit') }}">Settings</a>
                @endif
            </p>
        </div>
    </div>
</nav>
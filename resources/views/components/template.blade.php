
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <link rel="icon" type="image/png" href="{{ asset('img/logo.png') }}">



    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Coral+Pixels&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Share+Tech&display=swap" rel="stylesheet">

    @vite('resources/css/global.css')

    <!-- Aquí se "inyectarán" los CSS de otras vistas -->
    @stack('styles')
    
</head>
<body>
    <header>
        <div class="header_inner">
            <div class="header_left">
                <a href="/" class="btn_logo"></a>
                <nav class="gnb_menu">
                    <ul>
                        <li><a href="{{ route('dashboard') }}">dashboard</a></li>
                        <li><a href="{{ route('addpost') }}">+add post</a></li>
                        <li><a href="#">About . . . 🐦</a></li>
                    </ul>
                </nav>
            </div>
            <div class="header_right">
                @auth
                    <!-- Botón Log Out -->
                    <form method="POST" action="{{ route('logout') }}" class="form_logout">
                        @csrf
                        <button type="submit" class="btn_logout">log out</button>
                    </form>

                    <!-- Nombre de Usuario -->
                    <div class="user_name">
                        {{ Auth::user()->name }}
                    </div>

                    <!-- Avatar -->
                    <div class="user_avatar">
                        <a href="{{ route('profile') }}">
                            @if(Auth::user()->avatar)
                                <img src="{{ Storage::url(Auth::user()->avatar) }}" alt="Avatar" >
                            @else
                                <div class="user_no_avatar">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </div>
                            @endif
                        </a>
                    </div>
                @endauth
                @guest
                    <div class="btn_login">
                        <a href="{{ route('login') }}">login | sign up</a>
                    </div>
                @endguest
            </div>
        </div>

    </header>

    <main>
        <div class="main_container">
            @yield('content')
        </div>
    </main>

    <footer class="main_footer">
        <div class="footer_container">
            <p class="footer_copy">
                &copy; {{ date('Y') }} <strong>meow community</strong> - by yangpimpollo.
            </p>
        </div>
    </footer>
    

</body>
</html>
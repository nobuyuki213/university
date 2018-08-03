<header class="drawer-navbar drawer-navbar--fixed" role="banner">
    <div class="drawer-container">
        <div class="drawer-navbar-header">

            <a class="drawer-brand" href="{{ url('/') }}">LOGO</a>

            <button type="button" class="drawer-toggle drawer-hamburger">
                <span class="sr-only">toggle navigation</span>
                <span class="drawer-hamburger-icon"></span>
            </button>

        </div>
        <nav class="drawer-nav" role="navigation">
            <ul class="drawer-menu drawer-menu--left">
                <li><a class="drawer-menu-item" href="{{ route('university.create') }}">大学登録(仮組)</a></li>{{-- 仮作成 --}}
            </ul>
            <ul class="drawer-menu drawer-menu--right">
            @guest
                <li><a class="drawer-menu-item" href="{{ route('login') }}">ログイン</a></li>
                <li><a class="drawer-menu-item" href="{{ route('register') }}">会員登録</a></li>
            @else
                <li class="drawer-dropdown">
                    <a class="drawer-menu-item" href="#" data-toggle="dropdown" role="button" aria-expanded="false">
                        {{ Auth::user()->name }} <span class="drawer-caret"></span>
                    </a>
                    <ul class="drawer-dropdown-menu">
                        <li>
                            <a class="drawer-dropdown-menu-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                                ログアウト
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                        <li><a class="drawer-dropdown-menu-item" href="#">Dropdown nav1</a></li>
                    </ul>
                </li>
            @endguest
            </ul>
        </nav>
    </div>
</header>

{{-- bootstrap.standerd.navbar --}}
{{-- <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">

    <a class="navbar-brand" href="{{ url('/') }}">{{ config('app.name', 'Laravel') }}</a>
    <!-- Collapsed Hamburger -->
    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#Navbar" aria-controls="Navbar" aria-expanded="false" aria-label="ナビゲーションの切替">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="Navbar">
        <!-- Left Side Of Navbar -->
        <ul class="navbar-nav　mr-auto">&nbsp;</ul>
        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav ml-auto">
            <!-- Authentication Links -->
            @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">ログイン</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">会員登録</a>
                </li>
            @else
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" id="navbarDropdown" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                        {{ Auth::user()->name }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                            ログアウト
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </div>
                </li>
            @endguest
        </ul>
    </div>
</nav> --}}
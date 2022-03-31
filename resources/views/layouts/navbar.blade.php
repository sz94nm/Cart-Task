<nav class="navbar navbar-expand navbar-dark bg-dark">
    <a class="navbar-brand ml-5" href="/">Cart Task</a>

    <div class="collapse navbar-collapse" id="navbar">
        <ul class="navbar-nav ml-auto mr-5">

            @if (!Auth::check())
                <li class="nav-item ">
                    <a class="nav-link " href="/register">Register</a>
                </li>

                <li class="nav-item ">
                    <a class="nav-link " href="/login">Login</a>

                </li>
            @endif

            @if (Auth::check())

                @if (Auth::user()->role == 'admin')
                    <li class="nav-item ">
                        <a class="nav-link " href="/dashboard">Dashboard</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="/">WebSite</a>

                    </li>
                @endif
                <li class="nav-item ">
                    <a class="nav-link " href="">{{ Auth::user()->name }} <i class="bi bi-person-circle"></i>
                    </a>
                </li>

                <li class="nav-item ">
                    <a class="nav-link " href="/cart">Cart <i class="bi bi-cart3"></i></a>
                </li>

                <li class="nav-item ">
                    <a class="nav-link" href="/logout">LogOut<i class="bi bi-arrow-bar-right"></i></a>

                </li>
            @endif
            {{-- @if (Auth::check())
                    <li class="nav-item">
                        <a class="nav-link mx-2" href="{{ route('logout') }}">Log Out</a>
                    </li>
                @endif --}}

        </ul>

    </div>
</nav>

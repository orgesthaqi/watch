<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <script src="{{ asset('/assets/js/color-modes.js') }}"></script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <link rel="icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.122.0">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <link href="{{ asset('/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/css/bootstrap-select.min.css">
    <script src="https://cdn.plyr.io/3.7.2/plyr.js"></script>
    <link rel="stylesheet" href="https://cdn.plyr.io/3.7.2/plyr.css" />
</head>

<body>
    <header class="p-3 mb-3 border-bottom">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start text">
                <a href="{{ route('home') }}"
                    class="d-flex align-items-center mb-2 mb-lg-0 link-body-emphasis text-decoration-none">
                    <img src="{{ asset('img/movie-logo.svg') }}" alt="" height="45px;" width="45px;">
                </a>
                @guest
                {{-- <div class="text-end">
                            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                                @if (Route::has('login'))
                                    <li>
                                        <a class="nav-link px-2 link-body-emphasis" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @endif

                @if (Route::has('register'))
                <li>
                    <a class="nav-link px-2 link-body-emphasis" href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
                @endif
                </ul>
            </div> --}}
            @else
            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 ms-lg-2 justify-content-center mb-md-0">
                <li><a href="{{ route('home') }}" class="nav-link px-2 text-secondary">Filma</a></li>
                <li><a href="{{ route('series.index') }}" class="nav-link px-2 text-secondary">Seriale</a></li>
                {{-- <li><a href="{{ route('home') }}" class="nav-link px-2 text-secondary">Favoritët</a></li> --}}
                <li><a href="{{ route('continue-watching') }}" class="nav-link px-2 text-secondary">Vazhdoni Shikimin</a></li>
            </ul>

            <div class="dropdown text-end">
                <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    {{ Auth::user()->name }}
                </a>
                <ul class="dropdown-menu text-small">
                    @hasanyrole('admin|manager')
                    <li><a class="dropdown-item" href="{{ route('media_items.index') }}">Manage Media</a></li>
                    <li><a class="dropdown-item" href="{{ route('categories.index') }}">Manage Categories</a></li>
                    @endhasanyrole

                    @role('admin')
                    <li><a class="dropdown-item" href="{{ route('users.index') }}">Manage Users</a></li>
                    <li><a class="dropdown-item" href="{{ route('roles.index') }}">Manage Roles</a></li>
                    {{-- <li><a class="dropdown-item" href="{{ route('permissions.index') }}">Permissions</a></li> --}}
                    @endrole
                    <li><a class="dropdown-item" href="{{ route('profile.index') }}">Profile</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}</a></li>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </ul>
            </div>
            @endguest
        </div>
        </div>
    </header>

    <main class="col-lg-10 mx-auto">
        @yield('content')
    </main>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/resumablejs@1.1.0/resumable.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/js/bootstrap-select.min.js"></script>
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    @yield('scripts')
</body>

</html>

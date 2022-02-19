<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Eatap Stores</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.css" integrity="sha256-jKV9n9bkk/CTP8zbtEtnKaKf+ehRovOYeKoyfthwbC8=" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.js" integrity="sha256-CgvH7sz3tHhkiVKh05kSUgG97YtzYNnWt6OXcmYzqHY=" crossorigin="anonymous"></script>
    

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="shortcut icon" href="/img/logo.png">
    <link href="{{ mix('css/app.css') }}" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
    <link href="{{ asset('/css/layout/layout.css') }}" rel="stylesheet">

    @yield('pageCss')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-light shadow">
            <div class="container">
                    <a class="navbar-brand" href="{{ url('/store') }}"><img id = "nav_icon" src=" {{ asset('/img/logo.png') }} "></a>
                </a>
                    <!-- Left Side Of Navbar -->
                {{-- <ul class="navbar-nav mr-auto">
                </ul> --}}
                @guest
                @else
                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{Auth::guard('shop')->user()->name}} 様
                            <span class="caret"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('store.logout') }}" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                            ログアウト
                            </a>
                            <form id="logout-form" action="{{ route('store.logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                            <a class="dropdown-item" href="{{ route('store.bills') }}">
                                ご利用状況
                            </a>
                            <a class="dropdown-item" href="{{ route('store.articles') }}">
                                お知らせ
                            </a>
                            <a class="dropdown-item" href="{{ route('store.file.operation')}}">
                                操作マニュアル
                            </a>
                        </div>
                    </li>
                </ul>
            @endguest
                {{-- </div> --}}
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

<script type="text/javascript">
    function CloseCreateMenuFrame() {
        console.log("a");
        $('#menu_editor_frame').css({'display': 'none'});
    }
    function CloseUpdateMenuFrame() {
        console.log("a");
        $('#menu_update_frame').css({'display': 'none'});
    }
    function CloseCreateServiceFrame() {
        console.log("b");
        $('#service_editor_frame').css({'display': 'none'});
    }
    function CloseUpdateServiceFrame() {
        console.log("b");
        $('#service_update_frame').css({'display': 'none'});
    }
    function CloseCreateTakeoutFrame() {
        console.log("c");
        $('#takeout_editor_frame').css({'display': 'none'});
    }
    function CloseUpdateTakeoutFrame() {
        console.log("c");
        $('#takeout_update_frame').css({'display': 'none'});
    }

</script>
</body>
</html>

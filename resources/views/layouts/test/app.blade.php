<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ __('DHPS') }}</title>

    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/responsive.css') }}" rel="stylesheet">
    {{-- <link href="{{ asset('css/admin.css') }}" rel="stylesheet"> --}}
    <link href="https://cdn.lineicons.com/2.0/LineIcons.css" rel="stylesheet">
   
    <link rel="stylesheet" href=" https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    {{-- select 2 --}}
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" /> --}}
    @stack('styles')
</head>
<body class="bg-light">
    
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-primary shadow-sm text-white fixed-top">
            <div class="container">
                <a class="navbar-brand text-white" href="{{ route('/',app()->getLocale()) }}">
                    {{ __('DHPS') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        @can('user-list')
                        <li class="nav-item">
                            <a href="/users" class="nav-link text-white">Users</a>
                        </li>
                        @endcan
                        @can('teamMember-list')
                        <li class="nav-item">
                            <a href="/teammembers" class="nav-link text-white">
                                အဖွဲ့၀င်များ</a>
                        </li>
                        @endcan
                        
                        @can('customer-list')
                        <li class="nav-item">
                            <a href="/customers" class="nav-link text-white">Customers</a>
                        </li>
                        @endcan
                        @can('customerOrder-list')
                        <li class="nav-item">
                          @if (auth()->user()->user_type == 1)
                            <a href="/customer-orders" class="nav-link text-white">အော်ဒါများ</a>
                          @elseif(auth()->user()->user_type == 2)
                            <a href="/orders" class="nav-link text-white">အော်ဒါများ</a>
                          @else
                            <a href="/teammember_orders" class="nav-link text-white">
                                အော်ဒါတောင်းခံမှုများ</a>
                          @endif
                          {{-- @can('customerOrder-delete')
                            <a href="/customer-orders" class="nav-link text-white">Customer Orders</a>
                          @elsecan('customerOrder-create')
                            <a href="/orders" class="nav-link text-white">Customer Orders</a>
                          @endcan --}}
                        </li>
                        @endcan
                        @can('consigment-list')
                        <li class="nav-item">
                            <a href="/consigments" class="nav-link text-white">Consigment</a>
                        </li>
                        @endcan
                        @can('creditReturn-list')
                        <li class="nav-item">
                            <a href="/credit-returns" class="nav-link text-white">Credit Return</a>
                        </li>
                        @endcan
                        @can('city-list')
                        <li class="nav-item">
                            <a href="/cities" class="nav-link text-white">City</a>
                        </li>
                        @endcan
                        @can('zone-list')
                        <li class="nav-item">
                            <a href="/zones" class="nav-link text-white">Zone</a>
                        </li>
                        @endcan
                        @can('township-list')
                        <li class="nav-item">
                            <a href="/townships" class="nav-link text-white">Township</a>
                        </li>
                        @endcan
                        @can('product-list')
                        <li class="nav-item">
                            <a href="/products" class="nav-link text-white">Product</a>
                        </li>
                        @endcan
                        
                      
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto ">
                        {{-- @foreach (config('app.available_locales') as $locale)
                            <li class="nav-item">
                                <a class="nav-link text-white"
                                href="{{ route(\Illuminate\Support\Facades\Route::currentRouteName(), $locale) }}"
                                    @if (app()->getLocale() == $locale) style="font-weight: bold; text-decoration: underline" @endif>{{ strtoupper($locale) }}</a>
                            </li>
                        @endforeach --}}
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link text-white" href="{{ route('customer_login',app()->getLocale()) }}">{{ __('messages.loginText') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="{{ route('customer_register',app()->getLocale()) }}">{{ __('messages.registerText') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link text-white dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout',app()->getLocale()) }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('ထွက်ရန်') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('changePassword')}}">
                                        လျှို့ဝှက်နံပါတ်ချိန်းရန်
                                     </a>

                                    <form id="logout-form" action="{{ route('logout',app()->getLocale()) }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>   
        <main class="container ">
            <div class="row">
                <div class="col-12 mt-5">
                    @yield('content')
                </div>
            </div>
        </main>
    </div>
</body>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.js'></script>

@stack('scripts')
</html>

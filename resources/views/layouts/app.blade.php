<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <script src="{{ asset('stisla/js/modules/jquery.min.js') }}"></script>
    <script defer src="{{ asset('stisla/js/modules/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('stisla/js/modules/popper.js') }}"></script>
    <script src="{{ asset('stisla/js/modules/bootstrap.min.js') }}"></script>

    <!-- Styles -->
    <link
        href="https://fonts.googleapis.com/css2?family=Nunito+Sans&family=Nunito:wght@400;600;700&family=Open+Sans&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    @vite(['resources/css/app.css'])
    <link rel="stylesheet" href="{{ asset('stisla/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('stisla/css/components.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/notyf/notyf.min.css') }}">

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <!-- Scripts -->
    @vite(['resources/js/app.js'])
    <script src="https://kit.fontawesome.com/1ffc6500c2.js" crossorigin="anonymous"></script>


    <!-- Styles -->
    @livewireStyles
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @stack('styles')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('modals.response-state.style')
</head>

<body class="font-sans antialiased">
    @include('modals.response-state.view')
    @stack('modals')
    <div id="app">
        <div class="main-wrapper">
            <!-- Navbar and sidebar -->
            @include('components.navbar')
            @include('components.sidebar')

            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="section-header">
                        @isset($header_content)
                            {{ $header_content }}
                        @else
                            {{ __('Halaman') }}
                        @endisset
                    </div>
                    <div class="section-body">
                        {{ $slot }}
                    </div>
                </section>
            </div>
        </div>
    </div>
    @include('partials.additional_scripts')


    <!-- General JS Scripts -->
    <script src="{{ asset('stisla/js/modules/tooltip.js') }}"></script>
    <script src="{{ asset('stisla/js/modules/moment.min.js') }}"></script>
    <script src="{{ asset('stisla/js/modules/marked.min.js') }}"></script>
    <script src="{{ asset('vendor/notyf/notyf.min.js') }}"></script>
    <script src="{{ asset('vendor/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('stisla/js/modules/chart.min.js') }}"></script>
    

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    
    
    
    <script src="{{ asset('stisla/js/stisla.js') }}"></script>
    <script src="{{ asset('stisla/js/scripts.js') }}"></script>
    <script src="{{ asset('vendor/select2/select2.min.js') }}"></script>
    @livewireScripts
    @stack('scripts')
    @include('modals.response-state.script')
</body>

</html>

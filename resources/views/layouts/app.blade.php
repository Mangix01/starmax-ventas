<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"
          integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog=="
          crossorigin="anonymous"/>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- datatables -->
        <link href="//cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">
        <link href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css" rel="stylesheet">

        <link href="https://cdn.datatables.net/colreorder/1.5.5/css/colReorder.dataTables.min.css" rel="stylesheet">
        <link href="https://cdn.datatables.net/searchbuilder/1.3.2/css/searchBuilder.dataTables.min.css" rel="stylesheet">

        <link href="{{ asset('css/estilos.css') }}" rel="stylesheet">
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="font-sans antialiased">
        <x-banner />
        <div class="min-h-screen bg-gray-100">
          
            @livewire('navigation-menu')
           
            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif
            @include('layouts.sidebar')
            <!-- Page Content -->
            <div class="content-wrapper">
                <div class="container body-content py-3">
                    <main>
                        {{ $slot }}
                    </main>
                </div>
            </div>
             @include('layouts.footer')
        </div>
        @stack('modals')
        @livewireScripts
        
        <script src="//cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js" defer></script>
        <script src="//cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js" defer></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js" defer></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js" defer></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js" defer></script>
        <script src="//cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js" defer></script>
        <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js" defer></script>

        <script src="https://cdn.datatables.net/searchbuilder/1.3.2/js/dataTables.searchBuilder.min.js" defer></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js" defer></script>
        
        <script src="{{ asset('js/main.js') }}" defer></script>
    </body>
</html>

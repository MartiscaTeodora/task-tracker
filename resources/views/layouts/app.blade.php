<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <script rel="preload" src="https://cdn.tailwindcss.com"></script>
        
        <style>
            div:target {
                box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.1), 0 6px 20px 0 rgba(0, 0, 0, 0.15);
                /*  box-shadow: 10px 10px 5px c; */
                }
        </style>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'To do') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-zinc-50 dark:bg-slate-800 dark:text-white">
        <div class="min-h-screen  selection:bg-orange-200 selection:bg-opacity-50 dark:selection:bg-teal-300 dark:selection:bg-opacity-50 ">
       

            
           

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>

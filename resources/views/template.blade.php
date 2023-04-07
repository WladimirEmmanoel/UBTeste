<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>UB Teste</title>

        <!-- CSS -->
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">

        @yield('style')
        
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">


    </head>
    <body>
        <main>
            <div>
                <div class="logo">
                    <img src="{{ asset('img/unibra-logo.png') }}" alt="UNIBRA" title="UNIBRA">
                </div>
                <div class="box-info">
                    @yield('content')
                </div>
            </div>
        </main>
        
        <!-- Javascript -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="{{ asset('js/scripts.js') }}"></script>
    </body>
</html>
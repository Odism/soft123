<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aprendiendo laravel (layout desde views html5)</title>

    <!-- Todo el codigo CSS va aqui -->
</head>
<body>
    
    @yield('header')

    @yield('content')

    
    <script>
        /*
        Todo el JS javascript aqui
        */
    </script>

    @yield('script')
</body>
</html>
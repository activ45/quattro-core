<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
        <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
        <link href="{{ mix('/css/app.css').'?v='.time() }}" rel="stylesheet" />
        <script src="{{ mix('/js/app.js').'?v='.time()  }}" defer></script>
        @routes
    </head>
    <body class="antialiased">
        @inertia
    </body>

</html>

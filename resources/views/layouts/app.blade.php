<!doctype html>
<head>
    <!-- ... --->
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>App Name - @yield('title')</title>
</head>
<body>
@section('sidebar')
@show

<div class="container">
    @yield('content')
</div>
</body>
</html>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('bootstrap.css') }}" rel="stylesheet">
    <script src="https://kit.fontawesome.com/d31193916e.js" crossorigin="anonymous"></script>
    <title>PetClinic</title>
    {{-- @livewireStyles --}}
</head>

<body>
    <div>
        <x-navbar />

        <div class="container-md p-2 p-md-3 pt-4 pt-sm-5 pt-md-5">
            @yield('content')
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
        </script>
    </div>
    {{-- @livewireScripts --}}
</body>

</html>

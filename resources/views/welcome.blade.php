<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>XenoPHP</title>

    <!-- Bootstrap 5 CSS (Local) -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Fonts (Local handling omitted for simplicity, using system fonts fallback) -->
    <style>
        body {
            font-family: system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
        }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-light text-dark antialiased">
    <div class="min-vh-100 d-flex flex-column align-items-center justify-content-center selection-primary">
        <div class="container text-center">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <main class="mt-5">
                        <h1 class="display-3 fw-bold mb-4 text-dark">
                            Welcome to XenoPHP
                        </h1>
                    </main>

                    <footer class="mt-5 py-4 text-muted border-top">
                        <small>XenoPHP v1 (Laravel v{{ $laravelVersion }} (PHP v{{ $phpVersion }}))</small>
                    </footer>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle (Local) -->
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>

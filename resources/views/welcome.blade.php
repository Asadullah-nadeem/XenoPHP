<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>XenoPHP</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles/Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased font-sans bg-gray-50 dark:bg-[#0f172a] text-black dark:text-white">
    <div class="min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white">
        <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
    
            <main class="mt-6">
                <div class="text-center">
                    <h1 class="text-4xl font-bold tracking-tight text-gray-900 dark:text-gray-100 sm:text-6xl">
                        Welcome to XenoPHP
                    </h1>
                </div>
            </main>

            <footer class="py-16 text-center text-sm text-black dark:text-white/70">
                XenoPHP v1 (Laravel v{{ $laravelVersion }} (PHP v{{ $phpVersion }}))
            </footer>
        </div>
    </div>
</body>
</html>

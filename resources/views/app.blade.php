{{-- resources/views/app.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title inertia>{{ config('app.name', 'Laravel') }}</title>
    @vite('resources/js/app.js')
    @vite('resources/css/app.css')
    @inertiaHead
</head>
<body class="font-sans antialiased bg-gray-50">
    @inertia
</body>
</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>@yield('title', config('app.name'))</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">

    <!-- Navbar -->
    @include('layouts.navigatin')
    
    <!-- Main Content -->
    <main>
        @yield('content')
    </main>
    
    @include('layouts.footer')
    
</body>

</html>

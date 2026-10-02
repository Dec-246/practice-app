<!-- consists of all props (passing an array) that this component requires-->
 <!-- can set default values to Laracasts - If screen does not pass through a title, it will default to Laracasts -->
@props([
 'title' => 'Laracasts'
 ])


<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- title is dynamic -  changes with the custom title on each file -->
    <title>{{ $title }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])


    {{-- <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5/themes.css" rel="stylesheet" type="text/css" /> --}}



    <!-- changing width and styling of card -->
    {{-- <style>
        .max-w-400 {
            max-width: 400px;
            margin: auto;
        }

        .card {
            background: var(--color-base-300);
            color: white;
            padding: 1rem;
            text-align: center;
        }
    </style> --}}



</head>

<!-- ** This file has same purpose as an includes file ** -->
<body class="text-primary">



<x-nav />

    <main class="max-w-3xl mx-auto mt-6">
        <!-- this is like a php echo tag - this 'slots' in html content  -->
        {{ $slot }}
    </main>

</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    @vite('resources/js/app.js')
    @vite('resources/css/app.css') 
    @inertiaHead
    @routes
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Learnihon</title>
    <meta name="description" content="Learnihon — Practice Japanese kana with reading and writing flashcards.">
    <meta name="theme-color" content="#1f2937">
    <!-- Social preview -->
    <meta property="og:title" content="Learnihon">
    <meta property="og:description" content="Practice Japanese kana with reading and writing flashcards.">
    <meta property="og:type" content="website">
    <meta property="og:image" content="/images/logoT.png">
    <meta property="og:image:type" content="image/png">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Learnihon">
    <meta name="twitter:description" content="Practice Japanese kana with reading and writing flashcards.">
    <meta name="twitter:image" content="/images/logoT.png">
    <!-- Icons -->
    <link rel="icon" type="image/png" href="/images/iconT.png">
    <link rel="apple-touch-icon" href="/images/iconT.png">
</head>
<body class="bg-gray-900 text-white">
    @inertia
    <!-- Subtle footer credit -->
    <footer class="fixed bottom-2 left-3 text-[10px] sm:text-xs text-gray-400 opacity-30 select-none">
        Karl Miguel Inciong @ 2025
    </footer>
</body>
</html>
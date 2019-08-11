<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Synthwave Band Name Generator</title>
    <link rel="stylesheet" href="https://use.typekit.net/buw1cbh.css">
    <link rel="stylesheet" href="/css/styles.css">
</head>
<body class="bg-dark text-white font-display">
    <div class="flex flex-col items-center justify-center relative min-h-tall md:min-h-screen h-full w-full md:-mt-4 grid">
        <div class="text-center font-display text-white w-full font-display text-lg relative z-10">
            Synthwave Band Name Generator
        </div>
        @livewire('name')
        <a href="https://jackmcdade.com" class="font-display text-lg hover:text-purple relative mt-8 z-10">Created by Jack McDade</a>
    </div>
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-145403615-1"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'UA-145403615-1');
    </script>
    @livewireAssets
</body>
</html>

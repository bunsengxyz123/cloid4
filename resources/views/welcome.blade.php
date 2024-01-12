<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

</head>

<body class="antialiased">
    <form action="/upload" method="post" enctype="multipart/form-data">
        @csrf
        <label for="file">Choose file to upload:</label>
        <input type="file" id="file" name="file">
        <input type="submit" value="Upload">
    </form>
</body>

</html>
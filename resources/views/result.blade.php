<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Konversi</title>
</head>
<body>
    <h1>Hasil Konversi</h1>
    <div style="display: flex;">
        <div>
            <h3>Original</h3>
            <img src="{{ $original }}" alt="Original Image">
        </div>
        <div>
            <h3>Edited</h3>
            <img src="{{ $edited }}" alt="Edited Image">
        </div>
    </div>
    <a href="{{ route('home') }}">Kembali</a>
</body>
</html>

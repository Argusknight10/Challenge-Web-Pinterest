<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ENT Gallery</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .hero {
            background: url('https://statik.tempo.co/data/2019/06/22/id_850290/850290_720.jpg'); /* Update with your image */
            background-size: cover;
            background-position: center;
            height: 60vh;
            display: flex;
            align-items: flex-end;
            color: white;
            border-radius: 1.5rem;
        }
        .gallery {
            margin: 0 auto;
        }
        .gallery-item {
            margin-bottom: 16px; /* Space between items */
        }
    </style>
</head>
<body class="bg-gray-100">

    <!-- Hero Banner -->
    <div class="hero p-10 mx-8 mt-8  relative"> <!-- Changed mx-8 to mx-4 for consistent margin -->
        <img src="https://png.pngtree.com/png-vector/20211023/ourmid/pngtree-salon-logo-png-image_4004444.png" alt="Logo" class="absolute top-4 left-4 w-24"> <!-- Logo -->
        <div>
            <h1 class="text-4xl font-bold">Memperindah kegiatan dibayar dengan hasilnya</h1>
            <p class="mt-2">EEPIS Media Network</p>
        </div>
    </div>

    <!-- Text Section -->
    <div class="flex justify-between items-center p-8 mx-8"> <!-- Added mx-4 for consistent margin -->
        <h2 class="text-2xl font-bold">Gallery</h2>
        <p class="text-lg font-light">Discover beauty from your own perspective</p>
    </div>

    <!-- Gallery Section -->
    <div class="gallery p-4 mb-6 mx-4 grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4"> <!-- Added mx-4 for consistent margin -->
        @for ($i = 0; $i < 9; $i++)
            <div class="gallery-item">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSvPwuxBhcP25ZMoQ8MI6Ip-F6mDXlI8bDo2w&s" alt="Image {{ $i + 1 }}" class="rounded-lg w-full h-auto shadow-md">
                <p>Judul</p>
            </div>
        @endfor
    </div>

</body>
</html>
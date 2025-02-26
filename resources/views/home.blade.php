<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ENT Galerry</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .hero {
            background-image: url('https://example.com/your-banner-image.jpg'); /* Replace with actual image */
            background-size: cover;
            height: 60vh;
            display: flex;
            align-items: flex-end;
            color: white;
        }
        .gallery {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 16px;
        }
    </style>
</head>
<body class="bg-gray-100">

    <!-- Hero Banner -->
    <div class="hero p-6">
        <div>
            <h1 class="text-4xl font-bold">Memperindah kegiatan dibayar dengan hasilnya</h1>
            <p class="mt-2">EEPIS Media Network</p>
        </div>
    </div>

    <!-- Gallery Section -->
    <div class="gallery p-4">
        @for ($i = 0; $i < 9; $i++)
            <div class="rounded-lg bg-white shadow-md">
                <img src="https://via.placeholder.com/300x200?text=Image+{{ $i + 1 }}" alt="Image {{ $i + 1 }}" class="rounded-t-lg w-full h-auto">
            </div>
        @endfor
    </div>

    <!-- Submit Form -->
    <div class="flex p-4">
        <div class="w-1/2 pr-4">
            <h3 class="text-lg font-semibold">Preview Gambar</h3>
            <img id="imagePreview" src="https://via.placeholder.com/300" alt="Preview" class="rounded-lg shadow-md w-full">
        </div>
        <div class="w-1/2">
            <h3 class="text-lg font-semibold">Submit Gambar</h3>
            <form action="#" method="POST" enctype="multipart/form-data" class="bg-white p-4 rounded-lg shadow-md">
                @csrf
                <input type="file" name="image" id="imageInput" accept="image/*" onchange="previewImage(event)" class="mb-4">
                <input type="text" name="title" placeholder="Judul" required class="w-full p-2 border border-gray-300 rounded mb-4">
                <textarea name="description" placeholder="Deskripsi" required class="w-full p-2 border border-gray-300 rounded mb-4"></textarea>
                <button type="submit" class="bg-blue-500 text-white p-2 rounded">Submit</button>
            </form>
        </div>
    </div>

    <script>
        function previewImage(event) {
            const imagePreview = document.getElementById('imagePreview');
            imagePreview.src = URL.createObjectURL(event.target.files[0]);
        }
    </script>

</body>
</html>
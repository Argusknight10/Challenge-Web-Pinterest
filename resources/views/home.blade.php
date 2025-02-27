<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ENT Gallery</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .hero {
            background: url('https://statik.tempo.co/data/2019/06/22/id_850290/850290_720.jpg'); 
            background-size: cover;
            background-position: center;
            height: 60vh;
            display: flex;
            align-items: flex-end;
            color: white;
            border-radius: 1.5rem;
            background-color: rgba(0, 0, 0, 0.5); 
            background-blend-mode: darken;
        }
        .gallery {
            margin: 0 auto;
            column-count: 2; 
            column-gap: 1rem; 
        }
        .gallery-item {
            break-inside: avoid; 
            margin-bottom: 1rem; 
        }
        .gallery img {
            width: 100%;
            border-radius: 0.5rem; 
            display: block;
            object-fit: cover; 
        }
        @media (min-width: 640px) { 
            .gallery {
                column-count: 2; 
            }
        }
        @media (min-width: 700px) { 
            .gallery {
                column-count: 3; 
            }
        }
        @media (min-width: 1024px) { 
            .gallery {
                column-count: 4; 
            }
        }
    </style>
</head>
<body class="bg-gray-100">

    <x-navbar />
    <!-- Hero Banner -->
    <div class="hero p-10 mx-8 mt-8 relative">
        <div>
            <h1 class="text-4xl font-bold">Memperindah kegiatan dibayar dengan hasilnya</h1>
            <p class="mt-2">EEPIS Media Network</p>
        </div>
    </div>

    <!-- Text Section -->
    <div class="flex justify-between items-center p-8 mx-4">
        <h2 class="text-2xl mx-2 font-bold">Gallery</h2>
        <p class="text-lg mx-2 font-light">Discover beauty from your own perspective</p>
    </div>

    <!-- Gallery Section -->
    <div class="gallery p-4 mb-6 mx-4">
        <div class="gallery-item">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSvPwuxBhcP25ZMoQ8MI6Ip-F6mDXlI8bDo2w&s" alt="Image 1">
            <p class="text-center">Judul 1</p>
        </div>
        <div class="gallery-item">
            <img src="https://static.promediateknologi.id/crop/0x0:0x0/0x0/webp/photo/radarbromo/2022/03/19-foto-Klinikrif1.jpg" alt="Image 2">
            <p class="text-center">Judul 2</p>
        </div>
        <div class="gallery-item">
            <img src="https://tehsusu.com/wp-content/asd-uploads/2019/10/Nikmati-Suasana-Memulai-Percakapan.jpg" alt="Image 3">
            <p class="text-center">Judul 3</p>
        </div>
        <div class="gallery-item">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQvtYLFLK0gacESfBB32okI0SK7d_MoQ_UPAg&s" alt="Image 4">
            <p class="text-center">Judul 4</p>
        </div>
        <div class="gallery-item">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ1tEhL6OIou4p3ZYXasDc60chIYltn7rh-yg&s" alt="Image 5">
            <p class="text-center">Judul 5</p>
        </div>
        <div class="gallery-item">
            <img src="https://www.blibli.com/friends-backend/wp-content/uploads/2023/02/B100123-2-scaled.jpg" alt="Image 6">
            <p class="text-center">Judul 6</p>
        </div>
        <div class="gallery-item">
            <img src="https://i.pinimg.com/474x/db/88/8c/db888cbda4f6edeff9c9b8e6c4bf9a3c.jpg" alt="Image 7">
            <p class="text-center">Judul 7</p>
        </div>
        <div class="gallery-item">
            <img src="https://awsimages.detik.net.id/customthumb/2013/05/06/1279/dsc_65431.jpg?w=600&q=90" alt="Image 8">
            <p class="text-center">Judul 8</p>
        </div>
    </div>

    <!-- Upload Section -->
    <h1 class="text-xl font-bold mx-8 my-4">Upload Foto</h1>
    <div class="flex flex-col md:flex-row p-8 mx-8 my-8 bg-white rounded-lg shadow-md" id="upload">
        <div class="w-full md:w-1/2 pr-0 md:pr-4 mb-4 md:mb-0">
            <h3 class="text-xl font-bold mb-2">Preview Gambar</h3>
            <div id="imagePlaceholder" class="w-full h-64 bg-gray-300 rounded flex items-center justify-center" style="display: flex;">
                <span class="text-gray-500">Tidak ada gambar yang dipilih</span>
            </div>
            <img id="imagePreview" src="" alt="Preview" class="w-full object-contain rounded" style="display: none; max-height: 300px;">
        </div>
        <div class="w-full md:w-1/2 pl-0 md:pl-4">
            <form id="uploadForm">
                <div class="mb-4">
                    <label for="title" class="block text-sm font-medium text-gray-700">Judul</label>
                    <input type="text" id="title" name="title" class="mt-1 block w-full border rounded-md shadow-sm focus:ring focus:ring-opacity-50" required>
                </div>
                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                    <textarea id="description" name="description" rows="3" class="mt-1 block w-full border rounded-md shadow-sm focus:ring focus:ring-opacity-50" required></textarea>
                </div>
                <div class="mb-4">
                    <label for="file" class="block text-sm font-medium text-gray-700">Pilih Foto</label>
                    <input type="file" id="file" name="file" accept="image/*" class="mt-1 block w-full border rounded-md shadow-sm focus:ring focus:ring-opacity-50" onchange="previewImage(event)" required>
                </div>
                <button type="submit" class="mt-2 w-full bg-blue-500 text-white py-2 rounded-md hover:bg-blue-600">Submit</button>
            </form>
        </div>
    </div>

    <x-footer />

    <script>
        function previewImage(event) {
            const file = event.target.files[0];
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.getElementById('imagePreview');
                const placeholder = document.getElementById('imagePlaceholder');
                img.src = e.target.result;
                img.style.display = 'block';
                placeholder.style.display = 'none'; // Hide the placeholder
            }
            reader.readAsDataURL(file);
        }
    </script>

</body>
</html>
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

    <!-- Hero Banner -->
    <div class="hero p-10 mx-8 mt-8 relative">
        <div>
            <h1 class="text-4xl font-bold">Memperindah kegiatan dibayar dengan hasilnya</h1>
            <p class="mt-2">EEPIS Media Network</p>
        </div>
    </div>

    <!-- Text Section -->
    <div class="flex justify-between items-center p-8 mx-8">
        <h2 class="text-2xl font-bold">Gallery</h2>
        <p class="text-lg font-light">Discover beauty from your own perspective</p>
    </div>

    <!-- Gallery Section -->
    <div class="gallery p-4 mb-6 mx-4">
        @forelse ($photos as $photos)
        <div class="gallery-item">
            <img class="border" src="{{ asset('storage/' . $photos->image) }}" alt="{{ $photos->slug }}">
            <p class="text-center">{{ $photos->title }}</p>
        </div>
        @empty
        <div class="w-full flex justify-center">
            <div class="px-6 py-4 bg-gray-100 rounded-lg shadow-md dark:bg-gray-700 flex items-center">
                <svg viewBox="0 0 40 40" class="w-8 h-8 mr-3 fill-current text-gray-500">
                    <path d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM21.6667 28.3333H18.3334V25H21.6667V28.3333ZM21.6667 21.6666H18.3334V11.6666H21.6667V21.6666Z"></path>
                </svg>
                <p class="text-lg text-gray-500 dark:text-gray-300">Tidak ada artikel yang dipublikasikan</p>
            </div>
        </div>
        @endempty
    </div>

    <!-- Upload Section -->

        <h3 class="text-xl font-bold mx-2">Upload Foto</h3>
        <div class="flex p-8 mx-8 my-8 bg-white rounded-lg shadow-md">
            <div class="w-1/2 pr-4">
                 <h3 class="text-xl font-bold mb-2">Preview Gambar</h3>
                <img id="imagePreview" src="" alt="Preview" class="w-full object-contain rounded" style="display: none; max-height: 300px;">
            </div>
            <div class="w-1/2 pl-4">
                <form action="{{ route('photos.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label for="title" class="block text-sm font-medium text-gray-700">Judul</label>
                        <input type="text" id="title" name="title" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50" required>
                    </div>
                    <div class="mb-4">
                        <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                        <textarea id="description" name="description" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50" required></textarea>
                    </div>
                    <div class="mb-4">
                        <label for="image" class="block text-sm font-medium text-gray-700">Pilih Foto</label>
                        <input type="file" id="image" name="image" accept="image/*" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50" onchange="previewImage(event)" required>
                    </div>
                    <button type="submit" class="mt-2 w-full bg-blue-500 text-white py-2 rounded-md hover:bg-blue-600">Submit</button>
                </form>
            </div>
        </div>

    <script>
        function previewImage(event) {
            const file = event.target.files[0];
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.getElementById('imagePreview');
                img.src = e.target.result;
                img.style.display = 'block';
            }
            reader.readAsDataURL(file);
        }
    </script>

</body>
</html>
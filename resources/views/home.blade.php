<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ENT Gallery</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>

    <style>
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

    <x-navbar></x-navbar>

    <div class="max-w-screen-lg mx-auto px-4 lg:px-8">
        <div class="relative h-60 lg:h-96 bg-cover bg-center rounded-2xl flex items-end text-white p-10" style="background-image: url('https://statik.tempo.co/data/2019/06/22/id_850290/850290_720.jpg');">
            <div>
                <h1 class="text-2xl md:text-4xl font-bold">Memperindah kegiatan dibayar dengan hasilnya</h1>
                <p class="mt-2">EEPIS Media Network</p>
            </div>
        </div>

        <div class="flex flex-col md:flex-row justify-between items-center py-8">
            <h2 class="text-2xl font-bold">Gallery</h2>
            <p class="text-lg font-light text-center md:text-right">Discover beauty from your own perspective</p>
        </div>

        <div class="gallery p-4 mb-6 mx-4">
            @forelse ($photos as $photos)
            <div class="gallery-item">
                <img class="w-full object-cover rounded-lg border" src="{{ asset('storage/' . $photos->image) }}" alt="{{ $photos->slug }}">
                <p class="text-center mt-2">{{ $photos->title }}</p>
            </div>
            @empty
            <div class="col-span-full flex justify-center">
                <div class="px-6 py-4 bg-gray-100 rounded-lg shadow-md dark:bg-gray-700 flex items-center">
                    <svg viewBox="0 0 40 40" class="w-8 h-8 mr-3 fill-current text-gray-500">
                        <path d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM21.6667 28.3333H18.3334V25H21.6667V28.3333ZM21.6667 21.6666H18.3334V11.6666H21.6667V21.6666Z"></path>
                    </svg>
                    <p class="text-lg text-gray-500 dark:text-gray-300">Tidak ada artikel yang dipublikasikan</p>
                </div>
            </div>
            @endempty
        </div>

        <hr>

        <h3 class="text-2xl py-6 font-bold">Upload Foto</h3>
        <div class="flex flex-col md:flex-row bg-white rounded-lg shadow-2xl mb-8 p-8" id="upload">
            <div class="md:w-1/2 lg:pr-4">
                <h3 class="text-xl font-bold mb-2">Preview Gambar</h3>
                <div id="imagePlaceholder" class="w-full h-72 bg-gray-200 rounded flex items-center justify-center text-gray-500">
                    Tidak ada gambar yang dipilih
                </div>
                <img id="imagePreview" src="" alt="Preview" class="w-full object-contain rounded hidden max-h-72">
            </div>
            <div class="md:w-1/2 lg:pl-4">
                <form action="{{ route('photos.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="lg:mb-4 my-4">
                        <label for="title" class="block text-sm font-medium text-gray-700">Judul</label>
                        <input type="text" id="title" name="title" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50 p-2" required>
                    </div>
                    <div class="mb-4">
                        <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                        <textarea id="description" name="description" rows="3" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50 p-2" required></textarea>
                    </div>
                    <div class="mb-4">
                        <label for="image" class="block text-sm font-medium text-gray-700">Pilih Foto</label>
                        <input type="file" id="image" name="image" accept="image/*" class="mt-1 block w-full  border border-gray-300  rounded-md shadow-sm focus:ring focus:ring-opacity-50" onchange="previewImage(event)" required>
                    </div>
                    <button type="submit" class="mt-2 w-full bg-blue-500 text-white py-2 rounded-md hover:bg-blue-600">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <x-footer></x-footer>

    <script>
        function previewImage(event) {
            const file = event.target.files[0];
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.getElementById('imagePreview');
                const placeholder = document.getElementById('imagePlaceholder');
                img.src = e.target.result;
                img.classList.remove('hidden');
                placeholder.style.display = 'none'; 
            }
            reader.readAsDataURL(file);
        }
    </script>

</body>
</html>

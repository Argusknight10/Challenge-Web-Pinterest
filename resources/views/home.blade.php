<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ENT Gallery</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="">
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
            @forelse ($photos as $photo)
            <div class="gallery-item">
                <img src="{{ asset('storage/' . $photo->image) }}" alt="{{ $photo->slug }}" onclick="openModal('{{ asset('storage/' . $photo->image) }}', '{{ $photo->title }}', '{{ $photo->description }}')">
                <p class="text-center mt-2">{{ $photo->title }}</p>
                <div class="edit-delete-buttons">
                    <button class="bg-blue-500 text-white px-2 pt-1 rounded-md" onclick="openEditModal('{{ $photo->id }}', '{{ $photo->title }}', '{{ $photo->description }}', '{{ asset('storage/' . $photo->image) }}')">
                        <box-icon name='edit-alt'></box-icon>
                    </button>
                    <button class="bg-red-500 text-white px-2 pt-1 rounded-md" onclick="deletePhoto('{{ $photo->id }}')">
                        <box-icon name='trash'></box-icon>
                    </button>
                </div>
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
        <div class="flex flex-col md:flex-row bg-white rounded-lg shadow-2xl mb-8 p-8">
            <div class="md:w-1/2 pr-4">
                <h3 class="text-xl font-bold mb-2">Preview Gambar</h3>
                <img id="imagePreview" src="" alt="Preview" class="w-full object-contain rounded hidden max-h-72">
            </div>
            <div class="md:w-1/2 pl-4">
                <form action="{{ route('photos.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label for="title" class="block text-sm font-medium text-gray-700">Judul</label>
                        <input type="text" id="title" name="title" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50" required>
                        @error('title')
                            <span class="w-full text-sm text-red-600">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                        <textarea id="description" name="description" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50" required></textarea>
                        @error('description')
                            <span class="w-full text-sm text-red-600">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="image" class="block text-sm font-medium text-gray-700">Pilih Foto</label>
                        <input type="file" id="image" name="image" accept="image/*" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50" onchange="previewImage(event)" required>
                        @error('image')
                            <span class="w-full text-sm text-red-600">{{ $message }}</span>
                        @enderror
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
                img.src = e.target.result;
                img.classList.remove('hidden');
            }
            reader.readAsDataURL(file);
        }
    </script>
</body>
</html>

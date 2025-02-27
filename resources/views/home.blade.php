<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>ENT Gallery</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="icon" href="https://taplink.st/a/7/7/3/5/51cde8.svg?4gir" type="image/x-icon">
    <style>
        .gallery {
            margin: 0 auto;
            column-count: 2; 
            column-gap: 1rem; 
        }
        .gallery-item {
            break-inside: avoid; 
            margin-bottom: 1rem; 
            position: relative; 
        }
        .gallery img {
            width: 100%;
            border-radius: 1.5rem; 
            display: block;
            object-fit: cover; 
            cursor: pointer; 
        }
        .edit-delete-buttons {
            display: none; 
            position: absolute;
            top: 10px;
            right: 10px;
            background: rgba(255, 255, 255, 0.8);
            border-radius: 5px;
            padding: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }
        .gallery-item img {
            transition: opacity 0.3s ease-in-out; /* Animasi perubahan transparansi */
        }
        .gallery-item:hover img {
            opacity: 0.7; 
        }

        .gallery-item {
            transition: opacity 0.3s ease-in-out;
        }
        .gallery-item:hover .edit-delete-buttons {
            display: block; /* Tampilkan tombol saat hover */
            z-index: 2;
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
        /* Modal Styles */
        .modal {
            display: none; 
            position: fixed;
            z-index: 50;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.7); 
        }
        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 30px;
            border: 1px solid #888;
            width: 100%;
            max-width: 800px; 
            border-radius: 12px; 
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
        .hero {
            position: relative; 
            background-image: url('storage/photos/IMG_9834.JPG');
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: flex-end;
            color: white;
            border-radius: 1.5rem;
        }
        .hero::before {
            content: ""; 
            position: absolute; 
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5); /* Warna hitam dengan transparansi 50% */
            border-radius: 1.2rem; /* Pastikan border-radius sama dengan .hero */
            z-index: 1; /* Pastikan overlay berada di atas gambar */

        }
        .hero > div {
            position: relative; 
            z-index: 2; 
        }
        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 1rem;
        }

        .pagination li {
            margin: 0 0.5rem;
        }

        .pagination a {
            padding: 0.5rem 1rem;
            background-color: #007bff;
            color: white;
            border-radius: 0.25rem;
            text-decoration: none;
        }

        .pagination .disabled {
            background-color: #e0e0e0;
            color: #6c757d;
        }
    </style>
</head>
<body>

    <x-navbar></x-navbar>

        <div class="max-w-screen-lg mx-auto px-4 lg:px-8">
            <div class="relative h-60 lg:h-96 bg-cover bg-center rounded-2xl flex items-end text-white p-10 hero">
                <div>
                    <h1 class="text-2xl md:text-4xl font-bold">Memperindah Kegiatan Dibayar Dengan Hasilnya</h1>
                    <p class="mt-2">EEPIS News And Network Team</p>
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
                        <button class="text-white px-2 pt-1 rounded-md" onclick="openEditModal('{{ $photo->id }}', '{{ $photo->title }}', '{{ $photo->description }}', '{{ asset('storage/' . $photo->image) }}')">
                            <box-icon name='edit-alt'></box-icon>
                        </button>
                        <form action="{{ route('photos.destroy', $photo->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-white px-2 pt-1 rounded-md" onclick="return confirm('Anda yakin ingin menghapus foto ini?')">
                                <box-icon name='trash'></box-icon>
                            </button>
                        </form>
                    </div>
                </div>
                @empty
                <div class="col-span-full flex justify-center">
                    <div class="px-6 py-4 bg-gray-100 rounded-lg shadow-md dark:bg-gray-700 flex items-center">
                        <p class="text-lg text-gray-500 dark:text-gray-300"> Tidak ada gambar yang dipublikasikan</p>
                    </div>
                </div>
                @endempty
            </div>

        <!-- Pagination Links -->
        <div class="w-full flex justify-center mt-8 mb-16 mx-4">
            {{ $photos->links('vendor.pagination.bootstrap-4') }}
        </div>

        <hr>

        <h3 class="text-2xl py-6 font-bold">Upload Foto</h3>
        <div class="flex flex-col md:flex-row bg-white rounded-lg shadow-2xl mb-10 p-8" id="upload">
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
                        <input type="text" id="title" name="title" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50 p-2" value="{{ old('title') }}" required>
                        @error('title')
                            <span class="w-full text-sm text-red-600">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                        <textarea id="description" name="description" rows="3" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50 p-2" required>{{ old('description') }}</textarea>
                        @error('description')
                            <span class="w-full text-sm text-red-600">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="image" class="block text-sm font-medium text-gray-700">Pilih Foto</label>
                        <input type="file" id="image" name="image" accept="image/*" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50" onchange="previewImage(event)" required>
                        @error('image')
                            <span class="w-full text-sm text-red-600">{{ $message }}</span>
                        @enderror
                    </div>
                    <button type="submit" class="mt-2 w-full text-white py-2 rounded-md hover:bg-blue-600" style=" background-color: #3B70AD;">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal untuk Edit -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeEditModal()">&times;</span>
            <form id="editForm" action="{{ route('photos.update', 'photoId') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="lg:mb-4 my-4">
                    <label for="editTitle" class="block text-sm font-medium text-gray-700">Judul</label>
                    <input type="text" id="editTitle" name="title" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50 p-2" value="{{ old('title', $photo->title) }}" required>
                    @error('title')
                        <span class="w-full text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="editDescription" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                    <textarea id="editDescription" name="description" rows="3" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50 p-2" required>{{ old('description', $photo->description) }}</textarea>
                    @error('description')
                        <span class="w-full text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="editImage" class="block text-sm font-medium text-gray-700">Pilih Foto</label>
                    <input type="file" id="editImage" name="image" accept="image/*" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50" onchange="previewEditImage(event)">
                    @error('image')
                        <span class="w-full text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>
                <img id="editImagePreview" src="" alt="Preview" class="w-full object-contain rounded hidden max-h-72 mb-4">
                <button type="submit" class="mt-2 w-full bg-blue-500 text-white py-2 rounded-md hover:bg-blue-600">Update</button>
            </form>
        </div>
    </div>

    <!-- Modal untuk Gambar -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <div class="flex">
                <img id="modalImage" src="" alt="" class="w-1/2 rounded">
                <div class="ml-4">
                    <h2 id="modalTitle" class="text-xl font-bold"></h2>
                    <p id="modalDescription" class="mt-2"></p>
                </div>
            </div>
        </div>
    </div>

    <x-footer></x-footer>

    <script>
        function smoothScroll(event) {
            event.preventDefault();
            const targetId = event.currentTarget.getAttribute("href");
            const targetElement = document.querySelector(targetId);
            targetElement.scrollIntoView({ behavior: 'smooth' });
        }
        
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

        function openModal(imageSrc, title, description) {
            document.getElementById('modalImage').src = imageSrc;
            document.getElementById('modalTitle').innerText = title;
            document.getElementById('modalDescription').innerText = description;
            document.getElementById('myModal').style.display = "block";
        }

        function closeModal() {
            document.getElementById('myModal').style.display = "none";
        }

        function openEditModal(photoId, title, description, imageSrc) {
            document.getElementById('editTitle').value = title;
            document.getElementById('editDescription').value = description;
            document.getElementById('editImagePreview').src = imageSrc; 
            document.getElementById('editForm').action = "{{ route('photos.update', '') }}" + '/' + photoId;
            document.getElementById('editModal').style.display = "block";
        }

        function closeEditModal() {
            document.getElementById('editModal').style.display = "none";
        }

        function previewEditImage(event) {
            const file = event.target.files[0];
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.getElementById('editImagePreview');
                img.src = e.target.result; 
                img.classList.remove('hidden');
            }
            reader.readAsDataURL(file);
        }

        window.onclick = function(event) {
            if (event.target == document.getElementById('myModal')) {
                closeModal();
            } else if (event.target == document.getElementById('editModal')) {
                closeEditModal();
            }
        }
    </script>

    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>

</body>
</html>
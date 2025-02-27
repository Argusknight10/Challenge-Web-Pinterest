<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>ENT Gallery</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
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
            border-radius: 0.5rem; 
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
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 600px; 
            border-radius: 8px; 
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
    </style>
</head>
<body>

    <x-navbar></x-navbar>

    <div class="max-w-screen-lg mx-auto px-4 lg:px-8">
        <div class="relative h-60 lg:h-96 bg-cover bg-center rounded-2xl flex items-end text-white p-10 hero">
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
                    <button class="text-white px-2 pt-1 rounded-md" onclick="openEditModal('{{ $photo->id }}', '{{ $photo->title }}', '{{ $photo->description }}', '{{ asset('storage/' . $photo->image) }}')">
                        <box-icon name='edit-alt'></box-icon>
                    </button>
                    {{-- <button class="text-white px-2 pt-1 rounded-md" onclick="deletePhoto('{{ $photo->id }}')">
                        <box-icon name='trash'></box-icon>
                    </button> --}}
                    <form action="{{ route('photos.destroy', $photo->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-white px-2 pt-1 rounded-md" onclick="return confirm('Anda yakin ingin menghapus foto ini?')">
                            <box-icon name='trash'></box-icon>
                        </button>
                    </form>
            

                    {{-- <form action="{{ route('admin.articles.destroy', $article->slug) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            onclick="return confirm('Anda yakin ingin mengarsip artikel ini?')">
                            <div class="bg-red-500 hover:bg-gray-400 p-2 rounded-lg w-fit">
                                <svg class="w-5 h-5 text-gray-200 dark:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 18">
                                    <path stroke="currentColor" stroke-linecap="round"
                                        stroke-linejoin="round" stroke-width="2"
                                        d="M1 5h16M7 8v8m4-8v8M7 1h4a1 1 0 0 1 1 1v3H6V2a1 1 0 0 1 1-1ZM3 5h12v13a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V5Z" />
                                </svg>
                            </div>
                        </button>
                    </form> --}}
                </div>
            </div>
            @empty
            <div class="col-span-full flex justify-center">
                <div class="px-6 py-4 bg-gray-100 rounded-lg shadow-md dark:bg-gray-700 flex items-center">
                    <svg viewBox="0 0 40 40" class="w-8 h-8 mr-3 fill-current text-gray-500">
                        <path d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM21.6667 28.3333H18.3334V25H21.6667V28.3333ZM21.6667 21.6666H18.3334V11.6666H21.6667V21.6666Z"></path>
                    </svg>
                    <p class="text-lg text-gray-500 dark:text-gray-300"> Tidak ada artikel yang dipublikasikan</p>
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
                    <button type="submit" class="mt-2 w-full bg-blue-500 text-white py-2 rounded-md hover:bg-blue-600">Submit</button>
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

        // function deletePhoto(photoId) {
        //     if (confirm('Are you sure you want to delete this photo?')) {
        //         alert('Photo with ID: ' + photoId + ' has been deleted.');
        //     }
        // }

        function deletePhoto(photoId) {
            console.log('Deleting photo with ID:', photoId); // Tambahkan ini
            if (confirm('Are you sure you want to delete this photo?')) {
                fetch(`/photos/${photoId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json',
                    },
                })
                .then(response => {
                    console.log('Response:', response); // Tambahkan ini
                    if (response.ok) {
                        alert('Photo has been deleted.');
                        location.reload(); // Reload halaman untuk memperbarui tampilan
                    } else {
                        alert('Failed to delete photo.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while deleting the photo.');
                });
            }
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
<nav class="bg-white sticky top-0 z-10">
    <div class="max-w-screen-lg mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <div class="flex items-center">
                <!-- Logo -->
                <div class="flex-shrink-0">
                    <a href="{{ url('/') }}">
                        <img src="https://taplink.st/a/7/7/3/5/51cde8.svg?4" alt="Logo" class="h-16 w-16">
                    </a>
                </div>
            </div>
            <div class="flex items-center">
                <!-- Navigation Links -->
                <a href="{{ url('/') }}" class="text-gray-700 hover:text-gray-900 mx-2 px-3 py-2 rounded-md text-sm font-medium">Home</a>
                <a href="#upload" class="bg-custom-blue text-white hover:bg-blue-600 mx-2 px-3 py-2 rounded-md text-sm font-medium">Upload Photo</a> <!-- Updated Upload button -->
            </div>
        </div>
    </div>
</nav>

<style>
    .bg-custom-blue {
        background-color: #3B70AD;
    }
</style>
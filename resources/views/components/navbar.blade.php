<nav class="bg-white shadow sticky top-0 z-10">
    <div class="mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="flex-shrink-0">
                    <a href="{{ url('/') }}">
                        <img src="https://taplink.st/a/7/7/3/5/51cde8.svg?4" alt="Logo" class="h-14 w-14">
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
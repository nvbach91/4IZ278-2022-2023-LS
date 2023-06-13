@if (session()->has('message'))
    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 5000)" x-show="show"
        class="fixed top-0 left-1/2 transform -translate-x-1/2 px-8 py-4 bg-gray-800 text-white">
        <p>{{ session('message') }}</p>
    </div>
@endif

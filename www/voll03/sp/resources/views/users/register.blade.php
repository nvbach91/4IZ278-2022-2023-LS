<x-layout>
    <main class="m-auto mt-4 p-8 lg:w-[1024px] w-full flex flex-col items-center">
        <h2 class="text-3xl">Registration</h2>
        <form method="POST" action="{{ route('registration') }}" class="m-8 p-8 w-[400px] bg-gray-100">
            @csrf
            <div class="flex items-center mt-2 mb-2">
                <label for="name" class="w-[128px]">Name</label>
                <input id="name" name="name" type="text" value="{{ old('name') }}" required
                    class="grow m-1 p-1 text-black">
            </div>
            @error('name')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
            <div class="flex items-center mt-2 mb-2">
                <label for="email" class="w-[128px]">Email</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" required
                    class="grow m-1 p-1 text-black">
            </div>
            @error('email')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
            <small class="opacity-70">Example: jack@oneill.com</small>
            <div class="flex items-center mt-2 mb-2">
                <label for="password" class="w-[128px]">Password</label>
                <input id="password" name="password" type="password" value="" required
                    class="grow m-1 p-1 text-black">
            </div>
            @error('password')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
            <div class="flex items-center mt-2 mb-2">
                <label for="password_check" class="w-[128px]">Password (repeat)</label>
                <input id="password_check" name="password_check" type="password" value="" required
                    class="grow m-1 p-1 text-black">
            </div>
            @error('password_check')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
            <hr class="mt-4 pt-2">
            <small class="opacity-70 text-[12px]">Password must contain at least one capital letter, one digit and must be at least 8 letters long.</small>
            <hr class="mt-4 pt-2">
            <button type="submit"
                class="block m-auto mt-4 py-2 px-4 border-2 text-white border-[#0c1435] bg-gray-900 hover:bg-gray-800 hover:border-gray-800">Submit</button>
        </form>
        <div class="flex flex-col items-center px-8">
            <p>Already have an account? <a href="{{ url('/login') }}"
                    class="text-gray-900 font-bold hover:underline">click here to login!</a></p>
            <a class="my-8 px-4 w-[200px] text-center rounded-md text-gray-900 hover:underline"
                href="{{ url('/') }}">Back to
                Homepage</a>
        </div>
    </main>
</x-layout>

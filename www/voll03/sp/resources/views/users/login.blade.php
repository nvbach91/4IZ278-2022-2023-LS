<x-layout>
    <main class="m-auto mt-4 p-8 lg:w-[1024px] w-full flex flex-col items-center">
        <h2 class="text-3xl">Login</h2>
        <form method="POST" action="{{ route('sign-in') }}" class="m-8 p-8 w-[400px] bg-gray-100">
            @csrf
            <div class="flex items-center mt-2 mb-2">
                <label for="email" class="w-[128px]">Email</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" required
                    class="grow m-1 p-1 text-black">
            </div>
            @error('email')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
            <div class="flex items-center mt-2 mb-2">
                <label for="password" class="w-[128px]">Password</label>
                <input id="password" name="password" type="password" value="" required
                    class="grow m-1 p-1 text-black">
            </div>
            <button type="submit"
                class="block m-auto mt-4 py-2 px-4 border-2 text-white border-[#0c1435] bg-gray-900 hover:bg-gray-800 hover:border-gray-800">Sign
                In</button>
        </form>
        <div class="flex flex-col items-center px-8">
            <p>Donb't have an account? <a href="{{ url('/register') }}"
                    class="text-gray-900 font-bold hover:underline">click here to register!</a></p>
            <a class="my-8 px-4 w-[200px] text-center rounded-md text-gray-900 hover:underline"
                href="{{ url('/') }}">Back to
                Homepage</a>
        </div>
    </main>
</x-layout>

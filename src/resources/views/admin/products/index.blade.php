<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin Panel - Products') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <table class="w-full">
                        <thead>
                            <tr>
                                <th class="border-b border-gray-200 p-2 text-center">Product</th>
                                <th class="border-b border-gray-200 p-2 text-center">Price</th>
                                <th class="border-b border-gray-200 p-2 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td class="border-b border-gray-200 p-2 text-center">{{ $product->name }}</td>
                                    <td class="border-b border-gray-200 p-2 text-center">{{ $product->price }}</td>
                                    <td class="border-b border-gray-200 p-2 text-center">
                                        <a href="{{ route('admin.products.edit', $product->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

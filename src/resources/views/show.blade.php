<!-- resources/views/orders/show.blade.php -->

@section('title', 'Order Details')

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Order Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-xl font-bold">Order Number: {{ $order->order_num }}</h3>
                    <p>Date: {{ $order->created_at->format('Y-m-d') }}</p>
                    <p>Status: {{ $order->status }}</p>

                    <table class="w-full mt-4">
                        <thead>
                            <tr>
                                <th class="border-b border-gray-200 p-2 text-center">Product</th>
                                <th class="border-b border-gray-200 p-2 text-center">Quantity</th>
                                <th class="border-b border-gray-200 p-2 text-center">Price</th>
                                <th class="border-b border-gray-200 p-2 text-center">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->products as $product)
                                <tr>
                                    <td class="border-b border-gray-200 p-2 text-center">{{ $product->name }}</td>
                                    <td class="border-b border-gray-200 p-2 text-center">{{ $product->pivot->quantity }}</td>
                                    <td class="border-b border-gray-200 p-2 text-center">{{ $product->pivot->price }}</td>
                                    <td class="border-b border-gray-200 p-2 text-center">{{ $product->pivot->price * $product->pivot->quantity }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="text-right mt-4">
                        <p class="font-bold">Order Total: {{ $order->total_sum }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

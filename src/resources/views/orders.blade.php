@section('title', 'Orders')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Order History') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                <form action="{{ route('orders') }}" method="get">
                    <input type="text" name="search" value="{{ $search }}" placeholder="Order number" class="bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 p-2 border border-gray-300 rounded">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Search</button>
                </form>

                    <table class="w-full">
                        <thead>
                            <tr>
                                <th class="border-b border-gray-200 p-2 text-center">
                                    <a href="{{ route('orders', ['sort_by' => 'order_num', 'sort_order' => $sortOrder == 'asc' ? 'desc' : 'asc', 'search' => $search]) }}">Order Number</a>
                                </th>
                                <th class="border-b border-gray-200 p-2 text-center">Total Sum</th>
                                <th class="border-b border-gray-200 p-2 text-center">
                                    <a href="{{ route('orders', ['sort_by' => 'status', 'sort_order' => $sortOrder == 'asc' ? 'desc' : 'asc', 'search' => $search]) }}">Status</a>
                                </th>
                                <th class="border-b border-gray-200 p-2 text-center">
                                    <a href="{{ route('orders', ['sort_by' => 'created_at', 'sort_order' => $sortOrder == 'asc' ? 'desc' : 'asc', 'search' => $search]) }}">Date</a>
                                </th>
                                <th class="border-b border-gray-200 p-2 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <td class="border-b border-gray-200 p-2 text-center">{{ $order->order_num }}</td>
                                    <td class="border-b border-gray-200 p-2 text-center">{{ $order->total_sum }}</td>
                                    <td class="border-b border-gray-200 p-2 text-center">{{ $order->status }}</td>
                                    <td class="border-b border-gray-200 p-2 text-center">{{ $order->created_at->format('Y-m-d') }}</td>
                                    <td class="border-b border-gray-200 p-2 text-center">
                                        <a href="{{ route('show', $order->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Show</a>
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

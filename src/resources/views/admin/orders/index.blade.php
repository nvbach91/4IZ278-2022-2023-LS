@section('title', 'Admin Panel - Orders')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin Panel - Orders') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                <form action="{{ route('admin.orders.index') }}" method="get">
                    <input type="text" name="search_order" value="{{ $search_order }}" placeholder="Order number" class="bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 p-2 border border-gray-300 rounded">
                    <input type="text" name="search_email" value="{{ $search_email }}" placeholder="Email" class="bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 p-2 border border-gray-300 rounded">
                    <x-primary-button class="ml-2">
                        {{ __('Search') }}
                    </x-primary-button>
                </form>
                    <table class="w-full">
                        <thead>
                            <tr>
                            <th class="border-b border-gray-200 p-2 text-center">
                                <a href="{{ route('admin.orders.index', ['sort_by' => 'order_num', 'sort_order' => $sortOrder === 'asc' ? 'desc' : 'asc']) }}">Order Number</a>
                                </th>
                                <th class="border-b border-gray-200 p-2 text-center">
                                    <a href="{{ route('admin.orders.index', ['sort_by' => 'user_email', 'sort_order' => $sortOrder === 'asc' ? 'desc' : 'asc']) }}">Email</a>
                                </th>
                                <th class="border-b border-gray-200 p-2 text-center">
                                    <a href="{{ route('admin.orders.index', ['sort_by' => 'total_sum', 'sort_order' => $sortOrder === 'asc' ? 'desc' : 'asc']) }}">Total Sum</a>
                                </th>
                                <th class="border-b border-gray-200 p-2 text-center">
                                 <a href="{{ route('admin.orders.index', ['sort_by' => 'status', 'sort_order' => $sortOrder === 'asc' ? 'desc' : 'asc']) }}">Status</a>
                                </th>
                                <th class="border-b border-gray-200 p-2 text-center">
                                    <a href="{{ route('admin.orders.index', ['sort_by' => 'created_at', 'sort_order' => $sortOrder === 'asc' ? 'desc' : 'asc']) }}">Date</a>
                                </th>
                                <th class="border-b border-gray-200 p-2 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <td class="border-b border-gray-200 p-2 text-center">{{ $order->order_num }}</td>
                                    <td class="border-b border-gray-200 p-2 text-center">{{ $order->user_email }}</td>
                                    <td class="border-b border-gray-200 p-2 text-center">{{ $order->total_sum }}</td>
                                    <td class="border-b border-gray-200 p-2 text-center">
                                    <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <select name="status" class="bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 p-2 border border-gray-300 rounded" onchange="this.form.submit()">
                                        <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>Processing</option>
                                        <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>Completed</option>
                                        <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                        </select>
                                    </form>

                                    </td>
                                    <td class="border-b border-gray-200 p-2 text-center">{{ $order->created_at->format('Y-m-d') }}</td>
                                    <td class="border-b border-gray-200 p-2 text-center">
                                        <a href="{{ route('admin.orders.show', $order->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                        <x-primary-button class="ml-2">
                                            {{ __('More') }}
                                        </x-primary-button>
                                        </a>
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

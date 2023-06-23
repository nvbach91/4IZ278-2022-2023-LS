@extends('layouts.admin')

@section('content')
    <div class="list-group">
        <h2>Orders:</h2>
        @foreach ($orders as $order)
            <div class="list-group-item list-group-item-action flex-column align-items-start active mb-1">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">Order ID: {{ $order->id }}</h5>
                </div>
                <h6 class="mb-1">User ID: {{ $order->user_id }}</h6>
                <p class="mb-1">Payment method: {{ $order->payment_method }}</p>
                <p class="mb-1">Status: {{ $order->status }}</p>

                <small>Created: {{ $order->created_at }};</small>
                <small>Updated: {{ $order->updated_at }};</small>
                <form method="POST" action="{{ route('change_order_status') }}">
                    @csrf

                    <input type="hidden" name="id" value="{{ $order->id }}">

                    <select class="form-control form-control-sm" name="status">
                        <option>received</option>
                        <option>sent</option>
                        <option>finished</option>
                    </select>
                    <button type="submit" class="btn btn-primary">Change status</button>
                </form>
            </div>
        @endforeach
        {!! $orders->links('pagination::bootstrap-4') !!}
    </div>

    <div class="list-group">
        <h2>Products:</h2>
        <a href="{{ route('add_product_page') }}"
            class="list-group-item list-group-item-action flex-column align-items-start active mb-1">Add new</a>
        @foreach ($products as $product)
            <a href="{{ route('edit_product_page', ['id' => $product->id]) }}"
                class="list-group-item list-group-item-action flex-column align-items-start active mb-1">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">Product ID and code: {{ $product->id }}; {{ $product->code }}</h5>
                </div>
                <h6 class="mb-1">Brand and name: {{ $product->brand }} {{ $product->name }}</h6>
                <p class="mb-1">Category ID: {{ $product->category_id }}</p>
                <p class="mb-1">Desc: {{ $product->description }}</p>
                <p class="mb-1">Thumb: {{ $product->thumbnail }}</p>
                <p class="mb-1">Price: {{ $product->price }}</p>
                <p class="mb-1">Discount: {{ $product->discount }}</p>

                <small>Created: {{ $product->created_at }};</small>
                <small>Updated: {{ $product->updated_at }};</small>
            </a>
        @endforeach
        {!! $orders->links('pagination::bootstrap-4') !!}
    </div>
@endsection

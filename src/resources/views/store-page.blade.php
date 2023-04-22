@extends('layouts.base')

@section('title', 'Eshop')

@section('content')
<div class="container mt-5">
    <div class="row">
        @foreach($products as $product)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <img src="{{ $product->images[0]->url }}" class="card-img-top" alt="{{ $product->name }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">{{ $product->description }}</p>
                        <p class="card-text">${{ $product->price }}</p>
                        <div class="d-flex">
                            <input type="number" min="1" value="1" class="form-control me-2 quantity-input">
                            <button class="btn btn-outline-dark add-to-cart" data-product-id="{{ $product->id }}">Add to Cart</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <!-- <div class="d-flex justify-content-center mt-4">
        {{ $products->links() }}
    </div> -->
</div>
@endsection

@push('scripts')
<script>
    document.querySelectorAll('.add-to-cart').forEach(button => {
        button.addEventListener('click', addToCart);
    });

    function addToCart(event) {
        const productId = event.target.getAttribute('data-product-id');
        const quantity = event.target.parentElement.querySelector('.quantity-input').value;

        fetch('/cart/add', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
            body: JSON.stringify({productId, quantity}),
        }).then(response => {
            if (response.ok) {
                // Show a success message or update the cart counter
            } else {
                // Show an error message
            }
        });
    }
</script>
@endpush

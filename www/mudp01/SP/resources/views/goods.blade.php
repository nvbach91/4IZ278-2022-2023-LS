@extends('layout')
@section('content')
@isset($message)
    <div id="message" class="message">
        <p>{{$message}}</p>
    </div>
@endisset
<div class="goods-display">
@foreach ($goods as $productType =>$itemClass)
<div class="goods-category-holder">
    <label class="goods-category-label">
        {{ucfirst($productType)}}
    </label>
</div>
    @foreach($itemClass as $item)
    <div class="goods-product-holder">
        <div class="goods-product-item">
            <img class="goods-product-item-img" src="{{$item->img}}" alt="{{$item->alt}}">
            <p class="goods-product-item-name">{{$item->name}}</p>
            <p class="goods-product-item-description">{{$item->description}}</p>
            <div class="goods-product-item-priceHolder">
                <label class="goods-product-item-price">{{$item->price}} $</label>
                <form method="POST">
                    @csrf
                    <input hidden value="{{$item->id}}" name="item_id">
                <input type="number" name="quantity" value="1" min="1" max="{{$item->available}}">
                <button type="submit" class="goods-product-item-add">Add to cart</button>
            </form>
                <label>In stock: {{$item->available}}</label>

            </div>
        </div>
    </div>
    @endforeach
    <div class="admin-buttonHolder">
        <input hidden name="productType" value="{{$productType}}">
        <button  id="previous{{$productType}}" type="button">Previous {{$productType}}</button>
        @if (isset($_GET[$productType]))
            @if(intval($_GET[$productType])<=3)
            @for ($i = 1; $i < 5; $i++)
            @if (intval($_GET[$productType])==$i)
            <a class="admin-currentOrders" href="./goods/?{{$productType}}={{$i}}">{{$i}}</a>
            @else
            <a href="./goods/?{{$productType}}={{$i}}">{{$i}}</a>
            @endif            
            @endfor
            @else
            <a href="./goods/?{{$productType}}=1">1</a>
            <p>..</p>
            <a href="./goods/?{{$productType}}={{intval($_GET[$productType])-1}}">{{intval($_GET[$productType])-1}}</a>
            <a class="admin-currentOrders" href="./goods/?{{$productType}}={{intval($_GET[$productType])}}">{{intval($_GET[$productType])}}</a>
            <a href="./goods/?{{$productType}}={{intval($_GET[$productType])+1}}">{{intval($_GET[$productType])+1}}</a>
            @endif
        @else
        @for ($i = 1; $i < 5; $i++)
        @if ($i==1)
        <a class="admin-currentOrders" href="./goods/?{{$productType}}={{$i}}">{{$i}}</a>
        @else
        <a href="./goods/?{{$productType}}={{$i}}">{{$i}}</a>
        @endif            
        @endfor
        @endif
        <button id="next{{$productType}}"  type="button">Next {{$productType}}</button>
</div>
    @endforeach
</div>
<script src="{{ asset('js/goods.js') }}"></script>
@endsection
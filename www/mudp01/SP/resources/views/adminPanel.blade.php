@extends('layout')
@section('content')
@isset($message)
<div id="message" class="message">
    <label>{{$message}}</label>      
</div> 
@endisset
<h1 class="admin-heading">Admin panel </h1>
<h2 class="admin-item-heading">Items</h2>
<div class="admin-items">
<div>
    <h2>Add item</h2>
    <form class="adminForm" method="POST">
       @csrf
       <input hidden name="addItem" value="true">
       <label>Name:</label>
       <input name="name" placeholder="name">
       <label>Description:</label>
       <input name="description" placeholder="description">
       <label>Image URL:</label>
       <input name="imgUrl" placeholder="image url">
       <label>Image Alt:</label>
       <input name="imgAlt" placeholder="image alt">
       <label>Price:</label>
       <input name="price" placeholder="price">
       <label>Stock:</label>
       <input name="quantity" placeholder="stock">
       <label>Category:</label>
       <input name="category" placeholder="category">
       <button type="submit">Add item</button>
    </form>
</div>
    @if (isset($removeItem))
    <div>
        <h2>Delete item</h2>
    <form class="adminForm-delete" method="POST">
        @csrf
        <input hidden name="removeItemConfirm" value="true">
        <div>
        <label>Id:</label>
        <input readonly name="id" value="{{$removeItem[0]->id}}">
        </div>
        <p>Name: {{$removeItem[0]->name}}</p>
        <p>Description: {{$removeItem[0]->description}}</p>
        <p>Image URL: {{$removeItem[0]->img_URL}}</p>
        <p>Image Alt: {{$removeItem[0]->img_alt}}</p>
        <p>Price: {{$removeItem[0]->price}}</p>
        <p>Quantity: {{$removeItem[0]->quantity}}</p>
        <p>Category: {{$removeItem[0]->category}}</p>
        <div class="adminForm-buttons">
        <button type="submit">Pemanently delete item</button>
        <a href=".">Cancel deleting</a>
        </div>
    </form>
    </div>
    @else
    <div>
        <h2>Delete item</h2>
    <form class="adminForm" method="POST">
        @csrf
        <input hidden name="removeItem" value="true">
        <input name="item" placeholder="Item name or ID">
        <select name="option">
            <option value="name">name</option>
            <option value="id">ID</option>
        </select>
        <button type="submit">Remove item</button>
    </form>
    </div>
    @endif

    @if(isset($editItem))
    <div>
        <h2>Edit item</h2>
        <form class="adminForm" method="POST">
            @csrf
            <input hidden name="editedItem" value="true">
            <label>Id:</label>
            <input readonly name="id" value="{{$editItem[0]->id}}">
            <label>Name:</label>
            <input name="name" placeholder="name" value="{{$editItem[0]->name}}">
            <label>Description:</label>
            <input name="description" placeholder="description" value="{{$editItem[0]->description}}">
            <label>Image URL:</label>
            <input name="imgUrl" placeholder="image url" value="{{$editItem[0]->img_URL}}">
            <label>Image Alt:</label>
            <input name="imgAlt" placeholder="image alt" value="{{$editItem[0]->img_alt}}">
            <label>Price:</label>
            <input  name="price" placeholder="price" value="{{$editItem[0]->price}}">
            <label>Quantity:</label>
            <input name="quantity" placeholder="quantity" value="{{$editItem[0]->quantity}}">
            <label>Category:</label>
            <input name="category" placeholder="category" value="{{$editItem[0]->category}}">
            <div class="adminForm-buttons-edit">
            <button class="admiForm-cancelEdit" type="submit">Edit item</button>
            <a class="admiForm-cancelEdit" href=".">Cancel editing</a>
            </div>
        </form>
    </div>
    @else
    <div>
        <h2>Edit item</h2>
    <form class="adminForm" method="POST">
        @csrf
        <input hidden name="editItem" value="true">
        <input name="item" placeholder="Item name or ID">
        <select name="option">
            <option value="name">name</option>
            <option value="id">ID</option>
        </select>
        <button type="submit">Edit item</button>
    </form> 
    </div>
    @endif
</div>
<h2 class="admin-item-heading">Orders</h2>
<div class="admin-orders">
@if (isset($orders))
    @foreach ($orders as $order)
        <div>
            <form class="adminForm" method="POST">
                @csrf
                <input hidden name="orderPaid" value="true">
                <label>Id: </label>
                <input readonly name="id" value="{{$order->id}}">
                <p>Created: {{$order->created}}</p>
                <p class="admin-orders-state">State: {{$order->state}}</p>
                <p>Customer: {{$order->email}} (ID: {{$order->customer}})</p>
                <button type="submit">Order paid</button>
            </form>
        </div>
    @endforeach
@else
   <p>No orders found.</p>
@endif
</div>
    @endsection
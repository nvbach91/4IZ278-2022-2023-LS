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
       @if(isset($_POST['addItem']))
       <input hidden name="addItem" value="true">
       <label>Name:</label>
       <input name="name" placeholder="name" value="{{$_POST['name']}}">
       <label>Description:</label>
       <input name="description" placeholder="description" value="{{$_POST['description']}}">
       <label>Image URL:</label>
       <input name="imgUrl" placeholder="image url" value="{{$_POST['imgUrl']}}">
       <label>Image Alt:</label>
       <input name="imgAlt" placeholder="image alt" value="{{$_POST['imgAlt']}}">
       <label>Price:</label>
       <input name="price" placeholder="price" value="{{$_POST['price']}}">
       <label>Stock:</label>
       <input name="quantity" placeholder="stock" value="{{$_POST['quantity']}}">
       <label>Category:</label>
       <select name="category">
        @foreach($categories as $category)
        @if (($_POST['category']==$category->id))
        <option value="{{$category->id}}" selected>{{$category->name}}</option>
        @else
        <option value="{{$category->id}}">{{$category->name}}</option>
        @endif
        @endforeach
        </select>
       @else
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
       <select name="category">
        @foreach($categories as $category)
        @if (isset($_POST['category']))
        @if (($_POST['category']==$category->id))
        <option value="{{$category->id}}" selected>{{$category->name}}</option>
        @endif
        @else
        <option value="{{$category->id}}">{{$category->name}}</option>
        @endif
        @endforeach
        </select>
       @endif
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
        <a href="./">Cancel deleting</a>
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
            <a class="admiForm-cancelEdit" href="./">Cancel editing</a>
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
<form method="POST">
    @csrf
    <input hidden name="filterOrders" value="true">
    <label>Filter by state:</label>
    <select name="filter">        
        @if (isset($_POST['filterOrders']))
        <option value="paid" {{$_POST['filter']=='paid'? 'selected':'';}}>Paid</option>
        @else
        <option value="paid">Paid</option>
        @endif
        @if (isset($_POST['filterOrders']))
        
        <option value="Waiting for payment" {{$_POST['filter']=='Waiting for payment'? 'selected' :'';}}>Waiting for payment</option>
        @else
        <option value="Waiting for payment">Waiting for payment</option>
        @endif
    </select>
    <button type="submit">Filter</button>
</form>
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
<div class="admin-buttonHolder">
        <button id="previousOrder" type="button">Previous orders</button>
        @if (isset($_GET['orders']))
            @if(intval($_GET['orders'])<=3)
            @for ($i = 1; $i < 5; $i++)
            @if (intval($_GET['orders'])==$i)
            <a class="admin-currentOrders" href="./adminPanel/?orders={{$i}}">{{$i}}</a>
            @else
            <a href="./adminPanel/?orders={{$i}}">{{$i}}</a>
            @endif            
            @endfor
            @else
            <a href="./adminPanel/?orders=1">1</a>
            <p>..</p>
            <a href="./adminPanel/?orders={{intval($_GET['orders'])-1}}">{{intval($_GET['orders'])-1}}</a>
            <a class="admin-currentOrders" href="./adminPanel/?orders={{intval($_GET['orders'])}}">{{intval($_GET['orders'])}}</a>
            <a href="./adminPanel/?orders={{intval($_GET['orders'])+1}}">{{intval($_GET['orders'])+1}}</a>
            @endif
        @else
        @for ($i = 1; $i < 5; $i++)
        @if ($i==1)
        <a class="admin-currentOrders" href="./adminPanel/?orders={{$i}}">{{$i}}</a>
        @else
        <a href="./adminPanel/?orders={{$i}}">{{$i}}</a>
        @endif            
        @endfor
        @endif
        <button id="nextOrder" type="button">Next orders</button>
</div>
@else
   <p>No orders found.</p>
@endif
</div>
<script src="{{ asset('js/adminPanel.js') }}"></script>
    @endsection
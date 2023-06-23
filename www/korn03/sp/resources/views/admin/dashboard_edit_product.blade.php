@extends('layouts.admin')

@section('content')
<form method="POST" action="{{route('edit_product')}}">
    @csrf
    <input type="hidden" class="form-control" name="id" value="{{$product->id}}">
    <div class="form-group">
      <label for="exampleInputEmail1">Brand</label>
      <input type="text" class="form-control" name="brand" value="{{$product->brand}}">
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Name</label>
      <input type="text" class="form-control" name="name" value="{{$product->name}}">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Code</label>
        <input type="text" class="form-control" name="code" value="{{$product->code}}">
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Category ID</label>
        <input type="text" class="form-control" name="category_id" value="{{$product->category_id}}">
      </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Description</label>
        <input type="text" class="form-control" name="description" value="{{$product->description}}">
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Thumbnail</label>
        <input type="text" class="form-control" name="thumbnail" value="{{$product->thumbnail}}">
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Price</label>
        <input type="text" class="form-control" name="price" value="{{$product->price}}">
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Discount</label>
        <input type="text" class="form-control" name="discount" value="{{$product->discount}}">
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Stock</label>
        <input type="text" class="form-control" name="stock" value="{{$product->stock}}">
      </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>

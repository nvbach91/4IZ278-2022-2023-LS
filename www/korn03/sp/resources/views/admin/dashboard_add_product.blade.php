@extends('layouts.admin')

@section('content')
<form method="POST" action="{{route('add_product')}}">
    @csrf
    <div class="form-group">
      <label for="exampleInputEmail1">Brand</label>
      <input type="text" class="form-control" name="brand">
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Name</label>
      <input type="text" class="form-control" name="name">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Code</label>
        <input type="text" class="form-control" name="code">
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Category ID</label>
        <input type="text" class="form-control" name="category_id">
      </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Description</label>
        <input type="text" class="form-control" name="description">
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Thumbnail</label>
        <input type="text" class="form-control" name="thumbnail">
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Price</label>
        <input type="text" class="form-control" name="price">
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Discount</label>
        <input type="text" class="form-control" name="discount">
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Stock</label>
        <input type="text" class="form-control" name="stock">
      </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>

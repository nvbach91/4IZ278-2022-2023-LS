@extends('layout')
@section('content')
<h1>Your order was successfully placed!</h1>
<p>Thank you Mr/Ms {{$name}} for shopping with us. After your payment for the order of total {{$price}}$ is made, we start with shipping. Also we will notice you on your email {{$email}}.</p>
<p>Once again, thank you!</p>
<a href="/">Ok</a>
@endsection
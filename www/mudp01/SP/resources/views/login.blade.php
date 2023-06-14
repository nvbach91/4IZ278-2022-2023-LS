@extends('layout')
@section('content')
<h1 class="register-form-Heading">
    Login
</h1>
<form id="login-form" method="POST">
    @csrf
    @if (empty($_POST))
    <input id='login-emailInput' class="register-formfield" type="email" placeholder="Email" name="email">
    @else
    <input id='login-emailInput' class="register-formfield" type="email" placeholder="Email" name="email" value="{{$_POST['email']}}">
    @endif
   <input id='login-passwordInput' class="register-formfield" type="password" placeholder="Password" name="password">
   @isset($Error)
   <input id="login-error" hidden name="errors" value="{{$Error}}">
   @endisset
   <button class="register-formbutton" type="submit">Login</button>
</form>

<div class="login-formredirect">
    <label>Login with Google instead</label>
    <div id="buttonDiv"></div> 
</div>

<script src="https://accounts.google.com/gsi/client" async defer></script>
<script src="{{ asset('js/login.js') }}"></script>
@endsection
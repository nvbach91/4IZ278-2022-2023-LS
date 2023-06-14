@extends('layout')
@section('content')
    <h1 class="register-form-Heading">
        Register
    </h1>
    <form method="POST">
         @csrf
         @if (empty($_POST))
         <input id='register-firstNameInput' class="register-formfield" type="text" placeholder="First Name" name="firstName">
         <input id='register-lastNameInput' class="register-formfield" type="text" placeholder="Last Name" name="lastName">
         <input id='register-emailInput' class="register-formfield" type="email" placeholder="Email" name="email">
         @else
         <input id='register-firstNameInput' class="register-formfield" type="text" placeholder="First Name" name="firstName" value="{{$_POST['firstName']}}">
         <input id='register-lastNameInput' class="register-formfield" type="text" placeholder="Last Name" name="lastName" value="{{$_POST['lastName']}}">
         <input id='register-emailInput' class="register-formfield" type="email" placeholder="Email" name="email" value="{{$_POST['email']}}">
         @endif
        <input id='register-passwordInput1' class="register-formfield" type="password" placeholder="Password" name="password1">
        <input id='register-passwordInput2' class="register-formfield" type="password" placeholder="Repeat Password" name="password2">
        @isset($Error)
        <input id="register-error" hidden name="errors" value="{{$Error}}">
        @endisset
        <button class="register-formbutton" type="submit">Register</button>
    </form>
    <a class="register-formredirect" href="/login/">Login instead</a>
    <script src="{{ asset('js/register.js') }}"></script>
@endsection
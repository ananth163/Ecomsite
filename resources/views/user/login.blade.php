@extends('layouts.base')

@section('title', 'Sign In')

@section('pageid', 'login')

@section('content')
	@include('includes.messages')
	<div class="login-box">
      <div class="grid-x grid-padding-x expanded align-center">
        <div class="cell small-12 medium-6">
          <form class="log-in-form" action="/login" method="post">
            <h4 class="text-center">Log in</h4>
            <label>Username or Email
              <input type="text" name="signin">
            </label>
            <label>Password
              <input type="password" placeholder="Password" name="password" id="pwd-input">
            </label>
            <input id="show-password" type="checkbox"><label for="show-password">Show password</label>
            <input type="hidden" name="token" value="{{App\Classes\CSRFHandler::getToken()}}" />
            <p><input type="submit" class="button expanded" value="Log in"></input></p>
            <p class="text-center"><a href="#">Forgot your password?</a></p>
            <p class="text-center"><a href="/sign-up">Register</a></p>
          </form>
        </div>
      </div>
  </div>
@endsection
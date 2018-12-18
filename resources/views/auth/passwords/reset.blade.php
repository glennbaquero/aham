@extends('master')
@section('pageTitle', 'Login')
@section('content')
<section class="login breadcrumbs container">s</section>
<section class="login container">
    <div class="frame-padding">
        <div class="ls__container animate-up">
            <p class="ls__title">Forgot password</p>
            <p class="ls__desc">Enter valid email address to send a forgot password link to your email</p>
             @if(count($errors))
                @foreach($errors->all() as $error)
                    <p class="checkout-forms__label font--upcase color--red" style="color: red">{{$error}}</p>
                @endforeach
            @endif
                <form method="POST" action="{{ route('password.reset') }}" class="ls__form">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="ls__form-row">
                        <label>Enter email</label>
                        <input class="input-text" type="email" name="email">
                    </div>
                    <div class="ls__form-row">
                        <label>Enter new password</label>
                        <input class="input-text" type="password" name="password">
                    </div>
                    <div class="ls__form-row">
                        <label>Confirm password</label>
                        <input class="input-text" type="password" name="password_confirmation">
                    </div>
                    <button type="submit" class="btn btn-blue font--2">Submit</button>
                    <p class="signup">Back to <a href="{{ route('login') }}">Log In</a></p>
                </form>
        </div>
    </div>
@endsection
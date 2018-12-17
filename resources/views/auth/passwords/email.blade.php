@extends('master')
@section('pageTitle', 'Forgot password')
@section('content')
<section class="login breadcrumbs container"></section>
<section class="login container">
    <div class="frame-padding">
        <div class="ls__container animate-up">
            <p class="ls__title">Forgot password</p>
            <p class="ls__desc">Enter valid email address to send a forgot password link to your email</p>

            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            
            <form method="POST" action="{{ route('password.email') }}" class="ls__form">
                @csrf
                <div class="ls__form-row">
                    <label>Email</label>
                    <input class="input-text" type="email" name="email">
                    <label class="error-label"><i>{{ $errors->has('email') ? 'Invalid email*' : ''}}</i></label>
                </div>
                <button type="submit" class="btn btn-blue font--2">Submit</button>
            <p class="signup">Back to <a href="{{ route('login') }}">Log In</a></p>
            </form>
        </div>
    </div>
@endsection

@extends('master')
@section('pageTitle', 'Login')
@section('content')

<section class="login breadcrumbs container">s</section>
<section class="login container">
    <div class="frame-padding">
        <div class="ls__container">
            <p class="ls__title">Log in to your account</p>
            <p class="ls__desc">Log in to register new product</p>
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <form method="POST" action="{{ route('login') }}" class="ls__form">
                @csrf
    
                @if(count($errors))
                    @foreach($errors->all() as $error)
                        <label class="error-label"><i>{{$error}}</i></label>
                    @endforeach
                @endif

                <div class="ls__form-row">
                    <label>Email</label>
                    <input class="input-text" type="email" name="email" value="{{ old('email') }}">
                </div>
                <div class="ls__form-row">
                    <label>Password</label>
                    <input class="input-text" type="password" name="password">
                </div>
                <button class="btn btn-blue font--2">Login</button>
                <p class="signup">Don't have an account? <a href="{{ route('signup') }}">Sign up</a></p>
                <p class="signup">I forgot my password <a href="{{ route('forgot.password') }}">Forgot Password</a></p>
            </form>
        </div>
    </div>
</section>

@endsection


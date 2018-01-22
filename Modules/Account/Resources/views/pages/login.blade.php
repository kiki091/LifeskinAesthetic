<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.ico') }}">
    <link rel="stylesheet" href="{{ elixir('cms/css/core.css') }}">
</head>
<body>
    <div class="login__background" style="background-image:url('{{URL::asset('cms/images/login/bg-login.jpg')}}');">
        <div class="login__wrapper">
            <div class="login__header">
                <img src="{{URL::asset('cms/images/login/fs-logo-circle-white.svg')}}" alt="" class="login__header__logo">
            </div>
            <div class="login__content">
                <div class="login__content__header">
                    <h3>Login</h3>
                    @if (count($errors) > 0)
                            @foreach ($errors->all() as $error)
                                <p class="error--state--message">{{ $error }}</p>
                            @endforeach
                    @else
                        <p>Please enter your username and password to login</p>
                    @endif
                    <!-- <p class="error--state--message">Your username or password are incorrect.</p> -->
                </div>
                <div class="login__content__form">
                    <form action="{{ route('authenticate') }}" method="POST">
                        <div class="form__input_wrapper">
                            <input type="text" class="input__username" placeholder="Email" name="email" value="{{ old('email') }}">
                            <input type="password" class="input__password" placeholder="Password" name="password">
                        </div>
                        <div class="form__btn">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button class="btn__submit__login">Log In</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
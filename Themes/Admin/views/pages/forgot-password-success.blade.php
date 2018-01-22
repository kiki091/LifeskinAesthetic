<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link rel="stylesheet" href="{{ elixir('css/facile_styles.css', 'themes/admin') }}">
</head>
<body>
    <div class="login--background" style="background-image:url('{{Theme::url('images/bg-login.jpg')}}');">
        <div class="login__wrapper">
            <div class="login--header">
                @component('slot.logo')    
                {{ Theme::url('images/logo-facile.svg') }}
                @endcomponent
            </div>
            <div class="login--content">
                <div class="login--content__header">
                    <h3>Email Sent</h3>
                    <p>Your password has been sent to your registered email</p>
                </div>
                <div class="login--content__form">
                    <a href="{{ route('facile.login') }}" class="login--btn--submit">Back to login</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
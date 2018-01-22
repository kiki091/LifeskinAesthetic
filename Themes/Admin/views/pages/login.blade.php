<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ elixir('css/facile_styles.css', 'themes/admin') }}">
</head>
<body>
    <div class="login--background" style="background-image:url('{{asset('themes/admin/images/bg-login.jpg')}}');" id="loginApp">
        <div class="login__wrapper">
            
            <div class="login--header">
                @component('slot.logo')    
                {{ asset('themes/admin/images/logo.png') }}
                @endcomponent
            </div>
            
            <div class="login--content">
                <div class="login--content__header">
                    <h3>Login</h3>
                    <p v-if="!error">Please enter your username and password to login</p>
                    <!-- STYLE WHEN ERROR REPLACE TEXT & ADD CLASS IN TAG P ABOVE-->
                    <p class="error--state--message" v-else v-html="error"></p>
                </div>
                <div class="login--content__form">
                    <form action="" v-on:submit.prevent="login">
                        <div class="login--input__container">
                            <input type="text" class="input__username" v-model="models.email" placeholder="Username">
                            <input type="password" class="input__password" v-model="models.password" placeholder="Password">
                        </div>
                        <div class="login--btn">
                            <button class="login--btn--submit" :disabled="state.loading" >@{{ loginText }}</button>
                        </div>
                    </form>
                </div>
            </div>
            <br>
            <div class="center-align">
                <a href="{{ route('facile.forgot') }}" class="link forgot-password">Forgot Password?</a>
            </div>
        </div>
    </div>
</body>
@include('partials.vars')
<script type="text/javascript">
    var login_success_url = "{{ config("facile.core.core.redirect_login_url") }}"
</script>
<script type="text/javascript" src="{{ asset('js/laroute.js') }}"></script>
<script src="{{ elixir('js/facile_plugins.js', 'themes/admin')}}"></script>
<script type="text/javascript" src="{{ asset('vendor/vue/vue.js') }}"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="{{ elixir('js/pages/login.js', 'themes/admin')}}"></script>
</html>
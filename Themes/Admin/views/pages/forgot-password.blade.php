<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Forgot Password</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ elixir('css/facile_styles.css', 'themes/admin') }}">
</head>
<body>
    <div class="login--background" style="background-image:url('{{Theme::url('images/bg-login.jpg')}}');" id="forgotApp">
        <div class="login__wrapper">
            <div class="login--header">
                @component('slot.logo')    
                {{ Theme::url('images/logo-facile.svg') }}
                @endcomponent
            </div>
            <div class="login--content">
                <div class="login--content__header">
                    <h3>Forgot Password</h3>
                    <p v-if="!error">Enter your registered email address below to regain your password</p>
                    <p class="error--state--message" v-else v-html="error"></p>
                    <!-- STYLE WHEN ERROR REPLACE TEXT & ADD CLASS IN TAG P ABOVE-->
                    <!-- <p class="error--state--message">Your username or password are incorrect.</p> -->
                </div>
                <div class="login--content__form">
                    <form action="" v-on:submit.prevent="forgot">
                        {{ csrf_field() }}
                        <div class="login--input__container">
                            <input type="email" v-model="models.email" class="input__username" placeholder="Email Address">
                        </div>
                        <div class="login--btn">
                            <button class="login--btn--submit" :disabled="state.loading">@{{ buttonText }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
@include('partials.vars')
<script type="text/javascript">
    var forgot_success_url = "{{ config("facile.core.core.redirect_forgot_url") }}"
</script>
<script type="text/javascript" src="{{ asset('js/laroute.js') }}"></script>
<script src="{{ elixir('js/facile_plugins.js', 'themes/admin')}}"></script>
<script type="text/javascript" src="{{ asset('vendor/vue/vue.js') }}"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="{{ elixir('js/pages/login.js', 'themes/admin')}}"></script>
</html>
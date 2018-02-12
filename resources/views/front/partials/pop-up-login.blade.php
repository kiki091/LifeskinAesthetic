
<div class="cd-user-modal"> <!-- this is the entire modal form, including the background -->
    <div class="cd-user-modal-container"> <!-- this is the container wrapper -->
        <ul class="cd-switcher">
            <li><a href="javascript::void();">Sign in</a></li>
            <li><a href="javascript::void();">New account</a></li>
        </ul>

        <div id="cd-login"> <!-- log in form -->
            @if (count($errors) > 0)
                @foreach ($errors->all() as $error)
                    <p style="text-align: center;  color: red" class="form-messege">{{ $error }}</p>
                @endforeach
            @endif
            <form id="form-login" action="{{ route('LoginAuthenticate') }}" method="post" class="cd-form">
                <p class="fieldset">
                    <input name="email" type="email" id="signin-email" class="full-width has-padding has-border" placeholder="Email" value="{{ old('email') }}">
                    <span class="error-message" id="error-message-login-email"></span>
                    
                </p>

                <p class="fieldset">
                    <input class="full-width has-padding has-border" name="password" id="signin-password" type="password"  placeholder="Password">
                    <span class="error-message" id="error-message-login-password"></span>
                </p>

                <p class="fieldset">
                    <input type="hidden" id="token_login" name="_token" value="{{ csrf_token() }}">
                    <input class="full-width" type="submit" value="Login">
                </p>
            </form>
        </div> <!-- cd-login -->

        <div id="cd-signup"> <!-- sign up form -->
            <form id="form-registration" action="{{ route('RegisterAuthenticate') }}" method="POST" class="cd-form">
                <p class="fieldset">
                    <input name="first_name" class="full-width has-padding has-border" id="signup-first_name" type="text" placeholder="First Name">
                    <span class="error-message" id="error-message-registrstion-first_name"></span>
                </p>

                <p class="fieldset">
                    <input name="last_name" class="full-width has-padding has-border" id="signup-last_name" type="text" placeholder="Last Name">
                    <span class="error-message" id="error-message-registrstion-last_name"></span>
                </p>

                <p class="fieldset">
                    <input class="full-width has-padding has-border" id="signup-email" name="email" type="email" placeholder="E-mail">
                    <span class="error-message" id="error-message-registrstion-email"></span>
                </p>

                <p class="fieldset">
                    <input class="full-width has-padding has-border" id="signup-place_of_birth" name="place_of_birth" type="text" placeholder="Place of birth">
                    <span class="error-message" id="error-message-registrstion-place_of_birth"></span>
                </p>

                <p class="fieldset">
                    <input class="birth_day full-width has-padding has-border" id="signup-birth_day" name="birth_day" type="text" placeholder="Birth day (1980-11-21)">
                    <span class="error-message" id="error-message-registrstion-birth_day"></span>
                </p>

                <p class="fieldset">
                    <input name="phone_number" class="full-width has-padding has-border" id="signup-phone_number" type="text" placeholder="Phone number">
                    <span class="error-message" id="error-message-registrstion-phone_number"></span>
                </p>

                <p class="fieldset">
                    <input name="password" class="full-width has-padding has-border" id="signup-password" type="password"  placeholder="Password">
                    <span class="error-message" id="error-message-registrstion-password"></span>
                </p>

                <p class="fieldset">
                    <input name="confirm_password" class="full-width has-padding has-border" id="signup-confirm_password" type="password"  placeholder="Confirm Password">
                    <span class="error-message" id="error-message-registrstion-confirm_password"></span>
                </p>

                <p class="fieldset">
                    <input type="hidden" id="token_login" name="_token" value="{{ csrf_token() }}">
                    <input class="full-width has-padding" type="submit" value="Create account">
                </p>
            </form>

            <!-- <a href="#0" class="cd-close-form">Close</a> -->
        </div> <!-- cd-signup -->
        <a href="javascript::void(0);" class="cd-close-form">Close</a>
    </div> <!-- cd-user-modal-container -->
</div> <!-- cd-user-modal -->

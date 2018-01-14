
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
            <form action="{{ route('LoginAuthenticate') }}" method="post" class="cd-form">
                <p class="fieldset">
                    <label class="image-replace cd-email" for="signin-email">E-mail</label>
                    <input name="email" type="email" id="signin-email" class="full-width has-padding has-border" placeholder="Email" value="{{ old('email') }}">
                    <span class="cd-error-message"></span>
                    
                </p>

                <p class="fieldset">
                    <label class="image-replace cd-password" for="signin-password">Password</label>
                    <input class="full-width has-padding has-border" name="password" id="signin-password" type="text"  placeholder="Password">
                    <span class="cd-error-message"></span>
                    <a href="#0" class="hide-password">Hide</a>
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
                    <label class="image-replace cd-first_name" for="signup-first_name">First Name</label>
                    <input name="first_name" class="full-width has-padding has-border" id="signup-first_name" type="text" placeholder="First Name">
                    <span class="cd-error-message" id="cd-error-message-first_name"></span>
                </p>

                <p class="fieldset">
                    <label class="image-replace cd-last_name" for="signup-last_name">Last Name</label>
                    <input name="last_name" class="full-width has-padding has-border" id="signup-last_name" type="text" placeholder="Last Name">
                    <span class="cd-error-message" id="cd-error-message-last_name"></span>
                </p>

                <p class="fieldset">
                    <label class="image-replace cd-email" for="signup-email">E-mail</label>
                    <input class="full-width has-padding has-border" id="signup-email" name="email" type="email" placeholder="E-mail">
                    <span class="cd-error-message" id="cd-error-message-email"></span>
                </p>

                <p class="fieldset">
                    <label class="image-replace cd-phone_number" for="signup-phone_number">Phone Number</label>
                    <input name="phone_number" class="full-width has-padding has-border" id="signup-phone_number" type="text" placeholder="Phone number">
                    <span class="cd-error-message" id="cd-error-message-phone_number"></span>
                </p>

                <p class="fieldset">
                    <label class="image-replace cd-password" for="signup-password">Password</label>
                    <input name="password" class="full-width has-padding has-border" id="signup-password" type="text"  placeholder="Password">
                    <a href="#0" class="hide-password">Hide</a>
                    <span class="cd-error-message" id="cd-error-message-password"></span>
                </p>

                <p class="fieldset">
                    <label class="image-replace cd-confirm_password" for="signup-confirm_password">Confirm Password</label>
                    <input name="confirm_password" class="full-width has-padding has-border" id="signup-confirm_password" type="text"  placeholder="Confirm Password">
                    <a href="#0" class="hide-password">Hide</a>
                    <span class="cd-error-message" id="cd-error-message-confirm_password"></span>
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

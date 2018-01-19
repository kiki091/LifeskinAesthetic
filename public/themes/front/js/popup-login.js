jQuery(document).ready(function($){

	var formModal = $('.cd-user-modal'),
		formLogin = formModal.find('#cd-login'),
		formSignup = formModal.find('#cd-signup'),
		formForgotPassword = formModal.find('#cd-reset-password'),
		formModalTab = $('.cd-switcher'),
		tabLogin = formModalTab.children('li').eq(0).children('a'),
		tabSignup = formModalTab.children('li').eq(1).children('a'),
		forgotPasswordLink = formLogin.find('.cd-form-bottom-message a'),
		backToLoginLink = formForgotPassword.find('.cd-form-bottom-message a'),
		mainNav = $('.nav-menu');

	//open modal
	mainNav.on('click', function(event){
		$(event.target).is(mainNav) && mainNav.children('ul').toggleClass('is-visible');
	});

	//open sign-up form
	mainNav.on('click', '.cd-signup', signup_selected);
	//open login-form form
	mainNav.on('click', '.cd-signin', login_selected);

	//close modal
	formModal.on('click', function(event){
		if( $(event.target).is(formModal) || $(event.target).is('.cd-close-form') ) {
			formModal.removeClass('is-visible');
		}	
	});
	//close modal when clicking the esc keyboard button
	$(document).keyup(function(event){
    	if(event.which=='27'){
    		formModal.removeClass('is-visible');
	    }
    });

	//switch from a tab to another
	formModalTab.on('click', function(event) {
		event.preventDefault();
		( $(event.target).is( tabLogin ) ) ? login_selected() : signup_selected();
	});

	//hide or show password
	$('.hide-password').on('click', function(){
		var togglePass= $(this),
			passwordField = togglePass.prev('input');
		
		( 'password' == passwordField.attr('type') ) ? passwordField.attr('type', 'text') : passwordField.attr('type', 'password');
		( 'Hide' == togglePass.text() ) ? togglePass.text('Show') : togglePass.text('Hide');
		//focus and move cursor to the end of input field
		passwordField.putCursorAtEnd();
	});

	//show forgot-password form 
	forgotPasswordLink.on('click', function(event){
		event.preventDefault();
		forgot_password_selected();
	});

	//back to login from the forgot-password form
	backToLoginLink.on('click', function(event){
		event.preventDefault();
		login_selected();
	});

	function login_selected(){
		mainNav.children('ul').removeClass('is-visible');
		formModal.addClass('is-visible');
		formLogin.addClass('is-selected');
		formSignup.removeClass('is-selected');
		formForgotPassword.removeClass('is-selected');
		tabLogin.addClass('selected');
		tabSignup.removeClass('selected');
	}

	function signup_selected(){
		mainNav.children('ul').removeClass('is-visible');
		formModal.addClass('is-visible');
		formLogin.removeClass('is-selected');
		formSignup.addClass('is-selected');
		formForgotPassword.removeClass('is-selected');
		tabLogin.removeClass('selected');
		tabSignup.addClass('selected');
	}

	function forgot_password_selected(){
		formLogin.removeClass('is-selected');
		formSignup.removeClass('is-selected');
		formForgotPassword.addClass('is-selected');
	}

	function clear_error_message()
	{
		formLogin.find('input').removeClass('has-error').next('span').removeClass('is-visible').text();
	}

	function clear_form_data()
	{
		formLogin.find('input').val()
		formSignup.find('input').val()
	}

	//REMOVE THIS - it's just to show error messages 
	formLogin.find('input[type="submit"]').on('click', function(event){
		var newURL = window.location.protocol + "://" + window.location.host;
		var ullCurrent = window.location.pathname

		event.preventDefault();
		var urlLogin = $('#form-login').attr('action')
		var formData = $('#form-login').serialize();

		$.ajax({
			type: 'POST',
			url: urlLogin,
			data: formData
		}).done(function(response) {

			clear_error_message()

			if(response.status == false)
			{
				if(response.is_error_form_validation == true)
				{
					$.each(response.message, function(key, value) {

						formLogin.find('input[name="'+key+'"]').toggleClass('has-error').next('span').toggleClass('is-visible').text(value);
					})
				} else {
					toastr.error(response.message, {timeOut: 5000})
				}
			} else {
				clear_form_data()
				clear_error_message()
				formModal.removeClass('is-visible');
				toastr.success(response.message, {timeOut: 5000})

				setTimeout(function() {
					window.location.href = ullCurrent
				}, 1000);
				
			}
		})

		//formLogin.find('input[type="email"]').toggleClass('has-error').next('span').toggleClass('is-visible');
	});

	formSignup.find('input[type="submit"]').on('click', function(event){
		event.preventDefault();
		var formRegistration = $('#form-registration'),
			formData = $('#form-registration').serialize(),
			formUrl = $('#form-registration').attr('action');

		$.ajax({
			type: 'POST',
			url: formUrl,
			data: formData
		}).done(function(response) {

			clear_error_message()

			if(response.status == false)
			{
				if(response.is_error_form_validation == true)
				{
					$.each(response.message, function(key, value) {

						formRegistration.find('input[name="'+key+'"]').toggleClass('has-error').next('span').toggleClass('is-visible').text(value);
					})
				} else {
					toastr.error(response.message, {timeOut: 5000})
				}
			} else {
				clear_form_data()
				clear_error_message()
				formModal.removeClass('is-visible');
				toastr.success(response.message, {timeOut: 5000})
			}
		})

		//formSignup.find('input[type="email"]').toggleClass('has-error').next('span').toggleClass('is-visible').text(value);
	});


	//IE9 placeholder fallback
	//credits http://www.hagenburger.net/BLOG/HTML5-Input-Placeholder-Fix-With-jQuery.html
	if(!Modernizr.input.placeholder){
		$('[placeholder]').focus(function() {
			var input = $(this);
			if (input.val() == input.attr('placeholder')) {
				input.val('');
		  	}
		}).blur(function() {
		 	var input = $(this);
		  	if (input.val() == '' || input.val() == input.attr('placeholder')) {
				input.val(input.attr('placeholder'));
		  	}
		}).blur();
		$('[placeholder]').parents('form').submit(function() {
		  	$(this).find('[placeholder]').each(function() {
				var input = $(this);
				if (input.val() == input.attr('placeholder')) {
			 		input.val('');
				}
		  	})
		});
	}

});


//credits http://css-tricks.com/snippets/jquery/move-cursor-to-end-of-textarea-or-input/
jQuery.fn.putCursorAtEnd = function() {
	return this.each(function() {
    	// If this function exists...
    	if (this.setSelectionRange) {
      		// ... then use it (Doesn't work in IE)
      		// Double the length because Opera is inconsistent about whether a carriage return is one character or two. Sigh.
      		var len = $(this).val().length * 2;
      		this.focus();
      		this.setSelectionRange(len, len);
    	} else {
    		// ... otherwise replace the contents with itself
    		// (Doesn't work in Google Chrome)
      		$(this).val($(this).val());
    	}
	});
};
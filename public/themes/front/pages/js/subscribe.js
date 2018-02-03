$(function() {

	// Get the form.
	var form = $('#homesubscribe');
	var formFooter = $('#desktop-footer-mailing-list-form');

	// Set up an event listener for the subscribe form.
	$(form).submit(function(e) {
		// Stop the browser from submitting the form.
		e.preventDefault();

		// Serialize the form data.
		var email = $('#email_mid').val()

		// Submit the form using AJAX.
		$.ajax({
			type: 'POST',
			url: $(form).attr('action'),
			data: { email: email, _token: token }
		})
		.done(function(response) {

			$('#form--homesubscribe input,#form--homesubscribe textarea').val('');
			$('.info--error').text('')
			if(response.status == false)
			{
				if(response.is_error_form_validation == true)
				{
					$.each(response.message, function(key, value) {
						$('#info--error-'+key).text(value)
					})
					toastr.error('Failed store contact us', {timeOut: 5000})
				} else {
					toastr.error(response.message, {timeOut: 5000})
				}
			} else {
				$('.info--error').text('')
				$('#form--homesubscribe input,#form--homesubscribe textarea').val('');
				toastr.success(response.message, {timeOut: 5000})
			}

			
		})
		.fail(function(data) {
			toastr.error('Oops! An error occured and your message could not be sent.', {timeOut: 5000})
		});
	});

	// Set up an event listener for the subscribe form footer
	$(formFooter).submit(function(event) {
		// Stop the browser from submitting the form.
		event.preventDefault();

		// Serialize the form data.
		var email = $('#footer-subscribe').val()
		// Submit the form using AJAX.
		$.ajax({
			type: 'POST',
			url: $(formFooter).attr('action'),
			data: { email: email, _token: token }
		})
		.done(function(response) {

			$('#desktop-footer-mailing-list-form input,#desktop-footer-mailing-list-form textarea').val('');
			$('.error-message').text('')
			if(response.status == false)
			{
				if(response.is_error_form_validation == true)
				{
					$.each(response.message, function(key, value) {
						$('#error-message-footer-'+key).text(value)
					})
					toastr.error('Failed store contact us', {timeOut: 5000})
				} else {
					toastr.error(response.message, {timeOut: 5000})
				}
			} else {
				$('.error-message').text('')
				$('#desktop-footer-mailing-list-form,#footer-subscribe').val('');
				toastr.success(response.message, {timeOut: 5000})
			}

			$('#form-submit-footer-subscribe').val('>')

			
		})
		.fail(function(data) {
			toastr.error('Oops! An error occured and your message could not be sent.', {timeOut: 5000})
		});
	});
});

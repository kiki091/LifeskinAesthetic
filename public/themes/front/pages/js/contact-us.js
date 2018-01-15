$(function() {

	// Get the form.
	var form = $('.about-contact-form');

	// Set up an event listener for the contact form.
	$(form).submit(function(e) {
		// Stop the browser from submitting the form.
		e.preventDefault();

		// Serialize the form data.
		var formData = $(form).serialize();

		// Submit the form using AJAX.
		$.ajax({
			type: 'POST',
			url: $(form).attr('action'),
			data: formData
		})
		.done(function(response) {

			$('#contact-form input,#contact-form textarea').val('');
			$('.error-message').text('')
			if(response.status == false)
			{
				if(response.is_error_form_validation == true)
				{
					$.each(response.message, function(key, value) {
						$('#error-message-'+key).text(value)
					})
					toastr.error('Failed store contact us', {timeOut: 5000})
				} else {
					toastr.error(response.message, {timeOut: 5000})
				}
			} else {
				$('.error-message').text('')
				$('#contact-form input,#contact-form textarea').val('');
				toastr.success(response.message, {timeOut: 5000})
			}

			
		})
		.fail(function(data) {
			toastr.error('Oops! An error occured and your message could not be sent.', {timeOut: 5000})
		});
	});

});

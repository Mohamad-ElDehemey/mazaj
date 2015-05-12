jQuery(document).ready(main);
function main(){

	$('#show-register').click(function(event) {
		event.preventDefault();
		$('#register-modal').modal('show');
	});

	$('#show-login').click(function(event) {
		$('#login-modal').modal('show');
	});

	$('#login-btn').click(function(event) {
		
		event.preventDefault();
		btn = $(this);
		loading = '<i class="fa fa-spinner fa-spin"></i>';
		btn_old = 'Login';

		$.ajax({
			url: BASE+'/user/login',
			type: 'POST',
			data: {
			'_token': $('input[name=_token]').val(),
			'email' : $('#lgn-email').val(),
			'password' :$('#lgn-pass').val(),
			},
			success: function(result){
				msgs = JSON.parse(result);
				if(msgs.error =='false'){

					window.location.assign(BASE);

				}

				if(msgs.error =='true'){

					error_message(msgs.password,'#lgn-alert-password');
					error_message(msgs.email,'#lgn-alert-email');

				}
			}
			
		})

		.always(function() {
			btn.html(btn_old);

		});
		
	});


	
	

	$('#register-btn').click(function(event) {
		
		event.preventDefault();
		
		btn = $(this);
		loading = '<i class="fa fa-spinner fa-spin"></i>';
		btn_old = 'Save changes';
		btn.html(loading);

		$.ajax({
			url: BASE+'/user/new',
			type: 'POST',
			data: {

				'_token': $('input[name=_token]').val(),
				'username': $('input[name=username]').val(),
				'email' : $('input[name=email]').val(),
				'password' :$('input[name=password]').val(),

			},
			success: function(result){

				msgs = JSON.parse(result);
				if(msgs.error == 'true'){
					error_message(msgs.username,'#alert-username');
					error_message(msgs.email,'#alert-email');
					error_message(msgs.password,'#alert-password');
				}else{

					window.location.assign(BASE);
				}
				
			}
		})

		.always(function() {
			btn.html(btn_old);

		});
		



	});
}

function error_message(item,id){

	if(item.length){

		$(String(id)).html(item);
		$(String(id)).fadeIn('slow');

	}else{

		$(String(id)).slideUp('fast');
	}
}
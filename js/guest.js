jQuery(document).ready(main);
function main(){

	$('#show-register').click(function(event) {
		event.preventDefault();
		$('#register-modal').modal('show');
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
jQuery(document).ready(main);
function main(){

	$('#s').click(function(event){

		event.preventDefault();
		var term = $('#term').val();
		window.location = BASE+'/s/'+term;

	});

	//retrieve messages count
	$.ajax({
		url: BASE+'/message/msgcount',
		type: 'GET',
		success:function(result){

			
		}
	});

	// retrieve latest messages
	var fetched = false;

	if(!fetched){

			$.ajax({

		url:BASE+'/message/msgs',
		type:'GET',
		success:function(result){

			$.ajax({
				url: BASE+'/message/msgs',
				type: 'GET',
				success:function(result){

					$('#messages-lt>.container-fluid').html(result);
					$('.message-row:first-child').addClass('message-active');

					// retrieve message content
					$('.message-row').click(function(){

						msgId = $(this).attr('msg');
						element = $(this);
						element.removeClass('new-msg');
						$.ajax({
							url: BASE+'/message/readmsg/'+msgId,
							type: 'GET',
							success:function(result){

								$('.message-active').removeClass('message-active');
								element.addClass('message-active');
								$('#msg-content').html(result);

							}
						})
					});

					// reply to message
					$('#send-message').click(function(event) {
						event.preventDefault();
						msgID = $('.message-active').attr('msg');
						url = $('#reply-area').attr('action');
						btn = $(this);
						loading = '<i class="fa fa-spinner fa-spin"></i>';
						btn_old = 'Send';

						btn.html(loading);

						$.ajax({
							url: url,
							type: 'POST',
							data: {
								'_token': $('input[name=_token]').val(),
								'id'	:msgID,
								'content':$('#reply-content').val()
							},
							success:function(result){
								console.log(result);
							}

						})
						.done(function() {
							btn.html(btn_old);
						

						})
						

					});

				}
				
			})
			

		}

	});

	}

	// Retrieve first message content
	$.ajax({
		url: BASE+'/message/readmsg',
		type: 'GET',
		success:function(result){

			$('#msg-content').html(result);
		}
	});
	


	$('#show-msg').click(function(event) {
		
		event.preventDefault();
		$('#mazaj-messages').modal('show');
		$('#show-msg .mazaj-count').fadeOut('slow');

		
	});


	
	

	

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

	$('#feed-tabs a').click(function (e) {
  e.preventDefault()
  $(this).tab('show')
})


	// Browse cover pic
	$('#select-cover').click(function(event){

		event.preventDefault();
		$('#coverimg').click();

	});

	$('#coverimg').change(function(){

		var img = $(this).val();
		//ajax upload img
		//view img

	});

	//Browse track file
	$('#track-browse').click(function(event){

		event.preventDefault();
		$('#trackfile').click();

	});

	

function error_message(item,id){

	if(item.length){

		$(String(id)).html(item);
		$(String(id)).fadeIn('slow');

	}else{

		$(String(id)).slideUp('fast');
	}
}


/*
	*---------------------------------------
	* FOLLOW
	*---------------------------------------
	*/

	$('.btn-follow').click(function(event){

		var this_btn = $(this);
		var followed_id = this_btn.attr('data');
		var action = $(this).attr('action');

		var url = BASE+'/follow/follow';
		if(action != ' follow '){

			url = BASE+'/follow/unfollow';
			this_btn.html('Follow');
			this_btn.attr('action',' follow ');

			num = parseInt($('count').html());
			num--;
			$('count').html(num);



		}else{

			this_btn.html('Unfollow');
			this_btn.attr('action','unfollow');

			num = parseInt($('count').html());
			num++;
			$('count').html(num);

		}
		$.ajax({
			url: url,
			type: 'POST',
			data: {

			 '_token': $('input[name=_token]').val(),
			 followed_id:followed_id,
			},
		})
		
		
		
	});
}

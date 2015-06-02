
var tracks = new Object();


	/*
	*----------------------------------------
	* PLAY AND PAUSE
	*----------------------------------------
	*/

	$('.play').click(function(){

		var item = $(this).closest('.item-row');
		var name = $(this).closest('.item-row').attr('track');
		var status = $(this).closest('.item-row').attr('status');
		if(status == 'off'){

			item.find('.glyphicon-play').removeClass('glyphicon-play').addClass('glyphicon-pause');
			item.attr('status','on');
			play(name,item);
		}else{

			item.find('.glyphicon-pause').removeClass('glyphicon-pause').addClass('glyphicon-play');
			item.attr('status','off');
			pause(name,item);
		}
		
	});

	/*
*-----------------------------------------
* NEXT
*-----------------------------------------
*/

$('.next').click(function(event){

	var item = $(this).closest('.item-row');
	var name = item.attr('track');

	if(tracks[name]){

		pause(name,item);
	}
	
	var next_item = $(this).closest('.item-row').next('.item-row');
	var next_name = $(this).closest('.item-row').next('.item-row').attr('track');

	if(next_name){

		play(next_name,next_item);
	}else{

		tracks[name].currentTime = tracks[name].duration;
	}
	
});

/*
*--------------------------------------------
* PREVIOUS
*--------------------------------------------
*/

$('.prev').click(function(event){

	var item = $(this).closest('.item-row');
	var name = item.attr('track');

	if(tracks[name]){

		pause(name,item);
	}

	var prev_item = $(this).closest('.item-row').prev('.item-row');
	var prev_name= $(this).closest('.item-row').prev('.item-row').attr('track');

	if(prev_name){

		play(prev_name,prev_item);

	}else{

		tracks[name].currentTime = 0;
		
	}

})

/*
*-----------------------------------------
* EXPLICIT RATE
*-----------------------------------------
*/	

	$('.star').click(function(){
		var item = $(this).closest('.item-row').attr('id');
		var rate = $(this).attr('data');
		set_rate(item,rate);
		$(this).prevAll().andSelf().addClass('star-active');
		$(this).nextAll().removeClass('star-active');
		
	});


$('.share').click(function(event){

	var this_btn = $(this);
	var action = this_btn.attr('action');
	var token = $('input[name="_token"]').val();
	var track_id = $(this).closest('.item-row').attr('id');


/*
*--------------------------------------------------
* LIKE
*--------------------------------------------------
*/
	
	if(action ==' like '){

		$.ajax({
			url: BASE+'/like/like',
			type: 'POST',
			data: {

				_token: token,
				track_id :track_id

			},
			beforeSend:function(){

				this_btn.children('.fa').removeClass('fa-heart').addClass('fa-spinner fa-spin');

			},
			success:function(result){

				this_btn.children('.fa').removeClass('fa-spinner fa-spin').addClass('fa-heart');
				this_btn.addClass('used-btn').attr('action','unlike ');
				this_btn.closest('.action-btn').find('.action-count').html(result);


				
			}
		});
		
		
	}


/*
*----------------------------------------------------
* Unlike
*----------------------------------------------------
*/
	if(action=='unlike '){

		$.ajax({
			url: BASE+'/like/unlike',
			type: 'POST',
			data: {

				_token: token,
				track_id :track_id

			},
			beforeSend:function(){

				this_btn.children('.fa').removeClass('fa-heart').addClass('fa-spinner fa-spin');

			},
			success:function(result){

				this_btn.children('.fa').removeClass('fa-spinner fa-spin').addClass('fa-heart');
				this_btn.removeClass('used-btn').attr('action',' like ');
				this_btn.closest('.action-btn').find('.action-count').html(result);


				
			}
		});
	}



/*
*-------------------------------------------------
* REPOST
*-------------------------------------------------
*/

if(action ==' share '){

	$.ajax({
			url: BASE+'/post/post',
			type: 'POST',
			data: {

				_token: token,
				track_id :track_id

			},
			beforeSend:function(){

				this_btn.children('.glyphicon').removeClass('glyphicon glyphicon-retweet').addClass('fa fa-spinner fa-spin');

			},
			success:function(result){

				this_btn.children('.fa').removeClass('fa fa-spinner fa-spin').addClass('glyphicon glyphicon-retweet');
				this_btn.addClass('used-btn').attr('action','unshare ');
				this_btn.closest('.action-btn').find('.action-count').html(result);


				
			}
		});
}

/*
*------------------------------------------------------
* Unshare
*--------------------------------------------------
*/

if(action=='unshare '){


	$.ajax({
			url: BASE+'/post/unpost',
			type: 'POST',
			data: {

				_token: token,
				track_id :track_id

			},
			beforeSend:function(){

				this_btn.children('.glyphicon').removeClass('glyphicon glyphicon-retweet').addClass('fa fa-spinner fa-spin');

			},
			success:function(result){

				this_btn.children('.fa').removeClass('fa fa-spinner fa-spin').addClass('glyphicon glyphicon-retweet');
				this_btn.removeClass('used-btn').attr('action',' share ');
				this_btn.closest('.action-btn').find('.action-count').html(result);


				
			}
		});

}


	
});



function play(name,item){

	var present = false;
	$.each(tracks,function(index,value){
		if(index==name){

			present = true;
			return false;
		}
	});
	
	if(!present){

		var name = String(name);
		tracks[name]= new Audio(BASE+'/storage/tracks/'+name);
		pauseAll(name);
		tracks[name].play();

	}else{

		pauseAll(name);
		tracks[name].play();

		
	}
	item.find('.glyphicon-play').removeClass('glyphicon-play').addClass('glyphicon-pause');
	item.attr('status','on');

	tracks[name].addEventListener('timeupdate',function(){

		var pos = 100 * tracks[name].currentTime / tracks[name].duration;
		var timer = getTimer(tracks[name].currentTime);
		item.find('.seeker-inner').css('width',pos+'%');
		item.find('.timer').children('p').html(timer);

		/**
		* ajax request to update rate
		* send request if current time > 1/3 duration
		*/

		

		

	});

	tracks[name].addEventListener('ended',function(){

		item.find('.glyphicon-pause').removeClass('glyphicon-pause').addClass('glyphicon-play');
		item.attr('status','off');
		item.find('.next').click();
		
	});
}

function pauseAll(name){
	$.each(tracks,function(index,value){

		value.pause();

	});
	var items = $('.item-row');
		$.each(items,function(){

			if($(this).attr('track')!=name){
				$(this).find('.glyphicon-pause').removeClass('glyphicon-pause').addClass('glyphicon-play');
				$(this).attr('status','off');
			}
			
			
		});
}

function pause(name,item){

	
	var name = item.attr('track');
	tracks[name].pause();
	item.find('.glyphicon-pause').removeClass('glyphicon-pause').addClass('glyphicon-play');
	item.attr('status','off');
	

}

function getTimer(time){

	 time = Math.floor(time);

	 hrs = parseInt(time/3600);
	 time = time - hrs*3600;

	 mins = parseInt(time/60);
	 secs = time - mins*60;

	 

	return hrs +':'+mins +':'+secs;
}

function set_rate(item,rate){
	var token = $('input[name="_token"]').val();
	$.ajax({
		url: BASE+'/rate/explicit',
		type: 'POST',
		data: {

			_token:token,
			 item :item,
			 rate :rate
		}
	})
	
}


/**
*----------------------------------------
* New Playlist
*----------------------------------------
*/

$('#cr-new-pl').click(function(event){

	event.preventDefault();
	var this_btn = $(this);
	var loading = 'loading' + " <i class='fa fa-spinner fa-spin'></i>"
	var token = $('input[name="_token"]').val();
	var name =$('#list-name').val();

	//ajax request to create new playlist
	if(name.length)
	$.ajax({
		url: BASE+'/playlist/create',
		type: 'POST',
		data: {

			_token:token,
			name:name
		},
		beforeSend:function(){

			this_btn.html(loading);
		},
		success:function(result){

			$('.old-pl').append(result);
			this_btn.html('New Playlist');
		}
	})
	
	

});


$('.add-to-list').click(function(event){

	$('#add-to-pl').modal('show');

	/**
*--------------------------------------------
* View user play lists
*--------------------------------------------
*/

var track_id = $(this).closest('.item-row').attr('id');
$.ajax({
	url: BASE+'/playlist/all',
	type: 'default GET (Other values: POST)',
	dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
	data: {param1: 'value1'},
})
.done(function() {
	console.log("success");
})
.fail(function() {
	console.log("error");
})
.always(function() {
	console.log("complete");
});



/*
*-------------------------------------------
* ADD TO PLAYLIST
*-------------------------------------------
*/

	
});







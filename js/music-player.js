jQuery(document).ready(main);
var tracks = new Object();
function main(){

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
	
	$('.star').hover(function(){
		$(this).prevAll().andSelf().addClass('star-active');
		$(this).nextAll().removeClass('star-active');
	},function(){

		/* SHOULD BE EDITED TO SET THE ACTUAL RATE BEFORE MOUSE HOVER
		*
		* THIS CAN BE GET THROUGH CHECKING DATABASE 
		* OR THROUGH CHECKING THE SESSION
		*
		*/


		$(this).prevAll().andSelf().removeClass('star-active');
	});

	$('.star').click(function(){
		var item = $(this).closest('.item-row').attr('id');
		var rate = $(this).attr('data');
		set_rate(item,rate);
	});

/*
*-------------------------------------------
* ADD TO PLAYLIST
*-------------------------------------------
*/

$('.add-to-list').click(function(event){

	$('#add-to-pl').modal('show');
});



/*
*-------------------------------------------------
* REPOST
*-------------------------------------------------
*/


/*
*--------------------------------------------------
* LIKE
*--------------------------------------------------
*/

} // main


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

		if(){

			
		}

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

	console.log(item);
	console.log(rate);
}






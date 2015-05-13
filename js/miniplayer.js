$(function() {
	$("body").addClass("listen");
	initAudio();
});


function initAudio() {
	
	var supportsAudio = !!document.createElement('audio').canPlayType,
			audio,
			loadingIndicator,
			positionIndicator,
			timeleft,
			loaded = false,
			manualSeek = false;

	if (supportsAudio) {
		
		var episodeTitle = '1';//$('body')[0].id;
		
		var player = '<p class="miniplayer">\
			<span id="timeleft">00:00</span>\
			<span id="gutter">\
			<span id="loading" />\
			<span id="handle" class="ui-slider-handle" />\
			</span>\
                        <span id="playtoggle" />\
			<audio preload="metadata">\
			</audio>\
			</p>';									
//			$("#listen").html(player);
			$("div[id=listen]").html(player);


		//$("#listen").each(function( index ) {
		//$("#listen").css({"color": "red", "border": "2px solid red"});

		audio = $('.miniplayer audio').get(0);
		loadingIndicator = $('.miniplayer #loading');
		positionIndicator = $('.miniplayer #handle');
		timeleft = $('.miniplayer #timeleft');
		
		if ((audio.buffered != undefined) && (audio.buffered.length != 0)) {
			$(audio).bind('progress', function() {
				var loaded = parseInt(((audio.buffered.end(0) / audio.duration) * 100), 10);
				loadingIndicator.css({width: loaded + '%'});
			});
		}
		else {
			loadingIndicator.remove();
		}
		
		$(audio).bind('timeupdate', function() {
			
			var rem = parseInt(audio.currentTime, 10),
					pos = (audio.currentTime / audio.duration) * 100,
					mins = Math.floor(rem/60,10),
					secs = rem - mins*60;
			
			timeleft.text((mins < 10 ? '0' + mins : mins) + ':' + (secs < 10 ? '0' + secs : secs));
			if (!manualSeek) { positionIndicator.css({left: pos + '%'}); }
			if (!loaded) {
				loaded = true;
				
				$('.miniplayer #gutter').slider({
						value: 0,
						step: 0.01,
						orientation: "horizontal",
						range: "min",
						max: audio.duration,
						animate: true,					
						slide: function(){							
							manualSeek = true;
						},
						stop:function(e,ui){
							manualSeek = false;					
							audio.currentTime = ui.value;
						}
					});
			}
			
		}).bind('play',function(){
			//$("#playtoggle").addClass('playing');		
			$("*[id^=playtoggle]").addClass('playing');
		}).bind('pause ended', function() {
			//$("#playtoggle").removeClass('playing');		
			$("*[id^=playtoggle]").removeClass('playing');		
		});		
		
//		$("#playtoggle").click(function() {
		$("*[id^=playtoggle]").click(function() {
				
			if (audio.paused) {
				if(audio.src == "")
				{
					var source=$(this).parents("div").eq(2).attr("title");
//					audio.src= 'http://127.0.0.1/' + source + '.wav';
					audio.src= 'uploads/0/' + source + '.wav';
				}
				audio.play();
			} 
			else { audio.pause(); }			
		});

	}
	
	
}
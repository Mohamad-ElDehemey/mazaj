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
		var playerbox = '<div style="float:left;height:175px;width:35%">\
                        <img src="uploads/0/cover.png" style="height:170px;width:175px;margin-top:-27px;margin-left:-27px;border-top-left-radius:15px;border-top-right-radius:15px;border-bottom-left-radius:15px;border-bottom-right-radius:15px"></img>\
                        </div>\
                        <div style="height:100%">\
                        <div id="player_controls" style="float:left;margin-left:-35px;margin-top:-45px;display:inline-block">\
                        <div id = "prev" style="background-image: url(' + "'" + 'img/backward.png' + "'" + ');background-repeat:no-repeat;display:inline-block;"></div>\
                        <div id = "play" style="background-image: url(' + "'" + 'img/play.png' + "'" + ');background-repeat:no-repeat;display:inline-block;margin-bottom:5px;margin-left:-15px;"></div>\
                        <div id = "next" style="background-image: url(' + "'" + 'img/forward.png' + "'" + ');background-repeat:no-repeat;display:inline-block;margin-left:-10px;"></div>\
                        </div>\
                        <div id="like_repost_controls" style="float:right;display:inline-block;width:130px;margin-top:-30px;margin-right:-55px">\
                        <div id = "repost" style="background-image: url(' + "'" + 'img/repost.png' + "'" + ');background-repeat:no-repeat;display:inline-block;margin-left:-10px;padding:10px;"></div>\
                        <div id = "like" style="background-image: url(' + "'" + 'img/like.png' + "'" + ');background-repeat:no-repeat;display:inline-block;margin-left:10px;padding:10px;"></div>\
                        </div>\
                        <div id="like_repost_results" style="float:right;display:inline-block;width:130px;margin-top:-30px;margin-right:-55px;padding:0px">\
                        <div id = "repost" style="margin-left:-20px;display:inline-block;width:10%;padding-top:0px;color:#ED8685">1111</div>\
                        <div id = "like" style="margin-left:-20px;display:inline-block;width:10%;padding-top:0px;color:#ED8685">1111</div>\
                        </div>\
                        <div id="TrackName" style="float:left;margin-left:-220px;margin-top:-30px;display:block">\
                        <span id="TrackName-1" style="font-size:18px;color:#FFE5E5">Love Story</span>\
                        <span>i dont know</span>\
                        </div>\
                        <br>\
                        <div id="listen" style="display:block"></div>\
                        </div>';

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
			$("div[id=miniplayer]").html(playerbox);
			$("div[id=miniplayer]").attr("style", "width:80%;height:175px;background-color:#D54542;border-top-left-radius:15px;border-top-right-radius:15px;border-bottom-left-radius:15px;border-bottom-right-radius:15px;padding:0px")
			$("div[id=listen]:not(.mainplayer)").html(player);
//			$("div[id=listen].mainplayer").html(player);
			if($("div[id=listen].mainplayer").html() == "")
			{
				$("div[id=listen].mainplayer").html(player);

			}

		//$("#listen").each(function( index ) {
		//$("#listen").css({"color": "red", "border": "2px solid red"});

//		audio = $('.miniplayer audio').get(2); //third one [main]
		audio = $("div[id=listen].mainplayer audio").get(0); //select main player
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
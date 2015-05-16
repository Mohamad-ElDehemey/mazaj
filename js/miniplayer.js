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
		var playerbox = '<div style="float:left;height:175px;width:35%">\
                        <img src="uploads/0/cover.png" style="height:170px;width:175px;margin-top:-27px;margin-left:-27px;border-top-left-radius:15px;border-top-right-radius:15px;border-bottom-left-radius:15px;border-bottom-right-radius:15px"></img>\
                        </div>\
                        <div style="height:100%">\
                        <div id="player_controls" style="float:left;margin-left:-35px;margin-top:-45px;display:inline-block">\
                        <div id = "prev" onclick="prevtrack( $(this) )"></div>\
                        <span id = "playtoggle"></span>\
                        <div id = "next" onclick="nexttrack( $(this) )"></div>\
                        </div>\
                        <div id="like_repost_controls" style="float:right;display:inline-block;width:130px;margin-top:-30px;margin-right:-55px">\
                        <div id = "repost" onclick="repost( $(this) )" style="background-image: url(' + "'" + 'img/repost.png' + "'" + ');background-repeat:no-repeat;display:inline-block;margin-left:-10px;padding:10px;"></div>\
                        <div id = "like" onclick="like( $(this) )" class = "tlike" style="padding:10px;"></div>\
                        </div>\
                        <div id="like_repost_results" style="float:right;display:inline-block;width:130px;margin-top:-30px;margin-right:-55px;padding:0px">\
                        <div id = "reposts" style="margin-left:-20px;display:inline-block;width:10%;padding-top:0px;color:#ED8685">1111</div>\
                        <div id = "likes" style="margin-left:-20px;display:inline-block;width:10%;padding-top:0px;color:#ED8685">1111</div>\
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
			<audio preload="metadata">\
			</audio>\
			</p>';									
//			$("#listen").html(player);
			$("div[id=miniplayer]").html(playerbox);
			$("<br>").insertAfter($("div[id=miniplayer]"));
			$("div[id=miniplayer]").attr("style", "width:80%;height:175px;background-color:#D54542;border-top-left-radius:15px;border-top-right-radius:15px;border-bottom-left-radius:15px;border-bottom-right-radius:15px;padding:0px")
			$("div[id=listen]:not(.mainplayer)").html(player);
//			$("div[id=listen].mainplayer").html(player);
			if($("div[id=listen].mainplayer").html() == "")
			{
				$("div[id=listen].mainplayer").html(player + '<span id="playtoggle" style="margin-top:-21px;margin-left:130px;"></span>');

			}

		//$("#listen").each(function( index ) {
		//$("#listen").css({"color": "red", "border": "2px solid red"});

//		audio = $('.miniplayer audio').get(2); //third one [main]
		audio = $("div[id=listen].mainplayer audio").get(0); //select main player
		loadingIndicator = $('.miniplayer #loading');
//		positionIndicator = $('.miniplayer #handle');
		positionIndicator = $('.miniplayer #handle[title=active]');

//		timeleft = $('.miniplayer #timeleft');
		timeleft = $('.miniplayer #timeleft[title=active]');
		
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
			//$("*[id^=playtoggle]").addClass('playing');
		}).bind('pause ended', function() {
			//$("#playtoggle").removeClass('playing');		
			$("*[id^=playtoggle]").removeClass('playing');		
		}).bind('ended', function() {			

			ended($(this));
		}).bind('seeked', function() {			

			seeked($(this));
		});		
		
//		$("#playtoggle").click(function() {
		$("*[id^=playtoggle]").click(function() {
			if ($(this).parents("div").eq(1).attr('id') != "player") //if not main player
			{
				$('.miniplayer #handle[title=active]').removeAttr("title");
				$('.miniplayer #timeleft[title=active]').removeAttr("title");
			}

			$(this).addClass('playing');
			$("div[id=listen].mainplayer #playtoggle").addClass('playing');
			$(this).parents("div").eq(2).find('#handle').attr("title","active");
			$(this).parents("div").eq(2).find('#timeleft').attr("title","active");
			$("#player").find('#handle').attr("title","active");
			$("#player").find('#timeleft').attr("title","active");
			positionIndicator = $('.miniplayer #handle[title=active]');
			timeleft = $('.miniplayer #timeleft[title=active]');
			if (audio.paused) {
					var source=$(this).parents("div").eq(2).attr("title");
				if(audio.src == "" || audio.src.indexOf('uploads/0/' + source + '.wav')==-1)
				{
					if ($(this).parents("div").eq(2).attr('id') == "miniplayer") //not the main player
					{
						if (audio.src != "")
						{
							next(audio.src,source);
						}
//						audio.src= 'http://127.0.0.1/' + source + '.wav';
						audio.src= 'uploads/0/' + source + '.wav';
						$('.miniplayer #handle').css({left: 0 + '%'});
					}
				}
				audio.play();
				played($(this));
			} 
			else {
				audio.pause();
				paused($(this)); 
			}			
		});

	}
	
	
}
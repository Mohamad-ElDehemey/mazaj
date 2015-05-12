$('#footer_arrow').click(function () {
    $('#player').slideToggle(300,
        function (){
            //put code here may be find next player
            if ($('#player').is(':hidden'))
            {   
                    $('#footer_wrap').css('height','20px'); 
		    $('#footer_arrow').css('top','0px');
		    $('#footer_arrow').css('border-top-right-radius','100%');
		    $('#footer_arrow').css('border-top-left-radius','100%');
		    $('#footer_arrow').css('border-bottom-right-radius','0%');
		    $('#footer_arrow').css('border-bottom-left-radius','0%');
		    $('#footer_arrow').text('show');

            }
            else
	    {
                    $('#footer_wrap').css('height','84px');
		    $('#footer_arrow').css('top','0px');
		    $('#footer_arrow').css('border-top-right-radius','0%');
		    $('#footer_arrow').css('border-top-left-radius','0%');
		    $('#footer_arrow').css('border-bottom-right-radius','100%');
		    $('#footer_arrow').css('border-bottom-left-radius','100%');
		    $('#footer_arrow').text('hide');

	    }
	}

    );
});

/*

$(document).ready(function() {
	
	$("#loading div").fadeOut(4000 , function(){
		
		$(this).parent().fadeOut(1000 , function()
		{
			$("body").css("overflow","auto")
			$(this).remove();
		
		}
		
		);
		
		
		
		} );
    
});
*/

$(document).ready(function() {
    $(".counter").countTo(
		{
			from: 50,
        	to: 2500,
        	speed: 4000,	
		}
	
	);
});


 $(document).ready(function() {  
        $("html").niceScroll(
		
		{
			
			cursorcolor: "#09c",
			cursoropacitymin: 0.3,
			cursoropacitymax: 0.8,
			cursorwidth:"20px"
		}
		);
    });
	
	
	
	
	
	
	
	
	
	
	
	
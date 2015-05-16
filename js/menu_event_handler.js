//keep the menu up till clicking outside it ... here is a part and the other one is in loader.js [$(this).parent().toggleClass('open');]
$(document).ready(function() {
	$('body').on('click', function (e) {
    		if (!$('ul.dropdown-menu.scroll-menu.dropdown-playlist').is(e.target) 
        		&& $('ul.dropdown-menu.scroll-menu.dropdown-playlist').has(e.target).length === 0 
        		&& $('.open').has(e.target).length === 0
    		) {
        		$('#playlistload').parent().removeClass('open');
    		}
	});
});


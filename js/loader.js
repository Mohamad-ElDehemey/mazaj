var chromeerror= '<br> if you are using google chrome, try running it with --allow-file-access-from-files <br> or You can follow their progress on the issue <a href="code.google.com/p/chromium/issues/detail?id=40787">here:</a>';
$(document).ready(function(){
    $('#home').load('Home.html', '', function(response, status, xhr) {
        if (status == 'error') {
            var msg = "Sorry but there was an error: ";
            $("#home").html(msg + xhr.status + " " + xhr.statusText + chromeerror);
        }
    });

    $('#Followers').load('Followers.html', '', function(response, status, xhr) {
        if (status == 'error') {
            var msg = "Sorry but there was an error: ";
            $("#Followers").html(msg + xhr.status + " " + xhr.statusText + chromeerror);
        }
    });
    $('#Likes').load('Likes.html', '', function(response, status, xhr) {
        if (status == 'error') {
            var msg = "Sorry but there was an error: ";
            $("#Likes").html(msg + xhr.status + " " + xhr.statusText + chromeerror);
        }
    });
});

$(document).on("click", "#profile", "", function(){
    $('#home').load('Profile.html', '', function(response, status, xhr) {
        if (status == 'error') {
            var msg = "Sorry but there was an error: ";
            $("#home").html(msg + xhr.status + " " + xhr.statusText + chromeerror);
        }
    });

    $('#Followers').load('Followers.html', '', function(response, status, xhr) {
        if (status == 'error') {
            var msg = "Sorry but there was an error: ";
            $("#Followers").html(msg + xhr.status + " " + xhr.statusText + chromeerror);
        }
    });
    $('#Likes').load('Likes.html', '', function(response, status, xhr) {
        if (status == 'error') {
            var msg = "Sorry but there was an error: ";
            $("#Likes").html(msg + xhr.status + " " + xhr.statusText + chromeerror);
        }
    });    
});
$(document).on("click", "#upload", "", function(){
    $('#home').load('upload.html', '', function(response, status, xhr) {
        if (status == 'error') {
            var msg = "Sorry but there was an error: ";
            $("#home").html(msg + xhr.status + " " + xhr.statusText + chromeerror);
        }
    });

    $('#Followers').load('Followers.html', '', function(response, status, xhr) {
        if (status == 'error') {
            var msg = "Sorry but there was an error: ";
            $("#Followers").html(msg + xhr.status + " " + xhr.statusText + chromeerror);
        }
    });
    $('#Likes').load('Likes.html', '', function(response, status, xhr) {
        if (status == 'error') {
            var msg = "Sorry but there was an error: ";
            $("#Likes").html(msg + xhr.status + " " + xhr.statusText + chromeerror);
        }
    });    
});
$(document).on("click", "#homepage", "", function(){
    $('#home').load('home.html', '', function(response, status, xhr) {
        if (status == 'error') {
            var msg = "Sorry but there was an error: ";
            $("#home").html(msg + xhr.status + " " + xhr.statusText + chromeerror);
        }
    });

    $('#Followers').load('Followers.html', '', function(response, status, xhr) {
        if (status == 'error') {
            var msg = "Sorry but there was an error: ";
            $("#Followers").html(msg + xhr.status + " " + xhr.statusText + chromeerror);
        }
    });
    $('#Likes').load('Likes.html', '', function(response, status, xhr) {
        if (status == 'error') {
            var msg = "Sorry but there was an error: ";
            $("#Likes").html(msg + xhr.status + " " + xhr.statusText + chromeerror);
        }
    });    
});
$(document).on("click", "#playlistload", "", function(){
    $('.dropdown-playlist').load('playlists.html', '', function(response, status, xhr) {
        if (status == 'error') {
            var msg = "Sorry but there was an error: ";
            $(".dropdown-playlist").html(msg + xhr.status + " " + xhr.statusText + chromeerror);
        }
    });    

    $('.dropdown-playlist').css('max-height', ($(window).height() - $('.dropdown-playlist').offset().top) + 'px');
    $('.dropdown-playlist').css('height', ($(window).height() - $('.dropdown-playlist').offset().top) + 'px');
});

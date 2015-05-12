$(document).ready(function(){
    $('#home').load('Home.html', '', function(response, status, xhr) {
        if (status == 'error') {
            var msg = "Sorry but there was an error: ";
            $("#home").html(msg + xhr.status + " " + xhr.statusText);
        }
    });

    $('#Followers').load('Followers.html', '', function(response, status, xhr) {
        if (status == 'error') {
            var msg = "Sorry but there was an error: ";
            $("#Followers").html(msg + xhr.status + " " + xhr.statusText);
        }
    });
    $('#Likes').load('Likes.html', '', function(response, status, xhr) {
        if (status == 'error') {
            var msg = "Sorry but there was an error: ";
            $("#Likes").html(msg + xhr.status + " " + xhr.statusText);
        }
    });
});

$(document).on("click", "#profile", "", function(){
    $('#home').load('Profile.html', '', function(response, status, xhr) {
        if (status == 'error') {
            var msg = "Sorry but there was an error: ";
            $("#home").html(msg + xhr.status + " " + xhr.statusText);
        }
    });

    $('#Followers').load('Followers.html', '', function(response, status, xhr) {
        if (status == 'error') {
            var msg = "Sorry but there was an error: ";
            $("#Followers").html(msg + xhr.status + " " + xhr.statusText);
        }
    });
    $('#Likes').load('Likes.html', '', function(response, status, xhr) {
        if (status == 'error') {
            var msg = "Sorry but there was an error: ";
            $("#Likes").html(msg + xhr.status + " " + xhr.statusText);
        }
    });    
});
$(document).on("click", "#upload", "", function(){
    $('#home').load('upload.html', '', function(response, status, xhr) {
        if (status == 'error') {
            var msg = "Sorry but there was an error: ";
            $("#home").html(msg + xhr.status + " " + xhr.statusText);
        }
    });

    $('#Followers').load('Followers.html', '', function(response, status, xhr) {
        if (status == 'error') {
            var msg = "Sorry but there was an error: ";
            $("#Followers").html(msg + xhr.status + " " + xhr.statusText);
        }
    });
    $('#Likes').load('Likes.html', '', function(response, status, xhr) {
        if (status == 'error') {
            var msg = "Sorry but there was an error: ";
            $("#Likes").html(msg + xhr.status + " " + xhr.statusText);
        }
    });    
});
$(document).on("click", "#homepage", "", function(){
    $('#home').load('home.html', '', function(response, status, xhr) {
        if (status == 'error') {
            var msg = "Sorry but there was an error: ";
            $("#home").html(msg + xhr.status + " " + xhr.statusText);
        }
    });

    $('#Followers').load('Followers.html', '', function(response, status, xhr) {
        if (status == 'error') {
            var msg = "Sorry but there was an error: ";
            $("#Followers").html(msg + xhr.status + " " + xhr.statusText);
        }
    });
    $('#Likes').load('Likes.html', '', function(response, status, xhr) {
        if (status == 'error') {
            var msg = "Sorry but there was an error: ";
            $("#Likes").html(msg + xhr.status + " " + xhr.statusText);
        }
    });    
});
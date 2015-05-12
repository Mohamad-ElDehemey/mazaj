$(document).ready(function() { 
	var options = { 
			target:   '#output',   
			beforeSubmit:  beforeSubmit,
			success:       afterSuccess,
			uploadProgress: OnProgress, 
			resetForm: true
		}; 
		
	 $('#MyUploadForm').submit(function() { 
			$(this).ajaxSubmit(options);  			
			return false; 
		}); 
		
function afterSuccess()
{
	$('#submit-btn').show();
	$('#loading-img').hide();
	$('#progressbox').delay( 1000 ).fadeOut();

}

function beforeSubmit(){
   if (window.File && window.FileReader && window.FileList && window.Blob)
	{
		
		if( !$('#FileInput').val()) 
		{
			$("#output").html("Are you kidding me?");
			return false
		}	
		var fsize = $('#FileInput')[0].files[0].size;
		var ftype = $('#FileInput')[0].files[0].type;
	switch(ftype)
        {
            case 'image/png': 
			case 'audio/mpeg': 
			case 'audio/x-mpeg': 
			case 'audio/mp3':
			case 'audio/x-mp3 ':
			case 'audio/mpeg3':
			case 'audio/x-mpeg3':
			case 'audio/mpg':
			case 'audio/x-mpg':
			case 'audio/x-mpegaudio':
                break;
            default:
                $("#output").html("<b>"+ftype+"</b> Unsupported file type!");
				return false
        }
		
		if(fsize>5242880) 
		{
			$("#output").html("<b>"+bytesToSize(fsize) +"</b> Too big file! <br />File is too big, it should be less than 5 MB.");
			return false
		}
				
		$('#submit-btn').hide(); //hide submit button
		$('#loading-img').show(); //hide submit button
		$("#output").html("");  
	}
	else
	{
		$("#output").html("Please upgrade your browser, because your current browser lacks some new features we need!");
		return false;
	}
}

function OnProgress(event, position, total, percentComplete)
{
    //Progress bar
	$('#progressbox').show();
    $('#progressbar').width(percentComplete + '%');
    $('#statustxt').html(percentComplete + '%');
    if(percentComplete>50)
        {
            $('#statustxt').css('color','#000');
        }
}
function bytesToSize(bytes) {
   var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
   if (bytes == 0) return '0 Bytes';
   var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
   return Math.round(bytes / Math.pow(1024, i), 2) + ' ' + sizes[i];
}

}); 

<?php

if(isset($_FILES["FileInput"]) && $_FILES["FileInput"]["error"]== UPLOAD_ERR_OK)
{
	$UploadDirectory	= 'uploads/'; //specify upload directory ends with / (slash)
	if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])){
		die();
	}
	if ($_FILES["FileInput"]["size"] > 5242880) {
		die("File size is too big!");
	}
	switch(strtolower($_FILES['FileInput']['type']))
		{
			//allowed file types [http://filext.com/file-extension/MP3]
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
				die('Unsupported File!'); //output error
	}
	
	$File_Name          = strtolower($_FILES['FileInput']['name']);
	$File_Ext           = substr($File_Name, strrpos($File_Name, '.')); //get file extention
	$Random_Number      = rand(0, 9999999999); //Random number to be added to name. we should replace it with select count(id) from tracks + 1 for less bugs
	$NewFileName 		= $Random_Number.$File_Ext; //new file name
	
	if(move_uploaded_file($_FILES['FileInput']['tmp_name'], $UploadDirectory.$NewFileName ))
	   {
		die('Success! File Uploaded.');
	}else{
		die('error uploading File!');
	}
	
}
else
{
	die('Something wrong with upload! Please try again later');
}
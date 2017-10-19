<?php

/*{
"VERSION": 1.12,
"AUTHOR": "MOISÉS DE LIMA",
"UPDATE": "19/10/2017"
}*/

$login = true;

if($login === true){

	$location = '/home/site/www';

	$file = 'file1GB.zip';

	// NO LIMIT FOR PHP EXECUTION TIME
	set_time_limit(0);

	// PREVENT BLOCK NAVIGATION WHILE FILE IS DOWNLOADING
	session_write_close();

	// FILE EXISTS
	if(is_file($location.'/'. $file)){

		// MIME TYPE OF FILE
		$mime = mime_content_type($location.'/'. $file);

		// SIZE IN BYTES
		$length = filesize($location.'/'. $file);

		// FOR VIEW FILE IN NAVIGATOR USE: ?inline
		$disposition = 'attachment';
		if(isset($_GET['inline'])){
			$disposition = 'inline';
		}

		header('Content-type: '.$mime.';');
		header('Content-Transfer-Encoding: Binary');
		header('Content-Length: '.$length);
		header('Content-disposition: '.$disposition.'; filename="'.$file.'"');

		// BUFFER, DON'T readfile(), READFILE CAN USE ALL MEMORY CONFIG in php.ini
		$fd = fopen ($file, 'rb');
		while(!feof($fd)) {
			$buffer = fread($fd, 2048);
			echo $buffer;
		}
		fclose ($fd);

	}
}

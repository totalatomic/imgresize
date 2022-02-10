<?php

function method1($file){

	// $file is the complete image object
	$max_width = 400;
	$max_height = 400;

	list($old_width, $old_height, $type, $attr) = getimagesize($file);
	$image = imagecreatefrompng($file);
	// Calculate the scaling we need to do to fit the image inside our frame
	$scale = min($max_width/$old_width, $max_height/$old_height);

	// Get the new dimensions
	$new_width  = ceil($scale*$old_width);
	$new_height = ceil($scale*$old_height);

	// Create new empty image
	$newFile = imagecreatetruecolor($new_width, $new_height);

	// Resize old image into new
	$test = imagecopyresampled($newFile, $image,
    	0, 0, 0, 0,
    	$new_width, $new_height, $old_width, $old_height);
	ob_start();
	var_dump($test);
	imagepng($newFile, 'C:/xampp/htdocs/imagescale/res/method1',9);
	$data = ob_get_clean();

	// clean-up
	imagedestroy($image);
	imagedestroy($newFile);
	var_dump($data);
	return $data;
}
function method2(){
	return;
}
function method3(){
	return;
}

error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

// try to fit 48.000.000 maar mot passen -> het probleem is cumulatief!
// into allowed 134.217.728
ini_set('memory_limit', '1024M');
// adittionally set the used vars to null
// additionally unset the used vars

// then it stops after 30 seconds
// for dubugging set longer: 3 mins
ini_set('max_execution_time', 180);

echo 'Gestart<br>';
$dir_name = "./images/";
$imgs = glob($dir_name."*.png");
foreach ($imgs as $img) {
	//echo '<img src="'.$img.'" /><br />';
	// Read image path, convert to base64 encoding
	method1($img);
}

// $dirlist = scandir('.');
#var_dump($dirlist); exit;

// foreach($dirlist AS &$directory){
// 	if($directory <> '.'){
// 		if($directory <> '..'){
// 			echo 'Nu : '.$directory.'<br>';
// 			$pad = $directory.'/resources/';
// 			$filelist  = scandir($pad);
// 			echo 'Lijst '.json_encode($filelist);
			
// 			foreach($filelist AS &$file) {

// 				$txtfile = explode('_',$file);
// 				$txtfile = $pad.$xmlfile[0].'_T4_Text.txt';
// 				echo 'Unlinking '.$txtfile.'<br>';
// 				unlink($pad.$txtfile);

// 				if (strpos($file, '.txt') === false) {

// 					if (strpos($file, '.mp3') !== false) {
// 						echo 'mp3 '.$pad.$file.'<br>';
// 						unlink($pad.$file);
// 					} else {

// 						if (strpos($file, '.png') !== false) {
							
// 							$filename = $pad.$file;
// 							echo 'Now handling '.$pad.$file.'<br>';
// 							echo 'Regel 39 This file is '.filesize($filename).' Byte <br>';

// 							echo 'normal file - resize and copy <br>';
// 							$source = imagecreatefrompng($filename);
// 							if($source==false){
// 								echo 'FUGA image create failed, could not create or read image';
// 								//mail('robin@basecode.nl','FUGA image create failed','Could not create or read image file: '.$filename);
// 							}
// 							//imagealphablending($source, false);
// 							$thumb = imagescale($source, 400, -1);

// 							imagepng($thumb,'../fuga/thumbs/img_sm_cp_cp_'.$file);

// 							$thumb = imagescale($source, 1200, -1);
// 							imagepng($thumb,'../fuga/thumbs/img_cp_cp_'.$file);

// 							echo 'The memory used is: ';
// 							echo memory_get_usage();
// 							echo '<br>';
// 							$source = null;
// 							$thumb = null;
// 							unset($source);
// 							unset($thumb);
// 							echo 'The memory used is: ';
// 							echo memory_get_usage();
// 							echo '<br>';							

// 							//einde move directory
						
// 						} // png
				
// 					}//not txt (else)
					
// 				}
// 			}
// 		}
// 	}
// }

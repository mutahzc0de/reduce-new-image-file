<?php 
date_default_timezone_set("Asia/Jakarta");
function scan_dir($dir) {
    $ignored = array('.', '..', '.svn', '.htaccess');

    $files = array();   
    $ambil =  preg_grep('~\.(jpeg|jpg|png|PNG|JPEG|JPG)$~', scandir($dir)); 
    foreach ($ambil as $file) {
        if (in_array($file, $ignored)) continue;
        if (time()-filemtime($dir . '/' . $file) >3600*24*7) {
        	
        }else{
        	$files[$file] = filemtime($dir . '/' . $file);
        }
        
    }

    arsort($files);
    $files = array_keys($files);

    return ($files) ? $files : false;
}


function tesx($source, $destination, $quality) {

        $info = getimagesize($source);

        if ($info['mime'] == 'image/jpeg')
                $image = imagecreatefromjpeg($source);

        elseif ($info['mime'] == 'image/gif')
                $image = imagecreatefromgif($source);

        elseif ($info['mime'] == 'image/png')
                $image = imagecreatefrompng($source);

        imagejpeg($image, $destination, $quality);

        return $destination;
}


$sc = date('Y-m');
$x = scan_dir($sc);
for ($i=0; $i <count($x) ; $i++) { 
	$namafile = $x[$i];
	

	$cek = explode('-', $namafile);
	if (count($cek)>1 AND $cek['0']=='small') {
		// echo "ini gak di hitung";
	}else{
		
		$fs = 'small-'.$namafile;
		if (file_exists($sc.'/'.$fs)) {
			
		} else {
		echo $namafile.' ></br> ';
		echo tesx($sc.'/'.$namafile, $sc.'/small-'.$namafile, 50);
		echo "<hr>";
		}
		
	}
}

?>

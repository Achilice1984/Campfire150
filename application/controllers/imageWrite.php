<?PHP
class WriteImage extends Controller{
 private function make_thumb($type, $src, $dest, $maxsize) {
  if($type=='png'){
   $source_image = imagecreatefrompng($src);
  }
  if($type=='jpeg'){
   $source_image = imagecreatefromjpeg($src);
  }
  if($type=='gif'){
   $source_image = imagecreatefromgif($src);
  }
  $width = imagesx($source_image);
  $height = imagesy($source_image); 
  if ($height > $width) {   
   $ratio = $maxsize / $height;  
   $newheight = $maxsize;
   $newwidth = floor($width * $ratio);
  }else {
   $ratio = $maxsize / $width;   
   $newwidth = $maxsize;  
   $newheight = floor($height * $ratio);   
  }
  $virtual_image = imagecreatetruecolor($newwidth, $newheight);
  imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
  if($type=='png'){
   imagepng($virtual_image, $dest);
  }
  if($type=='jpeg'){
   imagejpeg($virtual_image, $dest);
  }
  if($type=='gif'){
   imagegif($virtual_image, $dest);
  }
  imagedestroy($virtual_image);
 }
}
?>
<?PHP

 function imageUploadBackground($uploadedImageObject,$userid,$imageid){
  $imageFile=$uploadedImageObject->PictureFile;
  $imageFileType= $uploadedImageObject->PictureFile['type'];
  $imageFileName= $uploadedImageObject->PictureFile['name'];
  $useridhash=md5($userid);
  $imageFunctionType='background';
  $imageQuality=100;
  $largeImageSize=800;
  $mediumImageSize=400;
  $smallImageSize=150;
/*  $imageFileType=$uploadedImageObject->PictureFile; */
/*debugit($uploadedImageObject); */
  $writePath= ROOT_DIR . 'static\\userdata\\images\\background\\'.$useridhash.'\\';
  $writePath= str_replace("/","\\",$writePath);
  createPath($writePath);   
  move_uploaded_file($imageFile['tmp_name'], $writePath.$imageFileName);
  $currentFilePath=$writePath.$imageFileName;
  $largeDir=$writePath.'large_'.$imageFunctionType.'.jpg';
  $mediumDir=$writePath.'medium_'.$imageFunctionType.'.jpg'; 
  $smallDir=$writePath.'small_'.$imageFunctionType.'.jpg';  
  if($imageFileType=='image/png'){
   $jpegImage = imagecreatefrompng($currentFilePath);
  }
  if($imageFileType=='image/gif'){
   $jpegImage = imagecreatefromgif($currentFilePath);   
  }
  if($imageFileType=='image/jpeg'){
   $jpegImage=imagecreatefromjpeg($currentFilePath);
  }
  $width = imagesx($jpegImage);
  $height = imagesy($jpegImage); 
  if ($height > $width) {   
   $ratio = $largeImageSize / $height;  
   $newheight = $largeImageSize;
   $newwidth = floor($width * $ratio);
  }else {
   $ratio = $largeImageSize / $width;   
   $newwidth = $largeImageSize;  
   $newheight = floor($height * $ratio);   
  }
  $virtual_image = imagecreatetruecolor($newwidth, $newheight);
  imagecopyresampled($virtual_image, $jpegImage, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
  imagejpeg($virtual_image,$largeDir);
  if ($height > $width) {   
   $ratio = $mediumImageSize / $height;  
   $newheight = $mediumImageSize;
   $newwidth = floor($width * $ratio);
  }else {
   $ratio = $mediumImageSize / $width;   
   $newwidth = $mediumImageSize;  
   $newheight = floor($height * $ratio);   
  }
  $virtual_image = imagecreatetruecolor($newwidth, $newheight);
  imagecopyresampled($virtual_image, $jpegImage, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
  imagejpeg($virtual_image,$mediumDir);
  if ($height > $width) {   
   $ratio = $smallImageSize / $height;  
   $newheight = $smallImageSize;
   $newwidth = floor($width * $ratio);
  }else {
   $ratio = $smallImageSize / $width;   
   $newwidth = $smallImageSize;  
   $newheight = floor($height * $ratio);   
  }
  $virtual_image = imagecreatetruecolor($newwidth, $newheight);
  imagecopyresampled($virtual_image, $jpegImage, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
  imagejpeg($virtual_image,$smallDir);
  imagedestroy($virtual_image);
  unlink($currentFilePath); 
 }
 
 function createPath($path) {
  if (!file_exists($path)) {
    mkdir($path, 0777, true);
  }
 }
?>
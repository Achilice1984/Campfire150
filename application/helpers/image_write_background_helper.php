<?PHP
/**
 Final structure should look something like
 Application/UserData/images/xxxhasheduserid/large_background.jpg
 Application/UserData/images/xxxhasheduserid/medium_background.jpg
 Application/UserData/images/xxxhasheduserid/small_background.jpg
**/
/**
 $uploadedImage = This will be the actual $_FILE[] itself
 
 $userID = This will be the current userID
 
 $imageType= ("profile" | "background" | "story" )
 
 $storyID= This will be the current storyID
**/
 function imageUpload($uploadedImage,$userID,$imageType){
  $userIDhash=md5($userID);
  $storyIDhash=md5($storyID);
  $writePath= 'Application/UserData/images'.$userIDhash;
  private $largeDir=$writePath.'/large_'.$imageType.'.jpg';
  private $mediumDir=$writePath.'/medium_'.$imageType.'.jpg'; 
  private $smallDir=$writePath.'/small_'.$imageType.'.jpg';
  private $imageQuality=100;
  private $largeImageSize=800;
  private $mediumImageSize=400;
  private $smallImageSize=150;
  $imageFileNameWithoutExtention=basename($uploadedImage); 
  $imageFileType = pathinfo($uploadedImage,PATHINFO_EXTENSION);
  /*
   Once we know what kind of image file it is we universally convert that file to 'jpeg'
  */
  if($imageFileType=='png'){
   $jpegImage = imagecreatefrompng($uploadedImage);
  }
  if($imageFileType=='gif'){
   $jpegImage = imagecreatefromgif($uploadedImage);   
  }
  if($imageFileType=='jpeg'){
   $jpegImage=$uploadedImage;
  }
  /*
   Once we have our file
   we first write to the database, this function has yet to be written
   then, re-size for large,medium,small and write each time to server HDD
   finally release file memory object 
  */
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
 }
?>
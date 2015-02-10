<?PHP
/**
 Final structure should look something like
 Application/UserData/images/xxxhasheduserid/StoryImages/large/xxxhashedimageid.jpg
 Application/UserData/images/xxxhasheduserid/StoryImages/medium/xxxhashedimageid.jpg
 Application/UserData/images/xxxhasheduserid/StoryImages/small/xxxhashedimageid.jpg
 Application/UserData/images/xxxhasheduserid/Profile/large/xxxhashedimageid.jpg
 Application/UserData/images/xxxhasheduserid/Profile/medium/xxxhashedimageid.jpg
 Application/UserData/images/xxxhasheduserid/Profile/small/xxxhashedimageid.jpg
 Application/UserData/images/xxxhasheduserid/Background/large/xxxhashedimageid.jpg
 Application/UserData/images/xxxhasheduserid/Background/medium/xxxhashedimageid.jpg
 Application/UserData/images/xxxhasheduserid/Background/small/xxxhashedimageid.jpg
**/
 function imageUpload($uploadedImage,$userID,$imageType){
  $userIDhash=md5($userID);
  $writePath= 'Application/UserData/images/'.$imageType.'/'.$userIDhash;
  private $largeDir=$writePath.'/large';
  private $mediumDir=$writePath.'/medium'; 
  private $smallDir=$writePath.'/small';
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
   then
   we re-size for large,medium,small and write each time
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
/*
 Once the DB write is created and returns the mysql_insert_id() 
 A hash is made and the files are renamed accordingly. 
  $hashImageDatabaseID=md5( mysql_insert_id() );
  rename($largeDir.'/'.$imageFileNameWithoutExtention.'jpg',$largeDir.'/'.$hashImageDatabaseID.'jpg');
  rename($mediumDir.'/'.$imageFileNameWithoutExtention.'jpg',$mediumDir.'/'.$hashImageDatabaseID.'jpg');
  rename($smallDir.'/'.$imageFileNameWithoutExtention.'jpg',$smallDir.'/'.$hashImageDatabaseID.'jpg');
*/
 }
?>
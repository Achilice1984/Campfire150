<?php
/**
* src=where is the file?
* dest=where to put output
*/
class WriteImage{
 private $originalDir='image/large';
 private $imageDir='image/medium'; 
 private $thumbDir='image/small';
 function png2jpg($originalFile, $outputFile, $quality) {
    $image = imagecreatefrompng($originalFile);
    imagejpeg($image, $outputFile, $quality);
    imagedestroy($image);
}
function gif2jpg($originalFile, $outputFile, $quality) {
    $image = imagecreatefromgif($originalFile);
    imagejpeg($image, $outputFile, $quality);
    imagedestroy($image);
}
 function saveImage($img){
  $userID=$img->userid;
  $imageType=$img->type;
  $imgID-$img->imgid;
  if($imageType!='jpeg'){

  }
 }
 function make_image($type, $src, $dest, $maxsize) {
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
/*
 $id=$_POST['id'];
 $title=$_POST['title'];
 $description=$_POST['description'];
 include 'imageGenerator.php';
 if( ctype_xdigit($title) && ctype_xdigit($description)  ){
  $originalDir='image/original';$imageDir='image/site'; $thumbDir='image/thumb';
  $imgH=600;$imgW=800;
  $thumbH=100;$thumbW=100;
  include 'php/dbconfig.php';
  $xaa="CALL addImgCont()";mysql_query($xaa);
  if( isset($_FILES) ){
   foreach($_FILES["images"]["type"] as $ind => $fileType){ 
    $line=explode("/", $fileType);
    $fileExtention=$line[1];
  // write the image path to the database for easy retrieval later
  // $query="CALL addImg('".$id."','".$title."','".$description."')";
    $result=mysql_query($query);
    $value=mysql_fetch_object($result);
    $valID=$value->id;
    $newFileRef=$id.'_'.$valID.'.'.$fileExtention;
    move_uploaded_file($_FILES["images"]["tmp_name"][$ind], $originalDir.'/'.$newFileRef);
    $src=$originalDir.'/'.$newFileRef;
    $dest=$imageDir.'/'.$newFileRef;
    $maxsize=$imgW;
    make_thumb($fileExtention,$src, $dest, $maxsize);
    $src=$originalDir.'/'.$newFileRef;
    $dest=$thumbDir.'/'.$newFileRef;
    $maxsize=$thumbH;
    make_thumb($fileExtention,$src, $dest, $maxsize);
   } 
  }
  unlink($originalDir.'/'.$newFileRef);
  $array=array($valID,$title,$description,$newFileRef);
  echo json_encode($array);
  mysql_close($db_con);
  include 'php/dbconfig.php';
  $xaa="CALL addImgCont('".$newFileRef."','".$valID."')";mysql_query($xaa);
  mysql_close($db_con);
 }
*/
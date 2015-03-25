<?PHP

function image_save($imageFile, $userid, $imageid, $imageType,
                          $up_height, $up_width, $x, $y)
{
   
    $imageFileType   = $imageFile['type'];
    $imageFileName   = $imageFile['name'];

    $useridhash      = md5($userid);
    $imageidhash     = md5($imageid);


    $imageQuality    = 100;
    $largeImageSize  = 2200;
    $mediumImageSize = 1100;
    $smallImageSize  = 550;
    $xsmallImageSize  = 250;

    /*  $imageFileType=$uploadedImageObject->PictureFile; */
    /*debugit($uploadedImageObject); */
    // $writePath       = ROOT_DIR . 'static\\userdata\\images\\' . $imageType . '\\' . $useridhash . '\\' . $imageidhash . '\\';
    // $writePath       = str_replace("/", "\\", $writePath);

    $writePath       = ROOT_DIR . 'static/userdata/images/' . $imageType . '/' . $useridhash . '/' . $imageidhash . '/';

    $currentFilePath = $writePath . $imageFileName;

    createPath($writePath);     

    move_uploaded_file($imageFile['tmp_name'], $currentFilePath);

    
    $largeDir         = $writePath . 'large.jpg';
    $mediumDir        = $writePath . 'medium.jpg'; 
    $smallDir         = $writePath . 'small.jpg'; 
    $xsmallDir         = $writePath . 'xsmall.jpg'; 

    $jpegImage        = "";

    if($imageFileType == 'image/png'){
        $jpegImage = imagecreatefrompng($currentFilePath);
    }
    if($imageFileType == 'image/gif'){
        $jpegImage = imagecreatefromgif($currentFilePath);   
    }
    if($imageFileType == 'image/jpeg'){
        $jpegImage = imagecreatefromjpeg($currentFilePath);
    }


    $width  = imagesx($jpegImage);
    $height = imagesy($jpegImage);

    //Now that width & height assigned get ratio
    $ratio;

    if($imageType == IMG_STORY)
    {
        $ratio = 16 / 9;
    }
    else if ($imageType == IMG_BACKGROUND) {
        $ratio = 1200 / 400;
    }
    else
    {
        //profile picture
        $ratio = 4 / 4;
    }

    if(!isset($up_height) || !isset($up_width) || !is_numeric($up_height) || !is_numeric($up_width))
    {
        $newheight = $largeImageSize;
        $newwidth  = floor($width * $ratio);

        $up_height = $newheight;
        $up_width  = $newwidth;
    }
    else
    {
        $dif = $up_width - $largeImageSize;

        $newwidth    = $up_width - $dif;
        $newheight   =  floor( ($up_height - (($dif / $up_width)) *  $up_height) );
    }
   

    $src_x  = $x;
    $src_y  = $y;
    if(!isset($x) || !isset($y) || !is_numeric($x) || !is_numeric($y))
    {
        $src_x  = 0;
        $src_y  = 0;
    }    

    $virtual_image = imagecreatetruecolor($newwidth, $newheight);
    imagecopyresampled($virtual_image, $jpegImage, 0, 0, $src_x, $src_y, $newwidth, $newheight, $up_width, $up_height);
    imagejpeg($virtual_image, $largeDir);

    $newheight  = floor($newheight / 2);
    $newwidth   = floor($newwidth  / 2);

    $virtual_image = imagecreatetruecolor($newwidth, $newheight);
    imagecopyresampled($virtual_image, $jpegImage, 0, 0, $src_x, $src_y, $newwidth, $newheight, $up_width, $up_height);
    imagejpeg($virtual_image, $mediumDir);

    $newheight  = floor($newheight / 2);
    $newwidth   = floor($newwidth  / 2);

    $virtual_image = imagecreatetruecolor($newwidth, $newheight);
    imagecopyresampled($virtual_image, $jpegImage, 0, 0, $src_x, $src_y, $newwidth, $newheight, $up_width, $up_height);
    imagejpeg($virtual_image, $smallDir);

    $newheight  = floor($newheight / 2);
    $newwidth   = floor($newwidth  / 2);

    $virtual_image = imagecreatetruecolor($newwidth, $newheight);
    imagecopyresampled($virtual_image, $jpegImage, 0, 0, $src_x, $src_y, $newwidth, $newheight, $up_width, $up_height);
    imagejpeg($virtual_image, $xsmallDir);


    imagedestroy($virtual_image);
    unlink($currentFilePath); 
 }
 
function createPath($path) 
{
    if (!file_exists($path)) 
    {
        mkdir($path, 0777, true);
    }
}
?>
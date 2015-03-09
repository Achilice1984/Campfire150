<?PHP

function image_save($imageFile, $userid, $imageid, $imageType,
                          $up_height, $up_width, $x, $y)
{
   
    $imageFileType   = $imageFile['type'];
    $imageFileName   = $imageFile['name'];

    $useridhash      = md5($userid);
    $imageidhash     = md5($imageid);


    $imageQuality    = 100;
    $largeImageSize  = 1200;
    $mediumImageSize = 600;
    $smallImageSize  = 300;

    /*  $imageFileType=$uploadedImageObject->PictureFile; */
    /*debugit($uploadedImageObject); */
    $writePath       = ROOT_DIR . 'static\\userdata\\images\\' . $imageType . '\\' . $useridhash . '\\' . $imageidhash . '\\';
    $writePath       = str_replace("/", "\\", $writePath);

    $currentFilePath = $writePath . $imageFileName;

    createPath($writePath);     

    move_uploaded_file($imageFile['tmp_name'], $currentFilePath);

    
    $largeDir         = $writePath . 'large.jpg';
    $mediumDir        = $writePath . 'medium.jpg'; 
    $smallDir         = $writePath . 'small.jpg'; 

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

    if(!isset($up_height) || !isset($up_width))
    {
        $ratio     = $largeImageSize / $height;

        $newheight = $largeImageSize;
        $newwidth  = floor($width * $ratio);

        $up_height = $newheight;
        $up_width  = $newwidth;
    }
    else
    {
        $ratio      = $up_width / $up_height;

        $dif = $up_width - $largeImageSize;

        $newwidth    = $up_width - $dif;
        $newheight   =  floor( ($up_height - (($dif / $up_width)) *  $up_height) );
    }
   

    $src_x  = $x;
    $src_y  = $y;
    if(!isset($x) || !isset($y))
    {
        $src_x  = 0;
        $src_y  = 0;
    }    

    $virtual_image = imagecreatetruecolor($newwidth, $newheight);
    imagecopyresampled($virtual_image, $jpegImage, 0, 0, $src_x, $src_y, $newwidth, $newheight, $up_width, $up_height);
    imagejpeg($virtual_image,$largeDir);

    $newheight  = floor($newheight / 2);
    $newwidth   = floor($newwidth  / 2);

    $virtual_image = imagecreatetruecolor($newwidth, $newheight);
    imagecopyresampled($virtual_image, $jpegImage, 0, 0, $src_x, $src_y, $newwidth, $newheight, $up_width, $up_height);
    imagejpeg($virtual_image,$mediumDir);

    $newheight  = floor($newheight / 2);
    $newwidth   = floor($newwidth  / 2);

    $virtual_image = imagecreatetruecolor($newwidth, $newheight);
    imagecopyresampled($virtual_image, $jpegImage, 0, 0, $src_x, $src_y, $newwidth, $newheight, $up_width, $up_height);
    imagejpeg($virtual_image,$smallDir);


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
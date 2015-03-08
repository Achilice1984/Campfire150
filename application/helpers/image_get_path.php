<?php 
    function returnImagePath($userid, $imgObj, $size){
        
        $hashUserid = md5($userid);
        $hashPictureid = md5($imgObj->PictureId);
        $type = '';

        if(isset($imgObj))
        {
            if( $imgObj->Picturetype_PictureTypeId == 1){
                $type = 'profile';
            }
            else if( $imgObj->Picturetype_PictureTypeId == 2 ){
                $type = 'background';
            }
            else{
                $type = 'story';
            }
        }
        
        $returnPath = BASE_URL.'static/userdata/images/' . $type . '/' . $hashUserid . "/" . $hashPictureid . '/' . $size . '_' . $type . '.jpg';

        return $returnPath;
    }
?>
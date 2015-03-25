<?php 
    function image_get_path($userid, $imgObj, $size){
        
        $hashUserid     = md5($userid);
        $hashPictureid  = "";
        $type           = '';

        $url = "";

        if(isset($imgObj))
        {
            $hashPictureid = md5($imgObj->PictureId);

            if( $imgObj->Picturetype_PictureTypeId == 1)
            {
                //default pic
                $url = BASE_URL . 'static/images/default-user-image.png';

                $type = 'profile';
            }
            else if( $imgObj->Picturetype_PictureTypeId == 2 )
            {
                $type = 'background';
            }
            else
            {
                //default pic
                $url = BASE_URL . 'static/images/default_story_image.jpg';

                $type = 'story';
            }
        }        

        $staticPath = 'static/userdata/images/' . $type . '/' . $hashUserid . "/" . $hashPictureid . '/' . $size . '.jpg';        

        if(file_exists(ROOT_DIR . $staticPath))
        {
            $url = BASE_URL . $staticPath;
        }

        return $url;
    }
    function image_get_path_basic($userid, $pictureid, $picturetypeid, $size, $noDefault = FALSE){
        
        $hashUserid = md5($userid);
        $hashPictureid = md5($pictureid);
        $type = '';

        $url = "";

        if(isset($picturetypeid))
        {
            if( $picturetypeid == 1)
            {
                //default pic
                $url = BASE_URL . 'static/images/default-user-image.png';

                $type = 'profile';
            }
            else if( $picturetypeid == 2 )
            {
                //default pic
                $url = BASE_URL . 'static/images/default_background_image.jpg';

                $type = 'background';
            }
            else
            {
                //default pic
                $url = BASE_URL . 'static/images/default_story_image.jpg';

                $type = 'story';
            }
        }

        $staticPath = 'static/userdata/images/' . $type . '/' . $hashUserid . "/" . $hashPictureid . '/' . $size . '.jpg';        

        if(file_exists(ROOT_DIR . $staticPath))
        {
            $url = BASE_URL . $staticPath;
        }
        else if($noDefault)
        {
            $url = null;
        }

        return $url;
    }
?>
<?php

    //You have access to the shared/StoryViewModel.php
    
    //You can access everything from this variable:
    //uncomment to view structure in browser
    //debugit($storyViewModel);

    //$privacyDropdownValues
    //$storyQuestions

    //debugit($storyQuestions);
?>


<div class="container" style="padding-bottom: 50px; padding-top: 50px;">

    <div class="row">
        <div class="col-md-12">            
        
            <form action="<?php echo BASE_URL; ?>story/add" method="post" enctype="multipart/form-data">

                <?php 
                    //Add error message block to the page
                    include(APP_DIR . 'views/shared/displayErrors.php'); 

                    //Add success message block to the page
                    include(APP_DIR . 'views/shared/displaySuccess.php'); 
                ?>           
                
                
                <input type="hidden" name="image_x" id="image_x" value="">
                <input type="hidden" name="image_y" id="image_y" value="">
                <input type="hidden" name="image_height" id="image_height" value="">
                <input type="hidden" name="image_width" id="image_width" value="">
                <div id="addImageDiv" class="img-rounded center-block" style="position: relative; min-height:400px; border: 1px solid gray; overflow: hidden; padding: 0; margin: 0;">
                    
                    <img id="imgPreviewer" src="" class="img-rounded img-responsive center-block" alt="" style="width:1200px; z-index: 10;" />


                      <div class="form-group" style="position: absolute; z-index: 50; bottom:0; float: left;">   

                          <div class="fileUpload btn btn-default" style="float: left;">                     

                                <span><?php echo gettext("Add A Photo"); ?></span>
                                <input style="width:100%;" type="file" id="Images" name="Images" class="upload" placeholder="<?php echo gettext("Add an Image"); ?>" value="<?php //echo $storyViewModel->Image; ?>">
                          </div>
                      </div>

                      <div id="cropImage" class="btn btn-default" style="position: absolute; z-index: 50; bottom:0; float: left; margin: 25px; margin-left: 150px; display: none;"><?php echo gettext("Crop"); ?></div>
                </div>

                <div class="form-group" style="margin-top: 15px; margin-bottom: -10px;">
                    <!-- <label for="StoryTitle"><?php echo gettext("Title"); ?></label> -->
                    <input type="text" class="form-control" id="StoryTitle" name="StoryTitle" placeholder="<?php echo gettext("Title"); ?>" value="<?php echo $storyViewModel->StoryTitle; ?>">
                </div>            

                   
                <div id="mceFixedNav"></div>
                <div class="form-group">
                    <!-- <label for="Content"><?php echo gettext("Content"); ?></label> -->

                    <input type="hidden" id="tinymce_customCSS" value="<?php echo BASE_URL. "static/css/tinymce_customCSS.css"; ?>">
                    <textarea class="form-control tinyMCE" id="Content" name="Content"><?php echo $storyViewModel->Content; ?></textarea>
                </div>   
                <br />

                 <div class="form-group">
                   <!--  <label for="Tags[]"><?php echo gettext("Story Tags"); ?></label> -->

                    <select id="Tags" class="form-control multiSelectTag" name="Tags[]" multiple placeholder="Tag Your Story!">
                        <option value=""></option>
                        <?php 
                            if(is_array($storyViewModel->Tags) && count($storyViewModel->Tags) > 0)
                            {
                                foreach ($storyViewModel->Tags as $tag) {
                                    echo "<option value='$tag->id' selected=selected>"; 
                                        echo $tag->text;
                                    echo "</option>";
                                } 
                            }
                        ?>
                    </select>
                </div> 
                <br />    

                <div class="form-group">
                    <label for="StoryPrivacyType_StoryPrivacyTypeId"><?php echo gettext("Story Privacy"); ?></label>
                    <select class="form-control" name="StoryPrivacyType_StoryPrivacyTypeId" style="height:45px; font-size: 1.5em;">
                        <?php 
                            foreach ($privacyDropdownValues as $dropdownValue) {
                                echo "<option " . ($storyViewModel->StoryPrivacyType_StoryPrivacyTypeId == $dropdownValue->Value ? 'selected=selected' : "") . " value='" . $dropdownValue->Value . "'>"; 
                                    echo $dropdownValue->Name;
                                echo "</option>";
                            } 
                        ?>
                    </select>
                </div>                          
                    
                <br />
                <button type="submit" name="publish" class="btn btn-default"><?php echo gettext("Publish"); ?></button>
                <button type="submit" name="draft" class="btn btn-default"><?php echo gettext("Save Draft"); ?></button>
            </form>
        </div>
    </div>
</div>
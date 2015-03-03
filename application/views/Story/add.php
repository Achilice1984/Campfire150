<?php

    //You have access to the shared/StoryViewModel.php
    
    //You can access everything from this variable:
    //uncomment to view structure in browser
    //debugit($storyViewModel);

    //$privacyDropdownValues
    //$storyQuestions

    //debugit($storyQuestions);
?>

<div class="container" style="margin-top:100px;">
    <div class="row">

    	<h1>Add Story</h1>

        <div class="panel panel-default">
            <div class="panel-heading" style="font-size:1.4em; background-color:#3498db; color:white;">
                <?php echo gettext("Add Story"); ?>
            </div>
                <div class="panel-body">
                    <div class="col-md-6"> 

                        <form action="<?php echo BASE_URL; ?>story/add" method="post" enctype="multipart/form-data">

                            <?php 
                                //Add error message block to the page
                                include(APP_DIR . 'views/shared/displayErrors.php'); 

                                //Add success message block to the page
                                include(APP_DIR . 'views/shared/displaySuccess.php'); 
                            ?>

                            <?php foreach ($storyQuestions as $question): 

                                $multiple = "";
                                $className = "";

                                if($question->Value == 1 || $question->Value == 2)
                                {
                                    $multiple = "multiple";
                                    $className = "multiSelect5";
                                }                                
                            ?>

                                <div class="form-group">
                                    <label for="QuestionAnswers[]"><?php echo $question->Name; ?></label>
                                    <select class="form-control <?php echo $className; ?>" name="QuestionAnswers[<?php echo $question->Value; ?>][]" <?php echo $multiple; ?> >
                                        <?php 
                                            echo "<option value=''></option>";
                                            
                                            for ($i=0; $i < count($question->Answers); $i++) { 
                                                echo "<option " . ((isset($_POST["QuestionAnswers"][$question->Value]) && in_array($question->Answers[$i]->Value, $_POST["QuestionAnswers"][$question->Value])) ? 'selected=selected' : "") . " value='" . $question->Answers[$i]->Value . "'>"; 
                                                    echo $question->Answers[$i]->Name;
                                                echo "</option>";
                                            }
                                        ?>
                                    </select>
                                </div>
                                
                            <?php endforeach ?>

                            <div class="form-group">
                                <label for="StoryTitle"><?php echo gettext("Title"); ?></label>
                                <input type="text" class="form-control" id="StoryTitle" name="StoryTitle" placeholder="<?php echo gettext("Enter Title"); ?>" value="<?php echo $storyViewModel->StoryTitle; ?>">
                            </div>
                            <div class="form-group">
                                <label for="StoryPrivacyType_StoryPrivacyTypeId"><?php echo gettext("Story Privacy"); ?></label>
                                <select class="form-control" name="StoryPrivacyType_StoryPrivacyTypeId">
                                    <?php 
                                        foreach ($privacyDropdownValues as $dropdownValue) {
                                            echo "<option " . ($storyViewModel->StoryPrivacyType_StoryPrivacyTypeId == $dropdownValue->Value ? 'selected=selected' : "") . " value='" . $dropdownValue->Value . "'>"; 
                                                echo $dropdownValue->Name;
                                            echo "</option>";
                                        } 
                                    ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="Tags[]"><?php echo gettext("Story Tags"); ?></label>
                                <select class="form-control multiSelectTag" name="Tags[]" multiple>
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

                            <div class="form-group">
                                <label for="Images"><?php echo gettext("Story Image"); ?></label>
                                <input type="file" id="Images" name="Images" placeholder="<?php echo gettext("Add an Image"); ?>" value="<?php //echo $storyViewModel->Image; ?>">
                            </div>
							
							<div class="form-group">
                                <label for="Content"><?php echo gettext("Content"); ?></label>
                                <textarea class="form-control tinyMCE" id="Content" name="Content"><?php echo $storyViewModel->Content; ?></textarea>
                            </div>                              

                            <button type="submit" class="btn btn-default"><?php echo gettext("Submit"); ?></button>
                        </form>

                    </div>
            </div>
        </div>
    </div>
</div>
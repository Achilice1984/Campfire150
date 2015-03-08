

<div class="container" style="margin-bottom: 50px;">

    <div class="row">
        <div class="col-md-12"> 

            <h2><?php echo gettext("You almost done!"); ?></h2>           
        
            <form action="<?php echo BASE_URL . "story/publish/" . $storyViewModel->StoryId; ?>" method="post" enctype="multipart/form-data">

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

                <button type="submit" name="publish" class="btn btn-default"><?php echo gettext("Publish"); ?></button>
            </form>
        </div>
    </div>  
</div>
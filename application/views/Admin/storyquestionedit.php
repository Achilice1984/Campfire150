
<?php
	// debugit($storyQuestionViewModel);
	// debugit($userViewModel);
	// debugit($aprovalViewModel);
?>
<div class="container" style="margin-top:20px; margin-left: 20px; margin-right: 20px;">

	<h2>Edit a Story Question or Answer</h2>

	<form action="<?php echo BASE_URL . "admin/storyquestionedit/" . $storyQuestionViewModel->QuestionId; ?>" method="post" id="loginForm">

    <div class="row">
		
		<div class="col-md-3" style="margin:60px;">
			<h3>Edit the Question</h3>			

				<input type="hidden" name="QuestionId" value="<?php echo $storyQuestionViewModel->QuestionId; ?>">

	            <?php include(APP_DIR . 'views/shared/messages.php'); ?>

	            <div class="form-group">
	                <label for="Content"><?php echo gettext("English Version"); ?></label>
	                <textarea class="form-control" style="height:100px;" id="NameE" name="NameE"><?php echo $storyQuestionViewModel->NameE; ?></textarea>

	            </div>
	            <div class="form-group">
	                <label for="Content"><?php echo gettext("French Version"); ?></label>
	                <textarea class="form-control" style="height:100px;" id="NameE" name="NameF"><?php echo $storyQuestionViewModel->NameF; ?></textarea>

	            </div>	            
	            <button type="submit" class="btn btn-default"><?php echo gettext("Update Question"); ?></button>	

	            <h3>Add a new answer for this question <a href ="<?php echo BASE_URL . 'admin/storyansweradd/' . $storyQuestionViewModel->QuestionId; ?>">HERE</a></h3>       

        </div>
        <div class="col-md-6" style="margin:60px;">
        	<h3>Answers for the Question</h3>

        	<br/>
			
	            <?php include(APP_DIR . 'views/shared/messages.php'); ?>

	            <table style="width:100%">
                        <tr>
                            <th>Answer English Version</th>
                            <th>Answer French Version</th>
                            <th>Update</th>
<?php
	foreach ($storyAnswerViewModelList as $storyAnswerViewModel) 
	{
		echo "<tr><td>" . $storyAnswerViewModel->NameE . "</td><td>"

				. $storyAnswerViewModel->NameF . "</td><td>"

				. "<a href ='". BASE_URL . "admin/storyansweredit/" . $storyAnswerViewModel->AnswerId. "'>Update Answer</a>"

				. "</td></tr>";
	}
?>
                           
                        </tr>
                    <tbody>
                    </tbody>
                </table>        

        </div>
    </div>

     </form>
</div>
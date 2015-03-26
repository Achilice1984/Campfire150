
<?php
	 //debugit($storysQuestionViewModel);
	// debugit($userViewModel);
	// debugit($storyAnswerViewModel);
?>
<div class="container" style="margin-top:100px;">

	<h2><?php echo gettext("Add a Story Answer"); ?></h2>

	
    <div class="row">
		
		<div class="col-md-8">
			<form action="<?php echo BASE_URL . "admin/storyansweradd/" . $storyQuestionViewModel->QuestionId; ?>" 
				method="post" id="loginForm">
				
	            <?php include(APP_DIR . 'views/shared/messages.php'); ?>

	            <div class="form-group"style="margin-left:30px;">

	            	<h4><?php echo gettext("Question"); ?></h4>

	            	<table  style="width:100%; margin-top:20px; margin-bottom:30px;">
	            		<tr><th>Question ID</th><th>English Version</th><th>French Version</th></tr>
			            <?php
			            		echo "<tr><td>" . $storyQuestionViewModel->QuestionId 
			            			. "</td><td>" . $storyQuestionViewModel->NameE 
			            			. "</td><td>" . $storyQuestionViewModel->NameF 
			            			. "</td></tr>";
			            ?>
		            </table>
	            </div>

	            <div class="form-group">
	                <label for="Content"><?php echo gettext("English Version"); ?></label>
	                <textarea class="form-control" id="NameE" name="NameE"><?php echo $storyAnswerViewModel->NameE; ?></textarea>

	            </div>
	            <div class="form-group">
	                <label for="Content"><?php echo gettext("French Version"); ?></label>
	                <textarea class="form-control" id="NameE" name="NameF"><?php echo $storyAnswerViewModel->NameF; ?></textarea>

	            </div>	            
	            <button type="submit" class="btn btn-default"><?php echo gettext("Add Answer"); ?></button>
	        </form>

        </div>
    </div>
</div>
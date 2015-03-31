<div class="container" style="margin-top:100px;">

	<h2><?php echo gettext("Edit a Story Answer"); ?></h2>

	
    <div class="row">
		
		<div class="col-md-8">
			<form action="<?php echo BASE_URL . "admin/storyansweredit/" . $storyAnswerViewModel->AnswerId; ?>" 
				method="post" id="loginForm">

				<input type="hidden" name="AnswerId" value="<?php echo $storyAnswerViewModel->AnswerId; ?>">
				
	            <?php include(APP_DIR . 'views/shared/messages.php'); ?>

	            <div class="form-group"style="margin-left:100px;">

	            	<h4><?php echo gettext("Questions for This Answer"); ?></h4>

	            	<table  style="width:100%; margin-top:20px; margin-bottom:30px;">
	            		<tr><th>Question ID</th><th>English Version</th><th>French Version</th></tr>
			            <?php
			            	foreach ($storyQuestionViewModel as $question) {
			            		echo "<tr><td>" . $question->QuestionId . "</td><td>" . $question->NameE . "</td><td>" . $question->NameF . "</td></tr>";
			            	}
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
	            <button type="submit" class="btn btn-default"><?php echo gettext("Update"); ?></button>
	        </form>

        </div>
    </div>
</div>
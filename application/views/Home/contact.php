<div class="container" style="padding-top: 50px; padding-bottom: 50px;">
    <div class="row">

        <div class="panel panel-default">
            <div class="panel-heading" style="font-size:1.4em; background-color:#337ab7; color:white;">
                <?php echo gettext("Contact Campfire 150"); ?>
            </div>
            <div class="panel-body">
                <div class="col-md-6"> 

                    <form action="<?php echo BASE_URL; ?>home/contact" method="post" id="loginForm">

                        <?php include(APP_DIR . 'views/shared/messages.php'); ?>

                        <div class="form-group">
                            <label for="Email"><?php echo gettext("Email address"); ?></label>
                            <input type="Email" class="form-control" id="Email" name="Email" placeholder="<?php echo gettext("Enter Email"); ?>" value="<?php echo $currentUser->Email; ?>">
                        </div>

                        <div class="form-group">
                            <label for="Subject"><?php echo gettext("Subject"); ?></label>
                            <input type="text" class="form-control" id="Subject" name="Subject" placeholder="<?php echo gettext("Enter Subject"); ?>" value="<?php echo isset($_POST["Subject"]) ? $_POST["Subject"] : ""; ?>">
                        </div>

                        <div class="form-group">
                            <textarea style="height: 150px;" class="form-control" name="Message" id="Message"><?php echo isset($_POST["Message"]) ? $_POST["Message"] : ""; ?></textarea>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-2">
                                <button style="margin-bottom: 5px;" type="submit" class="btn btn-default"><?php echo gettext("Send Message"); ?></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
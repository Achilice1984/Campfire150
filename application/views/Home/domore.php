<div id="eventModel" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
        <form id="imgHeaderForm" action="<?php echo BASE_URL; ?>account/tellYourStory" method="post">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><?php echo gettext("Events!"); ?></h4>
            </div>
            <div class="modal-body">

                <div class="form-group">
                    <label style="font-size: 1.2em;" for="PostalCode"><?php echo gettext("Tell us about the fun you had and earn a Firekeeper badge:"); ?></label>

                    <textarea maxlength="300" name="About" id="About" class="form-control" rows="3" placeholder="<?php echo gettext("What happened?!"); ?>"></textarea>
                </div>

            </div>
            <div class="modal-footer">
                <div class="form-group" style="">   
                    <button style="float: left;" class="btn btn-large btn-warning">Tell your story</button>                     
                </div>          
            </div>
        </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->




<section>
    <div class="container">
    	<h1>Do More</h1>
        <p class="lead">Make your vision for Canada a reality.</p>
		<ul>
			<li><a href="#celebrate">Celebrate 150</a></li>
			<li><a href="#hostCampfire">Host a Campfire</a></li>
            <li><a href="#whatsBetter">What's Better Bananna Boat or S'more?</a></li>
			<li><a href="#volunteer">Volunteer</a></li>
	    	 			
		</ul>
	</div>
</section>

<section id="celebrate" class="bg-grey">
    <div class="container">
        <h2>Celebrate 150</h2>
        <p class="lead">Find a party or event</p>
        <p>Canadians across the country and around the world are celebrating the 150th anniversary.</p>
        <div class="form-group">
            <label for="celebratePostalCode">Find a party or event near you:</label>
            <div class="input-group">
              <input type="text" id="celebratePostalCode" class="form-control" placeholder="<?php echo gettext("Enter your Postal Code"); ?>">
              <span class="input-group-btn">
                <button class="btn btn-warning" type="button"><?php echo gettext("Find Event"); ?></button>
              </span>
            </div>
        </div>
        <p>Tell us about the fun you had and earn a Firekeeper badge.</p>
        <p><button class="btn btn-warning btn-lg btn-block" data-toggle="modal" data-target="#eventModel">Tell your story</button></p>
        <h3>Upcoming Events</h3>
        <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <th>Organization</th>
                    <th>Details</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Campfire 150</td>
                    <td>We will be hosting a campfire!</td>
                    <td>March 25th 2015</td>
                </tr>
                <tr>
                    <td>Campfire 150</td>
                    <td>We will be hosting a campfire!</td>
                    <td>March 25th 2015</td>
                </tr>
                 <tr>
                    <td>Campfire 150</td>
                    <td>We will be hosting a campfire!</td>
                    <td>March 25th 2015</td>
                </tr>
                 <tr>
                    <td>Campfire 150</td>
                    <td>We will be hosting a campfire!</td>
                    <td>March 25th 2015</td>
                </tr>
            </tbody>
        </table>
	</div>
</section>

<section id="hostCampfire">
    <div class="container">
        <h2>Host a Campfire</h2>
        <p class="lead">Help us collect 300,000 stories!</p>
        <p>Break out the marshmallows and gather your friends and family to swap stories.  Whether its in your living room, backyard or local park, help us meet our goal of collecting 300,000 stories about Canada’s future.</p>
        <p>Share the story of your Campfire and earn a Firekeeper badge.</p>
        <p><button class="btn btn-warning btn-lg btn-block" data-toggle="modal" data-target="#eventModel">Tell your story</button></p>
        <h3>Stories collected so far</h3>
        <div class="bg-grey text-center jumbotron marginBottom-15">
            <div class="row">
                <div class="col-sm-3 col-xs-6">
                    <p class="h1">##</p>
                    <p><?php echo gettext("Stories"); ?></p>
                </div>
                <div class="col-sm-3 col-xs-6">
                    <p class="h1">##</p>
                    <p><?php echo gettext("Users"); ?></p>
                </div>
                <div class="col-sm-3 col-xs-6">
                    <p class="h1">##</p>
                    <p><?php echo gettext("Comments"); ?></p>
                </div>
                <div class="col-sm-3 col-xs-6">
                    <p class="h1">##</p>
                    <p><?php echo gettext("Recommends"); ?></p>
                </div>
            </div>
        </div>
        <ul>
            <li>Help collect all the stories you share for Campfire150 with our handy-dandy <a href="#" title="<? echo gettext("Opens in a new window"); ?>" target="_blank">mobile app <span class="glyphicon glyphicon-new-window small"></span></a></li>
            <li>Find the perfect <a href="#" title="<? echo gettext("Opens in a new window"); ?>" target="_blank">Parks Canada <span class="glyphicon glyphicon-new-window small"></span></a> campfire pit to gather around</li>
            <li>Learn how to <a href="#" title="<? echo gettext("Opens in a new window"); ?>" target="_blank">Build the perfect Campfire <span class="glyphicon glyphicon-new-window small"></span></a></li>
            <li>Download our guide on <a href="#" title="<? echo gettext("Opens in a new window"); ?>" target="_blank">Hosting the perfect Campfire <span class="glyphicon glyphicon-new-window small"></span></a></li>
            <li>Can’t meet outside?  Check out the <a href="#" title="<? echo gettext("Opens in a new window"); ?>" target="_blank">Virtual Campfire <span class="glyphicon glyphicon-new-window small"></span></a></li>
        </ul>
    </div>
</section>

<section class="bg-grey">
    <div class="container">
        <h2 id="whatsBetter">What's Better Bananna Boat or S'more?</h2>
        <p class="lead">Everyone’s heard of s’mores, but have you ever had a Banana Boat?</p>
        <div class="row">
            <div class="col-md-6">
                <h3>What you need:</h3>
                <ul>
                    <li>One banana per person</li>
                    <li>A small handful of chocolate chips</li>
                    <li>5 mini marshmallows</li>
                    <li>One square of aluminum foil, large enough to wrap around a banana</li>
                    <li>A fire pit filled with beautiful hot coals</li>
                    <li>Tongs</li>
                    <li>1 spoon</li>
                </ul>
            </div>
            <div class="col-md-6">
                <h3>Directions:</h3>
                <ol>
                    <li>Carefully split the banana down the middle without cutting it all the way through the skin on the other side</li>
                    <li>Squish the chocolate chips into the sides of the banana (if you have some left over, eat them!)</li>
                    <li>Put the mini marshmallows between the sides of the banana</li>
                    <li>Wrap the banana in the aluminum foil and place into the hot coals. Let the coals heat the banana until the chocolate chips and marshmallows are melted (about 5-10 minutes)</li>
                    <li>Carefully remove the banana boat with tongs and let the foil cool a bit so you can unwrap your banana boat and scoop out the delicious gooey insides</li>
                </ol>
            </div>
        </div>
        <p class="marginBottom15"><a href="#" class="btn btn-warning btn-lg btn-block">Share a picture of your creation</a></p>
    </div>
</section>

<section id="volunteer">
    <div class="container">
        <h2>Volunteer</h2>
        <p class="lead">Join a legacy project</p>
        <p>Make your vision for Canada a reality by volunteering in your community. Whether its helping organization a 150th celebration, taking action for a cause you care about, or joining a legacy project to commemorate the 150th anniversary with one of our partner organizations, your involvement will help make Canada a better place to call home.</p>
        <h3>Actions taken so far</h3>
        <div class="bg-grey text-center jumbotron marginBottom-15">
            <div class="row">
                <div class="col-sm-3 col-xs-6">
                    <p class="h1">##</p>
                    <p><?php echo gettext("Stories"); ?></p>
                </div>
                <div class="col-sm-3 col-xs-6">
                    <p class="h1">##</p>
                    <p><?php echo gettext("Users"); ?></p>
                </div>
                <div class="col-sm-3 col-xs-6">
                    <p class="h1">##</p>
                    <p><?php echo gettext("Comments"); ?></p>
                </div>
                <div class="col-sm-3 col-xs-6">
                    <p class="h1">##</p>
                    <p><?php echo gettext("Recommends"); ?></p>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="celebratePostalCode">Find a party or event near you:</label>
            <div class="input-group">
              <input type="text" id="volunteerPostalCode" class="form-control" placeholder="<?php echo gettext("Enter your Postal Code"); ?>">
              <span class="input-group-btn">
                <button class="btn btn-warning" type="button"><?php echo gettext("Find Event"); ?></button>
              </span>
            </div>
        </div>
        <p>Share the story of how you are getting involved and earn a Firekeeper badge.</p>
        <p><button class="btn btn-warning btn-lg btn-block" data-toggle="modal" data-target="#eventModel">Tell your story</button></p>
        <h3>Volunteer with Campfire 150 and become a Citizen Researcher/Story Collector</h3>
        <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <th>Organization</th>
                    <th>Details</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Campfire 150</td>
                    <td>We will be hosting a campfire!</td>
                    <td>March 25th 2015</td>
                </tr>
                <tr>
                    <td>Campfire 150</td>
                    <td>We will be hosting a campfire!</td>
                    <td>March 25th 2015</td>
                </tr>
                 <tr>
                    <td>Campfire 150</td>
                    <td>We will be hosting a campfire!</td>
                    <td>March 25th 2015</td>
                </tr>
                 <tr>
                    <td>Campfire 150</td>
                    <td>We will be hosting a campfire!</td>
                    <td>March 25th 2015</td>
                </tr>
            </tbody>
        </table>
    </div>
</section>
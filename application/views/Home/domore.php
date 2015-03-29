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




<section class="marginBottom-15">
    <div class="container" style="padding-top: 40px; padding-bottom: 60px;">
    	<h1 style="display: table; margin: 0 auto; font-size: 5em;">Do More <small>Make your vision for Canada a reality.</small></h1>
		
		<div style="padding: 50px;">
			<h2><a href="#celebrate">Celebrate 150</a> <small>Find a party or event</small></h2>
            <h2><a href="#UpcomingEvents">Upcoming Events</a> <small>Where to have take part!</small></h2>
			<h2><a href="#host_campfire">Host a Campfire</a> <small>Help us collect 300,000 stories!</small></h2>
			<h2><a href="#volunteer">Volunteer</a> <small>Join a legacy project</small></h2>
	    	 			
		</div>
	</div>
</section>

<section class="bg-grey marginBottom-15" style="padding-top: 40px; padding-bottom: 60px;">
    <a name="celebrate"></a>

    <div class="container">
    	<h2 style="font-size: 3em;">Celebrate 150</h2>
    	<p style="font-size: 1.5em;">Canadians across the country and around the world are celebrating the 150th anniversary.</p>
    	<p>
            <div style="padding-top: 40px;" class="row">
                <div class="form-group">
                    <div class="col-md-4">
                        <label style="font-size: 1.5em;" for="PostalCode"><?php echo gettext("Find a party or event near you:"); ?></label>
                        <input type="text" class="form-control" id="PostalCode" name="PostalCode" placeholder="<?php echo gettext("Enter Your PostalCode!"); ?>" value="">
                        <br />
                        <button style="float: left;" class="btn btn-lg btn-warning">Find One Now!</button>
                    </div>
                </div>
            </div>
        </p>

        <h2 style="padding-top: 60px;">Been to an event recently?</h2>
    	<p>
            <div style="" class="row">
                <div class="form-group">
                    <div class="col-md-8">                        
                        
                        <br />
                        <button style="float: left;" class="btn btn-lg btn-warning" data-toggle="modal" data-target="#eventModel">Tell your story</button>
                    </div>
                </div>
            </div>   
        </p>        

	</div>
</section>

<div style="background-color: white; padding:1px;">
    <a name="UpcomingEvents"></a>

    <div style="padding: 80px;" class="container">
        <h2 style="font-size: 3em; padding-bottom: 10px; display:table; margin: 0 auto;">Upcoming Events</h2>
        <table style="background-color: white;" class="table table-hover table-striped">
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
</div>

<section class="bg-blue marginBottom-15" style="padding-top: 40px; padding-bottom: 60px;">
    <a name="host_campfire"></a>

    <div style="padding: 80px;" class="container">
    	<h2 style="font-size: 3em; padding-bottom: 20px;">Host a Campfire</h2>
    	<p style="font-size: 1.5em;">Break out the marshmallows and gather your friends and family to swap stories.  Whether its in your living room, backyard or local park, help us meet our goal of collecting 300,000 stories about Canada’s future.  </p>
    	
        <h2 style="padding-top: 60px;">Been to an event recently?</h2>
        <p>
            <div style="" class="row">
                <div class="form-group">
                    <div class="col-md-8">                        
                        
                        <br />
                        <button style="float: left;" class="btn btn-lg btn-warning" data-toggle="modal" data-target="#eventModel">Tell your story</button>
                    </div>
                </div>
            </div>   
        </p> 

        <div style="padding-top: 80px;"></div>
        <div style="padding: 40px; float: left;">
            <div style="width:200px; height:200px; border-radius:50% !important; font-size:50px; color:#fff; line-height:200px; text-align:center; background:#eea236; margin: 10px; float: left;">1000</div>

            <div style="clear: both; display:table; margin: 0 auto; font-size: 3em;">Stories</div>
        </div>
        <div style="padding: 40px; float: left;">
            <div style="width:200px; height:200px; border-radius:50% !important; font-size:50px; color:#fff; line-height:200px; text-align:center; background:#eea236; margin: 10px; float: left;">850</div>

            <div style="clear: both; display:table; margin: 0 auto; font-size: 3em;">Recommends</div>
        </div>
        <div style="padding: 40px; float: left;">
            <div style="width:200px; height:200px; border-radius:50% !important; font-size:50px; color:#fff; line-height:200px; text-align:center; background:#eea236; margin: 10px; float: left;">200</div>

            <div style="clear: both; display:table; margin: 0 auto; font-size: 3em;">Users</div>
        </div>


        <div style="clear: both;"></div>       

    	<p>
            <span style="font-size: 1.5em;">
                Help collect all the stories you share for Campfire150 with our handy-dandy mobile app <a href="#" style="color:orange; font-weight: bolder;" class="" data-toggle="modal" data-target="#eventModel">here!</a>
            </span>
            <br />
        </p>

        <p>
            <span style="font-size: 1.5em;">
               Find the perfect Parks Canada campfire pit to gather around <a href="#"  style="color:orange; font-weight: bolder;" class="" data-toggle="modal" data-target="#eventModel">here!</a>
            </span>
            <br />
        </p>
        <p>
            <span style="font-size: 1.5em;">
               Learn how to build the perfect Campfire <a href="#"  style="color:orange; font-weight: bolder;" class="" data-toggle="modal" data-target="#eventModel">here!</a>
            </span>
            <br />
        </p>

        <p>
            <span style="font-size: 1.5em;">
               Download our guide on hosting the perfect Campfire <a href="#"  style="color:orange; font-weight: bolder;" class="" data-toggle="modal" data-target="#eventModel">here!</a>
            </span>
            <br />
            
        </p>

        <p style="padding-top: 25px;">
            <span style="font-size: 2em; padding:10px;">
               Can’t meet outside?  Check out this virtual Campfire!
            </span>
            <br />
            <!--  <iframe width="700" height="450"
                src="http://www.youtube.com/embed/xmjvMXO4AGA">
            </iframe>  -->
        </p>
	</div>
</section>

<section class="bg-grey marginBottom-15" style="padding-top: 40px; padding-bottom: 60px;">
    <a name="volunteer"></a>

    <div class="container">
    	<h2 style="font-size: 3em; padding-bottom: 20px;">Volunteer</h2>
    	<p style="font-size: 1.5em;">Make your vision for Canada a reality by volunteering in your community.  Whether its helping organization a 150th celebration, taking action for a cause you care about, or joining a legacy project to commemorate the 150th anniversary with one of our partner organizations, your involvement will help make Canada a better place to call home.<p>

		<div style="padding-top: 80px;"></div>
        <div style="padding: 40px; float: left;">
            <div style="width:200px; height:200px; border-radius:50% !important; font-size:50px; color:#fff; line-height:200px; text-align:center; background:#eea236; margin: 10px; float: left;">1000</div>

            <div style="clear: both; display:table; margin: 0 auto; font-size: 3em;">Stories</div>
        </div>
        <div style="padding: 40px; float: left;">
            <div style="width:200px; height:200px; border-radius:50% !important; font-size:50px; color:#fff; line-height:200px; text-align:center; background:#eea236; margin: 10px; float: left;">850</div>

            <div style="clear: both; display:table; margin: 0 auto; font-size: 3em;">Recommends</div>
        </div>
        <div style="padding: 40px; float: left;">
            <div style="width:200px; height:200px; border-radius:50% !important; font-size:50px; color:#fff; line-height:200px; text-align:center; background:#eea236; margin: 10px; float: left;">200</div>

            <div style="clear: both; display:table; margin: 0 auto; font-size: 3em;">Users</div>
        </div>
        <div style="clear: both;"></div>

		<p>
            <div style="padding-top: 40px;" class="row">
                <div class="form-group">
                    <div class="col-md-4">
                        <label style="font-size: 1.5em;" for="PostalCode"><?php echo gettext("Find a party or event near you:"); ?></label>
                        <input type="text" class="form-control" id="PostalCode" name="PostalCode" placeholder="<?php echo gettext("Enter Your PostalCode!"); ?>" value="">
                        <br />
                        <button style="float: left;" class="btn btn-lg btn-warning">Find One Now!</button>
                    </div>
                </div>
            </div>
        </p>

         <h2 style="padding-top: 60px;">Been to an event recently?</h2>
        <p>
            <div style="" class="row">
                <div class="form-group">
                    <div class="col-md-8">                        
                        
                        <br />
                        <button style="float: left;" class="btn btn-lg btn-warning" data-toggle="modal" data-target="#eventModel">Tell your story</button>
                    </div>
                </div>
            </div>   
        </p> 

		<p style="font-size: 1.5em; padding-top: 25px;">Volunteer with Campfire150 and become a Citizen Researcher/Story Collector</p>
        
        <table style="background-color: white;" class="table table-hover table-striped">
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
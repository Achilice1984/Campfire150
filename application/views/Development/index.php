
<div class="container">
 
	<h1>Development Portal</h1>	

	<div role="tabpanel">

	  <!-- Nav tabs -->
	  <ul class="nav nav-tabs" role="tablist">
	    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Resources</a></li>
	    <li role="presentation"><a href="#newModule" aria-controls="profile" role="tab" data-toggle="tab">New Module</a></li>
	  </ul>

	  <!-- Tab panes -->
	  <div class="tab-content" style="padding:20px;">
	    <div role="tabpanel" class="tab-pane active" id="home">

	    	<div class="panel panel-default">
			  <div class="panel-heading">GitHub</div>
			  <div class="panel-body">
			    We will use GitHub to manage our source code.
			    <br />
			    <a href="https://github.com/">https://github.com/</a>
			  </div>		  
			</div>

			<div class="panel panel-default">
			  <div class="panel-heading">XAMPP</div>
			  <div class="panel-body">
			    We will use XAMPP as our development environment to make sure everyone is using the same thing.
			    <br />
			    <a href="https://www.apachefriends.org/index.html">https://www.apachefriends.org/index.html</a>
			  </div>		  
			</div>

	    	<div class="panel panel-default">
			  <div class="panel-heading">MVC</div>
			  <div class="panel-body">
			    Our project will be built using the MVC design patern.
			    <br />
			    <a href="http://www.sitepoint.com/the-mvc-pattern-and-php-1/">http://www.sitepoint.com/the-mvc-pattern-and-php-1/</a>
			  </div>		  
			</div>

			<div class="panel panel-default">
			  <div class="panel-heading">PIP</div>
			  <div class="panel-body">
			    We will be using an open source mvc framework from GitHub called PIP.
			    <br />
			    <a href="https://gilbitron.github.io/PIP/">https://gilbitron.github.io/PIP/</a>
			  </div>		  
			</div>

			<div class="panel panel-default">
			  <div class="panel-heading">Bootstrap</div>
			  <div class="panel-body">
			    We will be using Bootstrap as our front-end framework.
			    <br />
			    <a href="http://getbootstrap.com/">http://getbootstrap.com/</a>
			  </div>		  
			</div>

			<div class="panel panel-default">
			  <div class="panel-heading">JQuery</div>
			  <div class="panel-body">
			    We will use JQuery to help with advanced javascript functions.
			    <br />
			    <a href="http://jquery.com/">http://jquery.com/</a>
			  </div>		  
			</div>

			<div class="panel panel-default">
			  <div class="panel-heading">Gettext</div>
			  <div class="panel-body">
			    We will use Gettext in order to make the website bilingual.
			    <br />
			    <a href="https://www.gnu.org/software/gettext/">https://www.gnu.org/software/gettext/</a>
			  </div>		  
			</div>

			<div class="panel panel-default">
			  <div class="panel-heading">Poedit</div>
			  <div class="panel-body">
			    We will use Poedit for translation text.
			    <br />
			    <a href="http://poedit.net/">http://poedit.net/</a>
			  </div>		  
			</div>			

			<div class="panel panel-default">
			  <div class="panel-heading">PDO</div>
			  <div class="panel-body">
			    In order to abstract our database we will use PDO for our connections and queries. 
			    <br />
			    <a href="http://code.tutsplus.com/tutorials/why-you-should-be-using-phps-pdo-for-database-access--net-12059">http://code.tutsplus.com/tutorials/why-you-should-be-using-phps-pdo-for-database-access--net-12059</a>
			    <br />
			    <a href="http://wiki.hashphp.org/PDO_Tutorial_for_MySQL_Developers">http://wiki.hashphp.org/PDO_Tutorial_for_MySQL_Developers</a>
			  </div>		  
			</div>

			<div class="panel panel-default">
			  <div class="panel-heading">MyAQL</div>
			  <div class="panel-body">
			    Our database will use MySQL.
			    <br />
			    <a href="http://www.mysql.com/">http://www.mysql.com/</a>
			  </div>		  
			</div>

		</div>
	    <div role="tabpanel" class="tab-pane" id="newModule">
	    	<div class="panel panel-primary">
			  <div class="panel-heading">Description</div>
			  <div class="panel-body">
			  	Use this form to create a new module more quickly. It will scaffold out all the files you need.
			  </div>		  
			</div>
	    	
	    	<div>	    		
					<?php 
						if(isset($_SESSION["NewModuleMessage"]))
						{
							?>
								<div class="alert alert-success" role="alert">
						  		<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
						  			<span class="sr-only">Message:</span>	
							<?php

							echo $_SESSION["NewModuleMessage"] . "</div>";

							$_SESSION["NewModuleMessage"] = null;
						}
					?>
				</div>
	    		<form action="<?php echo BASE_URL; ?>Development/newmodule" method="post">
					<div class="form-group">
					    <label for="exampleInputEmail1">Module Name</label>
					    <input type="text" class="form-control" name="module" placeholder="Example: Users">
					  </div>
					  <div class="form-group">
					    <label for="exampleInputPassword1">Model(s) Name(s)</label>
					    <input type="text" class="form-control" name="models" placeholder="Example: User, Profile">
					  </div>
					  <div class="checkbox">
					    <label>
					      <input type="checkbox" name="crud"> Add CRUD Views? (insert, edit, delete, index)
					    </label>
					  </div>
					  <button type="submit" class="btn btn-default">Submit</button>
				</form>
	    	</div>

	    </div>
	  </div>

	</div>
</div>
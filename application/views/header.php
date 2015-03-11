<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="Content-type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo gettext("Campfire 150"); ?></title>

    <!-- Bootstrap -->
    <link href="<?php echo BASE_URL; ?>/static/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo BASE_URL; ?>/static/plugins/validation/css/formValidation.min.css" rel="stylesheet">
    <link href="<?php echo BASE_URL; ?>/static/plugins/select2/css/select2.min.css" rel="stylesheet">

    <link href="<?php echo BASE_URL; ?>/static/css/style.css" rel="stylesheet">
   
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <?php //Loads css files
        foreach (@$this->css as $css) { ?>
          <link rel="stylesheet" href="<?php echo $css;?>" type="text/css" media="screen">
    <?php } ?>
    
  </head>
  <body>
    <?php
      $language = "Français";
      
      if($_SESSION["languagePreference"] != "en_CA")
      {
          $language = "English";
      }
    ?>
    <div id="c150-head" class="bg-grey">
      <div class="container">
        <div class="row">
          <div class="col-md-4">
            <header role="banner">
              <a href="<?php echo BASE_URL; ?>">
                <img src="<?php echo BASE_URL; ?>/static/c150/c150.png" id="c150-logo" alt="Campfire 150" />
              </a>
            </header>
          </div>
          <div class="col-md-8 nav-container">
            <nav role="navigation" class="nav-secondary clearfix">
              <div class="container">
                <ul class="nav nav-pills nav-justified pull-right">
                  <li><a href="<?php echo BASE_URL; ?>story/search"><span class="glyphicon glyphicon-search"></span><span class="hidden-xs"> <?php echo gettext("Search"); ?></span></a></li>
                  <li><a href="<?php echo BASE_URL; ?>account/changelanguage"><span class="glyphicon glyphicon-globe"></span><span class="hidden-xs"> <?php echo $language; ?></span></a></li>

<<<<<<< HEAD
                <li><a href="<?php echo BASE_URL; ?>story/add"><span class="glyphicon glyphicon-pencil"></span><span class="hidden-xs"> <?php echo gettext("Share a Story"); ?></span></a></li>
                <?php  if(!$currentUser->IsAuth) { ?>
                          <li class="dropdown active">
                            <a href="#" class="dropdown-toggle" type="button" id="loginMenu" data-toggle="dropdown" aria-expanded="true">
                              <span class="glyphicon glyphicon-user"></span><span class="hidden-xs"> <?php echo gettext("Login | Signup"); ?></span> <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu" aria-labelledby="loginMenu">
                              <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo BASE_URL; ?>account/login"><?php echo gettext("Login"); ?></a></li>
                              <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo BASE_URL; ?>account/register"><?php echo gettext("Register"); ?></a></li>
                            </ul>
                          </li>
                <?php } else { ?>
                          <li class="dropdown active">
                            <a href="#" class="dropdown-toggle" type="button" id="loginMenu" data-toggle="dropdown" aria-expanded="true">
                              <span class="glyphicon glyphicon-user"></span><span class="hidden-xs"> <?php echo $currentUser->FirstName . " " . $currentUser->LastName; ?></span> <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu" aria-labelledby="loginMenu">
                              <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo BASE_URL; ?>account/home"><?php echo gettext("Profile"); ?></a></li>
                              <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo BASE_URL; ?>account/logout"><?php echo gettext("Logout") ?></a></li>                              
                            </ul>
                          </li>
                          
                <?php } ?>
                  </ul>
=======
                  <li><a href="<?php echo BASE_URL; ?>story/add"><span class="glyphicon glyphicon-pencil"></span><span class="hidden-xs"> <?php echo gettext("Share a Story"); ?></span></a></li>
                  <?php  if(!$currentUser->IsAuth) { ?>
                            <li class="dropdown active">
                              <a href="#" class="dropdown-toggle" type="button" id="loginMenu" data-toggle="dropdown" aria-expanded="true">
                                <span class="glyphicon glyphicon-user"></span><span class="hidden-xs"> <?php echo gettext("Login | Signup"); ?></span> <span class="caret"></span>
                              </a>
                              <ul class="dropdown-menu" role="menu" aria-labelledby="loginMenu">
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo BASE_URL; ?>account/login"><?php echo gettext("Login"); ?></a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo BASE_URL; ?>account/register"><?php echo gettext("Register"); ?></a></li>
                              </ul>
                            </li>
                  <?php } else { ?>
                            <li class="dropdown active">
                              <a href="#" class="dropdown-toggle" type="button" id="loginMenu" data-toggle="dropdown" aria-expanded="true">
                                <span class="glyphicon glyphicon-user"></span><span class="hidden-xs"> <?php echo $currentUser->FirstName . " " . $currentUser->LastName; ?></span> <span class="caret"></span>
                              </a>
                              <ul class="dropdown-menu" role="menu" aria-labelledby="loginMenu">
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo BASE_URL; ?>account/logout"><?php echo gettext("Logout") ?></a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo BASE_URL; ?>account/home"><?php echo gettext("Profile"); ?></a></li>
                              </ul>
                            </li>
                            
                  <?php } ?>
                </ul>
>>>>>>> origin/master
              </div>
            </nav>
            <p class="h4 hidden-sm hidden-xs text-primary text-right motto"><?php echo gettext("Gathering Canadians through story."); ?></p>
            <nav class="navbar navbar-default nav-primary">
              <div class="navbar-header">
                  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#c150-navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </button>
              </div>
              <div class="collapse navbar-collapse" id="c150-navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="<?php echo BASE_URL; ?>"><?php echo gettext("Home"); ?> <span class="sr-only">(current)</span></a></li>
                    <li><a href="<?php echo BASE_URL; ?>story/search"><?php echo gettext("Stories"); ?></a></li>                    
                    <li><a href="<?php echo BASE_URL; ?>account/search"><?php echo gettext("Users"); ?></a></li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo gettext("Campfire"); ?> <span class="caret"></span></a>
                      <ul class="dropdown-menu" role="menu">
                          <li><a href="<?php echo BASE_URL; ?>home/about"><?php echo gettext("About"); ?></a></li>
                          <li><a href="<?php echo BASE_URL; ?>home/domore"><?php echo gettext("Do More"); ?></a></li>
                          <li class="divider"></li>
                          <li><a href="<?php echo BASE_URL; ?>home/terms"><?php echo gettext("Terms"); ?></a></li>
                      </ul>
                    </li>
                </ul>
              </div>
            </nav>
          </div>
        </div>
      </div> <!-- End #c150-head .container -->
    </div> <!-- End #c150-head -->

    <div id="c150-body">
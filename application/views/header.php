<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="Content-type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Campfire 150</title>

    <!-- Bootstrap -->
    <link href="<?php echo BASE_URL; ?>/static/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo BASE_URL; ?>/static/plugins/validation/css/formValidation.min.css" rel="stylesheet">

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
  <body style="height:100%;">

    <!-- Fixed navbar -->
    <div class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php echo BASE_URL; ?>"><b>Campfire 150</b></a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <?php
              $language = "Français";

              if($_SESSION["languagePreference"] != "en_CA")
              {
                $language = "English";
              }

              if($currentUser->IsAuth)
              {
                echo '<li><a href="' . BASE_URL . 'account/home">' . $currentUser->Email . '</a></li>';

                echo '<li class="dropdown">';
                  echo '<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="glyphicon glyphicon-cog"></span><span class="caret"></span></a>';
                  echo '<ul class="dropdown-menu" role="menu">';
                    echo '<li><a href="' . BASE_URL . 'account/profile"> ' . gettext("Update Profile") . '</a></li>';
                    echo '<li><a href="' . BASE_URL . 'account/logout"> ' . gettext("Logout") . '</a></li>';
                    echo '<li><a href="' . BASE_URL . 'account/changelanguage">' . $language . '</a></li>';
                  echo '</ul>';
                echo '</li>';
              }
              else
              {                
                echo '<li class="dropdown">';
                  echo '<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="glyphicon glyphicon-cog"></span><span class="caret"></span></a>';
                  echo '<ul class="dropdown-menu" role="menu">';
                    echo '<li><a href="' . BASE_URL . 'account/login">' . gettext("Login/Register") . '</a></li>';
                    //echo '<li><a href="' . BASE_URL . 'account/register">' . gettext("Register") . '</a></li>';
                    echo '<li><a href="' . BASE_URL . 'account/changelanguage">' . $language . '</a></li>';
                  echo '</ul>';
                echo '</li>';
              }
            ?>
            
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

    <!-- Added this so that error messages are viewable after fixed navbar -->
    <div style="margin-top:60px;"></div>
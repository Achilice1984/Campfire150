<?php
  $language = "Français";
  $pageLang = "en";
  
  if($_SESSION["languagePreference"] != "en_CA")
  {
      $language = "English";

      $pageLang = "fr";
  }
?>

<!DOCTYPE html>
<html lang="<?php echo $pageLang; ?>">
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
    <div id="c150-head">
      <div style="height: 60px;" class="container">
        <div class="row">
          <div class="col-md-4">
            <header role="banner">
              <a href="<?php echo BASE_URL . "admin/"; ?>">
                <h3 Style="color: grey;">Admin</h3>
              </a>
            </header>
          </div>
          <div class="col-md-8 nav-container">
            <nav role="navigation" class="nav-secondary clearfix">
              <div class="container">
                    <ul style="margin-top: 6px;" class="nav nav-pills nav-justified pull-right">

                      <li><a href="<?php echo BASE_URL; ?>account/changelanguage"><span class="glyphicon glyphicon-globe"></span><span class="hidden-xs"> <?php echo $language; ?></span></a></li>
                      
                       <li class="dropdown">
                          <a href="#" class="dropdown-toggle" type="button" id="loginMenu" data-toggle="dropdown" aria-expanded="true">
                            <span class="glyphicon glyphicon-user"></span><span class="hidden-xs"> <?php echo $currentUser->FirstName . " " . $currentUser->LastName; ?></span> <span class="caret"></span>
                          </a>
                          <ul class="dropdown-menu" role="menu" aria-labelledby="loginMenu">
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo BASE_URL; ?>account/logout"><?php echo gettext("Logout") ?></a></li>                              
                            <li class="divider"></li>
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo BASE_URL; ?>"><?php echo gettext("Main Site") ?></a></li>
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
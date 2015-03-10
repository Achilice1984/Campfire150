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
    <div id="c150-head" class="bg-grey">
      <div class="container">
        <div class="row">
          <div class="col-md-4">
            <header role="banner">
              <img src="<?php echo BASE_URL; ?>/static/c150/c150.png" id="c150-logo" alt="Campfire 150" />
            </header>
          </div>
          <div class="col-md-8 nav-container">
            <nav role="navigation" class="nav-secondary clearfix">
              <div class="container">
                    <ul class="nav nav-pills nav-justified pull-right">
                <li><a href="#"><span class="glyphicon glyphicon-search"></span><span class="hidden-xs"> Search</span></a></li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" type="button" id="languageMenu" data-toggle="dropdown" aria-expanded="true">
                    <span class="glyphicon glyphicon-globe"></span><span class="hidden-xs"> English</span> <span class="caret"></span>
                  </a>
                  <ul class="dropdown-menu" role="menu" aria-labelledby="languageMenu">
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">English</a></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">French</a></li>
                  </ul>
                </li>
                <li><a href="#"><span class="glyphicon glyphicon-pencil"></span><span class="hidden-xs"> Share a Story</span></a></li>
                <li class="dropdown active">
                  <a href="#" class="dropdown-toggle" type="button" id="loginMenu" data-toggle="dropdown" aria-expanded="true">
                    <span class="glyphicon glyphicon-user"></span><span class="hidden-xs"> Login | Signup</span> <span class="caret"></span>
                  </a>
                  <ul class="dropdown-menu" role="menu" aria-labelledby="loginMenu">
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Login</a></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Signup</a></li>
                  </ul>
                </li>
                  </ul>
              </div>
                </nav>
            <p class="h4 hidden-sm hidden-xs text-primary text-right motto">Mission Statement / Marketing Jargon / Catch Phrase</p>
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
                    <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>
                    <li><a href="#">Link</a></li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Dropdown <span class="caret"></span></a>
                      <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Action</a></li>
                          <li><a href="#">Another action</a></li>
                          <li><a href="#">Something else here</a></li>
                          <li class="divider"></li>
                          <li><a href="#">Separated link</a></li>
                          <li class="divider"></li>
                        <li><a href="#">One more separated link</a></li>
                      </ul>
                    </li>
                    <li><a href="#">Link</a></li>
                    <li><a href="#">Link</a></li>
                    <li><a href="#">Link</a></li>
                </ul>
              </div>
            </nav>
          </div>
        </div>
      </div> <!-- End #c150-head .container -->
    </div> <!-- End #c150-head -->

    <div id="c150-body">
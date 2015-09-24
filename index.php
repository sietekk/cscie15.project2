<?php

require 'passgen.php';

define('__apiURL__', 'http://randomword.setgetgo.com/get.php');

$testAPI = function($apiURL) {
    $api = new SimpleHttpGetRequest();
    $api->setURL($apiURL);
    return ($api->get() && ($api->getStatus() === 200));
};

$passGen;
$passWord;
$showApiError;
if ($testAPI(__apiURL__)) {
    $showApiError = false;
    $passGen = new PasswordGenerator($_GET);
    $passGen->setWordApiURL(__apiURL__);
    $passWord = $passGen->generate(); 
} else {
    $showApiError = true;
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Project 2</title>
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="container-fluid container">
      <!-- Navbar Section -->
      <nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
              <span class="sr-only">Toggle navigation...</span>
              <span class="glyphicon glyphicon-chevron-down"></span>
            </button>
            <a class="navbar-brand" href="#">Projects</a>
          </div>
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav nav-pills nav-justified">
              <li role="presentation" class="dropdown">
                  <button class="dropdown-toggle nav-btn-width btn btn-default navbar-btn" role="button" id="project1Menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Project 1
                    <span class="glyphicon glyphicon-chevron-down float-glyph-right"></span>
                  </button>
                  <ul class="dropdown-menu nav-btn-width" aria-labelledby="project1Menu">
                    <li><a href="http://p1.sietekk.com">View Project 1</a></li>
                    <li><a href="https://github.com/sietekk/cscie15.project1">Project 1 Source Code</a><li>
                  </ul>
              </li>
              <li role="presentation" class="dropdown">
                  <button class="dropdown-toggle nav-btn-width btn btn-default navbar-btn" role="button" id="project2Menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Project 2
                    <span class="glyphicon glyphicon-chevron-down float-glyph-right"></span>
                  </button>
                  <ul class="dropdown-menu nav-btn-width" aria-labelledby="project2Menu">
                    <li><a href="http://p2.sietekk.com">View Project 2</a></li>
                    <li><a href="https://github.com/sietekk/cscie15.project2">Project 2 Source Code</a><li>
                  </ul>
              </li>
              <li role="presentation" class="dropdown">
                  <button class="dropdown-toggle nav-btn-width btn btn-default navbar-btn" role="button" id="project3Menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Project 3
                    <span class="glyphicon glyphicon-chevron-down float-glyph-right"></span>
                  </button>
                  <ul class="dropdown-menu nav-btn-width" aria-labelledby="project3Menu">
                    <li><a href="http://p3.sietekk.com">View Project 3</a></li>
                    <li><a href="https://github.com/sietekk/cscie15.project3">Project 3 Source Code</a><li>
                  </ul>
              </li>
              <li role="presentation" class="dropdown">
                  <button class="dropdown-toggle nav-btn-width btn btn-default navbar-btn" role="button" id="project4Menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Project 4
                    <span class="glyphicon glyphicon-chevron-down float-glyph-right"></span>
                  </button>
                  <ul class="dropdown-menu nav-btn-width" aria-labelledby="project4Menu">
                    <li><a href="http://p4.sietekk.com">View Project 4</a></li>
                    <li><a href="https://github.com/sietekk/cscie15.project4">Project 4 Source Code</a><li>
                  </ul>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <!-- Header -->
      <div class="page-header">
        <h1>Project 2 <small>xkcd Style Password Generator</small></h1>
      </div>
      <div id="pass-gen-container">
        <div class="row">
          <div class="col-md-6">
            <!-- Password Generation Form -->
            <div class="panel panel-info panel-padding">
              <div class="panel-heading">
                <h4 class="panel-title">Configure Password</h4>
              </div>
              <div class="panel-body">
                <div class="container">
                  <form id="passGenForm" class="form-horizontal" action="index.php" method="GET" autocomplete="off">
                    <div id="numberOfWordsFormGroup" class="form-group">
                      <label for="inputNumberOfWords" class="col-md-6 control-label">Number of Words</label>
                      <div class="col-md-6">
                        <input type="number" min="1" max="10" class="form-control" name="number_of_words" id="inputNumberOfWords" placeholder="1-10" required>
                      </div>
                    </div>
                    <div class="row">
                      <div id="errorElement" class="col-md-12"></div>
                    </div>
                    <div class="form-group">
                      <label for="inputDelimeterType" class="col-md-6 control-label">Delimeter</label>
                      <div class="col-md-6">
                        <div class="radio">
                          <label>
                            <input type="radio" name="delimeter_choice" value="space" id="inputDelimeterType">
                            Space
                          </label>
                        </div>
                        <div class="radio">
                          <label>
                            <input type="radio" name="delimeter_choice" value="dash" id="inputDelimeterType">
                            Dash
                          </label>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputRandomNumberChoice" class="col-md-6 control-label">Append Random Number</label>
                      <div class="col-md-6">
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" name="random_number" id="inputRandomNumberChoice">
                          </label>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputRandomSpecialCharacterChoice" class="col-md-6 control-label">Append Random Special Character</label>
                      <div class="col-md-6">
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" name="random_special_character" id="inputRandomSpecialCharacterChoice">
                          </label>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-md-12">
                        <button type="submit" class="btn btn-info btn-width" <?php echo ($showApiError ? 'disabled' : null); ?>>Generate</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <!-- Generated Password -->
            <div class="panel <?php echo ($showApiError ? 'panel-danger' : 'panel-info'); ?> panel-padding">
              <div class="panel-heading">
                <h4 class="panel-title">Generated Password</h4>
              </div>
              <div class="panel-body">
                  <?php
                    echo ($showApiError ?
                        '<p class="pw-presentation lead">API is currently broken. Please try again later.</p>':
                        '<p class="pw-presentation lead">'.$passWord.'</p>');
                  ?>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Password Generator Information -->
      <div class="panel panel-info panel-padding">
        <div class="panel-heading">
          <h4 class="panel-title">Background</h4>
        </div>
        <div class="panel-body">
          <p>This xkcd style password generator will create a password, which is much easier to remember and much harder to hack
             than traditional passwords. The number of words, the type of delimeter, adding a random number, and adding a random
             symbol may be specified. Random words are pulled from the
             <a href="http://randomword.setgetgo.com/" target="_blank">Random Word API</a>. The API interface is built on a
             modified server side PHP script based off of Leonid Svyatov's
             <a href="https://github.com/svyatov/CurlWrapper" target="_blank">CurlWrapper script</a>. Please refer to the xkcd
             webcomic below for more information.</p>
          <a href="http://xkcd.com/936/" target="_blank">
            <img class="img-responsive" src="http://imgs.xkcd.com/comics/password_strength.png" alt="xkcd password comic">
          </a>
        </div>
      </div>
    </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- jQuery Validation -->
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.14.0/jquery.validate.min.js"></script>
    <!-- Validation JS Code -->
    <script src="js/validate.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  </body>
</html>

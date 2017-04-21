<?php // Example 26-7: login.php
  require_once 'header.php';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>The Picture Palace</title>

    <!-- Bootstrap core CSS -->
    <link href="./bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="signup.css" rel="stylesheet">

  </head>

  <body>


    <div class="container">

      <form class="form-signin">
        <h2 class="form-signin-heading">Datastructures</h2>
        <h3 class="form-signin-heading">Please sign in or sign up!</h3>
        <a id="signUpBtn" class="btn btn-lg btn-primary btn-block" href="signup.php" role="button">Sign up</a>
      <a id="signInBtn" class="btn btn-lg btn-primary btn-block" href="signin.php" role="button">Sign in</a>
      </form>

    </div> <!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>

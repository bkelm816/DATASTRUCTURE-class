 <!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>The Picture Palace</title>

    <!-- Bootstrap Core CSS -->
    <link href="./bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Go Back!</a>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <div class="container">



<?php // Example 26-7: login.php
  require_once 'header.php';
  echo "<br><br><div class='main'><h3>Feel free to log in!</h3>";
  $error = $userid = $password = "";

  if (isset($_POST['userid']))
  {
    $userid = sanitizeString($_POST['userid']);
    $password = sanitizeString($_POST['password']);

    if ($userid == "" || $password == "")
        $error = "Not all fields were entered<br>";
    else
    {
        $salt1="qm&h*";
        $salt2="pg!@";
        $token= hash('ripemd128',"$salt1$password$salt2");
      $result = queryMySQL("SELECT userid,password FROM DATABASE_USERS
        WHERE userid='$userid' AND password='$token'");

      if ($result->num_rows == 0)
      {
        $error = "<span class='error'>Username/Password
                  invalid</span><br><br>";
      }
      else
      {
        $_SESSION['userid'] = $userid;
        $_SESSION['password'] = $password;
        die("You are now logged in. Please <a href='homepage.php?view=$userid'>" .
            "click here</a> to continue.<br><br>");
      }
    }
  }

  echo <<<_END
    <form method='post' action='signin.php'>$error
    <span class='fieldname'>Username </span><input type='text'
      maxlength='16' name='userid' value='$userid'><br>
    <span class='fieldname'>Password </span><input type='password'
      maxlength='16' name='password' value='$password'>
_END;
?>

    <br>
    <span class='fieldname'>&nbsp;</span>
    <input type='submit' value='Login'>
    </form><br></div>
</div>
  </body>
</html>

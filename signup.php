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
<?php
  require_once 'header.php';
  require_once 'checkuser.php';

echo <<<_END
  <script>
    function checkUser(userid)
    {
      if (userid.value == '')
      {
        $("#info").text('')
        return
      }
      params  = "userid=" + userid.value
      request = new ajaxRequest()
      request.open("POST", "checkuser.php", true)
      request.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
      request.onreadystatechange = function()
      {
        if (this.readyState == 4)
          if (this.status == 200)
            if (this.responseText != null)
              $("#info").text(this.responseText)
      }
      request.send(params)
    }

    function ajaxRequest()
    {
      try { var request = new XMLHttpRequest() }
      catch(e1) {
        try { request = new ActiveXObject("Msxml2.XMLHTTP") }
        catch(e2) {
          try { request = new ActiveXObject("Microsoft.XMLHTTP") }
          catch(e3) {
            request = false
      } } }
      return request
    }
  </script>
_END;

  echo "<br><br>";

  echo "<div class='main'><h3>Please enter a username and password to sign up!</h3>";
  $error = $first = $last = $userid = $password = "";
  if (isset($_SESSION['userid'])) destroySession();

  if (isset($_POST['userid']))
  {
    $userid = sanitizeString($_POST['userid']);
    $password = sanitizeString($_POST['password']);

    if ($userid == "" || $password == "" || $first == "" || $last == "")
      $error = "Not all fields were entered<br><br>";
    else
    {
      $result = queryMysql("SELECT * FROM DATABASE_USERS WHERE userid='$userid'");

      if ($result->num_rows)
        $error = "That username already exists<br><br>";
      else
      {
        $salt1="qm&h*";
        $salt2="pg!@";
        $type = "Checkings";
        $password= hash('ripemd128',"$salt1$password$salt2");
        queryMysql("INSERT INTO DATABASE_USERS (userid, password, first, last) VALUES('$userid', '$password','Brandon', 'KElm')");
        queryMysql("INSERT INTO DATABASE_ACCOUNT (balance, userid, type) VALUES(0,'$userid', '$type')");

        die("<h4>Account created, you now have a checking account at Bank of DS!</h4>Please <a href='signin.php'>" .
            "log in</a><br><br>");
      }
    }
  }

  echo <<<_END
    <form method='post' action='signup.php'>$error
    <span class='fieldname'>Username</span>
    <input type='text' maxlength='16' name='userid' value='$userid'
      onkeyup='checkUser(this)' autocomplete='off'><span id='info'></span><br>
    <span class='fieldname'>Password </span>
    <input type='password' maxlength='16' name='password'
      value='$password' autocomplete='off'><br>

      <span class='fieldname'>First name</span>
      <input type='text'name='firstname' value='$first'><br>

      <span class='fieldname'>Last name</span>
      <input type='text'name='lastname' value='$last'><br>
_END;
?>

    <span class='fieldname'>&nbsp;</span>
    <input type='submit' value='Sign up'>
    </form></div><br>
    </div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="./bootstrap/js/bootstrap.js"></script>
  </body>
</html>

<?php
  require_once 'header.php';

  if (isset($_SESSION['userid']))
  {
    queryMysql("DELETE FROM NETWORK_SECURITY WHERE userid='$user'");
    destroySession();
    echo "<div class='main container'>Your account has been deleted. Please <a href='index.php'>click here</a> if you wish to create another.";
  }
  else
  {
    echo "<div class='main container'>You are not signed in. Please <a href='index.php'>click here</a> to sign in or sign up.";
  }
  $connection->close();
?>
<?php // Example 26-6: checkuser.php
  require_once 'functions.php';

  if (isset($_POST['userid']))
  {
    $userid   = sanitizeString($_POST['userid']);
    $result = queryMysql("SELECT * FROM DATABASE_USERS WHERE userid='$userid'");

    if ($result->num_rows)
      echo  "This username is taken, please try another one!";
    else
      echo   "This username is available, have at it!";
  }
?>

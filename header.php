<?php // Example 26-2: header.php
  session_start();

  echo "<!DOCTYPE html>\n<html><head>";

  require_once 'functions.php';
  require_once 'db_connect.php';

  $userstr = ' (Guest)';

  if (isset($_SESSION['userid']))
  {
    $user     = $_SESSION['userid'];
    $loggedin = TRUE;
    $userstr  = $user;

  }
  else $loggedin = FALSE;


?>

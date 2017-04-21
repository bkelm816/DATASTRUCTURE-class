<?php // Example 26-1: functions.php
$teamURL = dirname($_SERVER['PHP_SELF']) . DIRECTORY_SEPARATOR;
$server_root = dirname($_SERVER['PHP_SELF']);

  $dbhost  = 'localhost';    // Unlikely to require changing
  $dbname  = 'jgaskill2013';   // Modify these...
  $dbuser  = 'jgaskill2013';   // ...variables according
  $dbpass  = 'a2Saa9uerX';   // ...to your installation
  $appname = "File Management"; // ...and preference

  $connection = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
  if ($connection->connect_error) die($connection->connect_error);

  function createTable($name, $query)
  {
    queryMysql("CREATE TABLE IF NOT EXISTS $name($query)");
    echo "Table '$name' created or already exists.<br>";
  }

  function queryMysql($query)
  {
    global $connection;
    $result = $connection->query($query);
    if (!$result) die($connection->error);
    return $result;
  }

  function destroySession()
  {
    $_SESSION=array();

    if (session_id() != "" || isset($_COOKIE[session_name()]))
      setcookie(session_name(), '', time()-2592000, '/');

    session_destroy();
  }

  function sanitizeString($var)
  {
    global $connection;
    $var = strip_tags($var);
    $var = htmlentities($var);
    $var = stripslashes($var);
    return $connection->real_escape_string($var);
  }

  function sanitizeString2($_connection, $str)
{
    $str = strip_tags($str);
    $str = htmlentities($str);
    $str = stripslashes($str);
    return mysqli_real_escape_string($_connection, $str);
}

function SavePostToDB($_connection, $_user, $_title, $_text, $_time, $_file_name, $_filter)
{
	/* Prepared statement, stage 1: prepare query */
	if (!($stmt = $_connection->prepare("INSERT INTO DATABASE_USERS(USER_USERNAME, STATUS_TITLE, STATUS_TEXT, TIME_STAMP, IMAGE_NAME, FILTER) VALUES (?, ?, ?, ?, ?, ?)")))
	{
		echo "Prepare failed: (" . $_connection->errno . ") " . $_connection->error;
	}

	/* Prepared statement, stage 2: bind parameters*/
	if (!$stmt->bind_param('ssssss', $_user, $_title, $_text, $_time, $_file_name, $_filter))
	{
		echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
	}

	/* Prepared statement, stage 3: execute*/
	if (!$stmt->execute())
	{
		echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
	}
}

function getPostcards($_connection)
{
    $query = "SELECT USER_USERNAME, STATUS_TITLE, STATUS_TEXT, TIME_STAMP, IMAGE_NAME, FILTER FROM WALL ORDER BY TIME_STAMP DESC";

    if(!$result = $_connection->query($query))
    {
        die('There was an error running the query [' . $_connection->error . ']');
    }

    $output = '';
  while($row = $result->fetch_assoc())
    {
        $output = $output . '<div class="panel panel-default"><div class="panel-heading">"'
        . str_replace("\'", "'", $row['STATUS_TITLE'])
        . '" posted by ' . str_replace("\'", "'", $row['USER_USERNAME']) . '</div>'
        . '<div class="row"><div class="col-md-5">'
        . '<img class="img-responsive center-block '. $row['FILTER'] . '" src="' . $server_root
        . 'users/' . $row['IMAGE_NAME'] . '" alt="' . $row['IMAGE_NAME'] . '"></div>'
        . '<div class="col-md-7"><br><p>' . str_replace("\'", "'", $row['STATUS_TEXT'])
        . '</div></div></div>' ;
    }
    return $output;
}

?>

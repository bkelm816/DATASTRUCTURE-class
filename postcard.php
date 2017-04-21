<?php
require_once "header.php";

if(isset($_POST['name']) && isset($_POST['title']) && isset($_POST['text']))
{    
    $name = sanitizeString2($connection, $_POST['name']);
    $title = sanitizeString2($connection, $_POST['title']);
    $text = sanitizeString2($connection, $_POST['text']);
    
    $time = $_SERVER['REQUEST_TIME'];
	$file_name = $time . '.jpg';
    
    if (isset($_POST['filter']))
        {
            $filter = $_POST['filter'];
        }
        else
        {
            $filter = "NULL";
        }

    if ($_FILES)
    {
        $tmp_name = $_FILES['upload']['name'];
        $dstFolder = 'users';
        move_uploaded_file($_FILES['upload']['tmp_name'], $dstFolder . DIRECTORY_SEPARATOR . $file_name);
        //echo "Uploaded image '$file_name'<br /><img src='$dstFolder/$file_name'/>";
    }

    SavePostToDB($connection, $name, $title, $text, $time, $file_name, $filter);
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
	
	<title>Image sharing wall</title>
	
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css">

	<!-- Optional theme -->
	<link rel="stylesheet" href="./bootstrap/css/bootstrap-theme.min.css">
    
    <link rel="stylesheet" href="./css/styles.css">
	
	<link href="http://netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
</head>
<body>

    <p>Your image has been posted! Continue to your <a href="wall.php">wall.</a></p>
    
</body>



<?php $connection->close(); ?>
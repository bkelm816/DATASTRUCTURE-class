<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="IE=edge" http-equiv="X-UA-Compatible">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <meta content="" name="description">
    <meta content="" name="author">

    <title>Data Structures</title><!-- Bootstrap Core CSS -->
    <link href="./bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="./bootstrap/css/simple-sidebar.css" rel="stylesheet">
    <script src="bootstrap/js/jquery.js"></script>
    <script src="bootstrap/js/bootstrap.js"></script>
        <link href="./filters.css" rel="stylesheet">

</head>

<body>
    <?php // Example 26-4: index.php
      require_once 'header.php';
      require_once 'db_connect.php';
      if (!$loggedin) die("You must be <a href='signin.php'>" .
                "logged in</a> to view this page")
    ?>

    <div id="wrapper">
        <!-- Sidebar -->


        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li class="sidebar-brand">
                    <a href="homepage.php">Home</a>
                </li>


                <li>
                    <a href="logout.php">logout</a>
                </li>

                <li>
                    <a href="delete.php">delete account</a>
                </li>

                <li>
                    <a href="accounts.php">add account</a>
                </li>
                <li>
                    <a href="create.php">create account</a>
                </li>
                <!--
                <li>
                    <a href="#">About</a>
                </li>
                <li>
                    <a href="#">Services</a>
                </li>
                <li>
                    <a href="#">Contact</a>
                </li> -->
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->
        <!-- Page Content -->


        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- Page Content -->


                        <div class="container well">
                            <div class="row">
                                <div class="col-lg-12 text-center">
                                    <br>


                                    <h1>Welcome to Bank of DS!</h1>

                                    <br> <a href="#menu-toggle" class="btn btn-default" id="menu-toggle">Toggle Menu</a>

                                <!-- /.row -->
                            </div>
                            <!-- /.container -->
                        </div>
                    </div>
                </div>
            </div>

            <!-- /#page-content-wrapper -->

            <div class = "row">

              <?php //echo getPostcards($connection);
              //echo $user;
              $newBal = 7;

              $querys = "SELECT DISTINCT A.id, type, balance, first, last FROM DATABASE_USERS U, DATABASE_ACCOUNT A where U.userid=A.userid AND U.userid='$user'";
              $results = queryMysql($querys);

              //      l$id= $row["id"];
              //      $rows = mysqli_fetch_assoc($result);
              //      echo "Hello " .$rows["first"]. " ".$rows["last"]."<br>";

                //echo "Hello " .$row["first"]. " ".$row["last"]."<br><br>";

                while($rows = mysqli_fetch_assoc($results)) {

                    echo "<div class = 'center-align text-success'>You have $" . $rows["balance"]. " In your " .$rows["type"]. " account. This account ID is " .$rows["id"]. " - Name: " .$user. "<br> </div>";
                  //  $x[5] = $rows["id"];
                }
              //  $sql = "UPDATE DATABASE_ACCOUNT A SET A.balance = A.balance + $newBal WHERE A.id=6";

                //UPDATE values INTO SUM (balance) DATABSE_ACCOUNT
              ?>
              <form action="accounts.php" method="post">

              <?php

                //while ($rows = $results->fetch_assoc()) {?>

              <table border="0" cellspacing="10">
              <tr>
              <td>Name: </td> <td><?php echo $user?></td>
              </tr>
              <tr>
              <td>Please enter the type of account you wish to add: </td>
                <td>
                  <select name = "updateaccount">
                      <option value="Checkings">Checking Account</option>
                      <option value ="Savings">Savings Account</option>
                  </select>
                </td>
              </tr>
              <tr>
              <td>Please enter in deposit amount: </td>
                <td>
                  <input type="text" name="updatebalance" placeholder="Deposit Amount">
                </td>
              </tr>

              <tr>
              <!--<td>Account ID:</td> <td><input type="text" name="updateimg" size="100" value="<?php //echo $rows['id']; ?>"></td>-->
              </tr>
              <tr>
              <td><INPUT TYPE="Submit" VALUE="Add Account" NAME="Submit"></td>
              </tr>
              </table>


            </form name="myform">
              <?php

                if(isset($_POST['Submit'])){//if the submit button is clicked

                $startBal = $_POST['updatebalance'];
                $type = $_POST['updateaccount'];
                $query="INSERT INTO DATABASE_ACCOUNT (balance,userid,type)VALUES ('$startBal','$user','$type')";
                      //$query = "UPDATE Books WHERE BookID = '".$bookid."'";//update the database query
                $updated = queryMysql($query) or die("Cannot update");//update or error

                header('Location: accounts.php');
                }
              ?>






            </div>
        </div>
    </div>
</div>









  </script>
      <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
      <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
         <script>
      $("#menu-toggle").click(function(e) {
          e.preventDefault();
          $("#wrapper").toggleClass("toggled");
      });
      </script>
  </body>
  </html>

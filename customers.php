<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>





<!DOCTYPE html>
<html>
  <head>
    <title></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/selectOption.css">
    
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans&display=swap" rel="stylesheet">
    
    
    
  </head>
  <body>
    <?php include 'menu.php'; ?>
    
   
    <section class="my-5">
      <div class="wrapper container-fluid">
        <h2 class="text-center" >All Customers</h2>
        <div class="w-50 m-auto" >
          <form >
            <div class="table-responsive" >
            <table class="table">
              <thead class="thead-dark">
                <tr>
                  <th>Customer ID</th>
                  <th>Username</th>
                  <th>First Name</th>
                  <th>Last Name</th>
                  <th>Address</th>
                  <th>Payment Due</th>
                  <th>Contact Number</th>
                </tr>
                <?php
                require_once "config.php";
                // Check connection
                if ($link->connect_error) {
                die("Connection failed: " . $link->connect_error);
                }
                $sql = "SELECT username,customerID,address,contactNumber,firstName,lastName,paymentDue FROM customers";
                $result = mysqli_query($link, $sql);
                if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                echo "<tr><td>".
                      $row["customerID"].
                      "</td><td>" . $row["username"].
                      "</td><td>".$row["firstName"].
                      "</td><td>". $row["lastName"].
                      "</td><td>". $row["address"].
                      "</td><td>". $row["paymentDue"].
                        "</td><td>". $row["contactNumber"].
                       "</td></tr>";
                }
              echo "</table>";
              } else { echo "0 results"; }
              mysqli_close($link);
              ?>
            </thead>
          </table>
        </div>
        </form>
      </div>
    </div>
    
  </section>
  ?>
  
  
  
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  
</body>
</html>
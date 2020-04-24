<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>





<?php
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$username = $contactNumber = $address = $firstName= $lastName="";
$username_err = $contactNumber_err = $address_err =$firstName_err = $lastName_err="";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

// Validate username
if(empty(trim($_POST["username"]))){
$username_err = "Please enter a username.";
} else{
// Prepare a select statement
$sql = "SELECT customerID FROM customers WHERE username = ?";

if($stmt = mysqli_prepare($link, $sql)){
// Bind variables to the prepared statement as parameters
mysqli_stmt_bind_param($stmt, "s", $param_username);

// Set parameters
$param_username = trim($_POST["username"]);

// Attempt to execute the prepared statement
if(mysqli_stmt_execute($stmt)){
/* store result */
mysqli_stmt_store_result($stmt);

if(mysqli_stmt_num_rows($stmt) == 1){
$username_err = "This username is already taken.";
} else{
$username = trim($_POST["username"]);
}
} else{
echo "Oops! Something went wrong. Please try again later.";
}
// Close statement
mysqli_stmt_close($stmt);
}
}



if(empty(trim($_POST["address"]))){
$address_err = "Please enter address.";
}
else{
  $address = trim($_POST["address"]);

}
if(empty(trim($_POST["contactNumber"]))){
$contactNumber_err = "Please enter contactNumber.";
}
else{
  $contactNumber = trim($_POST["contactNumber"]);
}


if(empty(trim($_POST["firstName"]))){
$firstName_err = "Please enter first name.";
}
else{
  $firstName = trim($_POST["firstName"]);
}


if(empty(trim($_POST["lastName"]))){
$lastName_err = "Please enter last name.";
}
else{
  $lastName = trim($_POST["lastName"]);
}

$password=$contactNumber;
$paymentDue=0;

// Check input errors before inserting in database
if(empty($username_err) && empty($address_err) && empty($contactNumber_err)  && empty($firstName_err) && empty($lastName_err) ){

// Prepare an insert statement
$sql = "INSERT INTO customers (username, address,contactNumber,paymentDue,password,firstName,lastName ) VALUES (?, ? , ? , ?, ?,?,?)";

if($stmt = mysqli_prepare($link, $sql)){
// Bind variables to the prepared statement as parameters
mysqli_stmt_bind_param($stmt, "sssssss", $param_username, $address,$contactNumber,$paymentDue,$password,$firstName
  ,$lastName);

// Set parameters
$param_username = $username;

$param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash


// Attempt to execute the prepared statement
if(mysqli_stmt_execute($stmt)){
// Redirect to login page
header("location: addedSuccessfully.php");
} else{
echo "Something went wrong. Please try again later.";
}
// Close statement
mysqli_stmt_close($stmt);
}
}




// Close connection
mysqli_close($link);
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
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans&display=swap" rel="stylesheet">
    
  </head>
  <body>
    <?php include 'menu.php'; ?>
    <section class="my-5">
      <div class="wrapper container-fluid">
        <h2 class="text-center" >Add New Customer</h2>
        <p class="text-center" >Please fill this form to add a customer.</p>
        <div class="w-50 m-auto" >
          <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
              <label>Username</label>
              <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
              <span class="help-block"><?php echo $username_err; ?></span>
            </div>



            <div class="form-group <?php echo (!empty($firstName_err)) ? 'has-error' : ''; ?>">
              <label>First Name</label>
              <input type="text" name="firstName" class="form-control" >
              <span class="help-block"><?php echo $firstName_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($lastName_err)) ? 'has-error' : ''; ?>">
              <label>Last Name</label>
              <input type="text" name="lastName" class="form-control" >
              <span class="help-block"><?php echo $lastName_err; ?></span>
            </div>


            <div class="form-group <?php echo (!empty($address_err)) ? 'has-error' : ''; ?>">
              <label>Address</label>
              <input type="text" name="address" class="form-control" >
              <span class="help-block"><?php echo $address_err; ?></span>
            </div>

            <div class="form-group <?php echo (!empty($contactNumber_err)) ? 'has-error' : ''; ?>">
              <label>Contact Number</label>
              <input type="text" name="contactNumber" class="form-control" >
              <span class="help-block"><?php echo $contactNumber_err; ?></span>
            </div>


            
            <div class="form-group">
              <input type="submit" class="btn btn-primary" value="Submit">
              <input type="reset" class="btn btn-default" value="Reset">
            </div>
          </form>
        </div>
      </div>
      
    </section>
 
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>
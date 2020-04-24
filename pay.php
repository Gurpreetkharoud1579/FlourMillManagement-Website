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
$date = $customerID = $amount="";
 $customerID_err =$amount_err=$date_err= "";


if($_SERVER["REQUEST_METHOD"] == "POST"){

//check for customerID
if(empty(trim($_POST["customerID"]))){
$customerID_err = "Please enter a customer ID.";
} else{
// Prepare a select statement
$sql = "SELECT customerID FROM customers WHERE customerID = ?";
if($stmt = mysqli_prepare($link, $sql)){
// Bind variables to the prepared statement as parameters
mysqli_stmt_bind_param($stmt, "s", $param_customerID);
// Set parameters
$param_customerID = trim($_POST["customerID"]);
// Attempt to execute the prepared statement
if(mysqli_stmt_execute($stmt)){
/* store result */
mysqli_stmt_store_result($stmt);
if(mysqli_stmt_num_rows($stmt) == 0){
$customerID_err = "There is no ".$param_customerID ."in record. Please try again";
} else{
$customerID = trim($_POST["customerID"]);
}
} else{
echo "Oops! Something went wrong. Please try again later.";
}
// Close statement
mysqli_stmt_close($stmt);
}
}



if(empty(trim($_POST["payDate"]))){
$date_err = "Please select Date.";
}
else{
$date = date('Y-m-d', strtotime($_POST['payDate']));
}
if(empty(trim($_POST["amount"]))){
$amount_err = "Please enter amount.";
}
else if(!is_numeric( trim($_POST["amount"])  )){
    $amount_err="Amount must be numeric. Enter again";
}
else{
$amount=trim($_POST["amount"]);
}
$payDate=$date;



//get price of atta danna letti and paymentdue
$paymentDue=0;

//get previous payment
  if(empty($customerID_err) ){
$sql = "SELECT paymentDue FROM customers where customerID=?";


if($stmt1 = mysqli_prepare($link, $sql)){
// Bind variables to the prepared statement as parameters
mysqli_stmt_bind_param($stmt1, "s",$param_customerID);
$param_customerID=$customerID;
if(!mysqli_stmt_execute($stmt1)){
// Redirect to login page
echo "Something went wrong in getting paymentDue. Please try again later.";
}
else{
   $result = $stmt1->get_result();
   $row = mysqli_fetch_row($result);
  $paymentDue=$row[0];
}
// Close statement
mysqli_stmt_close($stmt1);
}
}

//payment
if(empty($amount_err))
  $paymentDue=$paymentDue-$amount;



// Check input errors before inserting in database
if(empty($date_err) && empty($customerID_err)  && empty($amount_err)  ){
// Prepare an insert statement


 $sql1 = "UPDATE customers SET paymentDue =(?) WHERE customerID=(?) ";
if($stmt1 = mysqli_prepare($link, $sql1)){
// Bind variables to the prepared statement as parameters
mysqli_stmt_bind_param($stmt1, "ss", $param_paymentDue, $customerID);
$param_paymentDue=$paymentDue;
if(!mysqli_stmt_execute($stmt1)){
// Redirect to login page
echo "Something went wrong in update paymentDue. Please try again later.";
}
// Close statement
mysqli_stmt_close($stmt1);
}


$sql = "INSERT INTO pay (customerID,payDate,amount ) VALUES (?, ? , ? )";
if($stmt = mysqli_prepare($link, $sql)){
// Bind variables to the prepared statement as parameters
mysqli_stmt_bind_param($stmt, "sss", $param_customerID, $payDate,$amount);
// Set parameters
$param_customerID = $customerID;





// Attempt to execute the prepared statement
if(mysqli_stmt_execute($stmt)){
// Redirect to login page
header("location: paymentSuccessfully.php");
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
    <link rel="stylesheet" type="text/css" href="css/selectOption.css">
    
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans&display=swap" rel="stylesheet">
    
    
    
  </head>
  <body>
    <?php include 'menu.php'; ?>
    
    <section class="my-5">
      <div class="wrapper container-fluid">
        <h2 class="text-center" >Payment</h2>
        <p class="text-center" >Please fill this form for payment.</p>
        <div class="w-50 m-auto" >
          <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            
            <div class="form-group <?php echo (!empty($customerID_err)) ? 'has-error' : ''; ?>">
             <label>Customer ID</label>
              <input type="text" name="customerID" class="form-control" value="<?php echo $customerID; ?>">
              <span class="help-block"><?php echo $customerID_err; ?></span>
            </div> 

            <div class="form-group <?php echo (!empty($date_err)) ? 'has-error' : ''; ?>">
              <label >Date</label>
              <input type="date" name="payDate" max="3000-12-31"
              min="1000-01-01" class="form-control "value="<?php echo $payDate; ?>">
              <span class="help-block"><?php echo $date_err; ?></span>
            </div>
            
            <div class="form-group <?php echo (!empty($amount_err)) ? 'has-error' : ''; ?>">
             <label>Amount</label>
              <input type="text" name="amount" class="form-control" value="<?php echo $amount; ?>">
              <span class="help-block"><?php echo $amount_err; ?></span>
            </div> 
            
            
            <div class="form-group">
              <input type="submit" class="btn btn-primary" value="Submit">
              <input type="reset" class="btn btn-default" value="Reset">
            </div>
          </form>
        </div>
      </div> 
    </section>
    
    
    
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    
  </body>
</html>








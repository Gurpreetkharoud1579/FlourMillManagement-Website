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
 $date = $customerID =$type= $weight="";
 $date_err = $customerID_err =$weight_err= "";

// Processing form data when form is submitted
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
$username_err = "There is no".$param_customerID ."in record. Please try again";
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



if(empty(trim($_POST["entryDate"]))){
$date_err = "Please select entryDate.";
}
else{
$date = date('Y-m-d', strtotime($_POST['entryDate']));
}
if(empty(trim($_POST["weight"]))){
$weight_err = "Please enter weight.";
}
else if(!is_numeric( trim($_POST["weight"])  )){
    $weight_err="Weight must be numeric. Enter again";
}
else{
$weight=trim($_POST["weight"]);
}
$entryDate=$date;
$type=$_POST["type"];


//get price of atta danna letti and paymentdue
$paymentDue=$AttaPrice=$DannaPrice=$LettiPrice=0;
$sql = "SELECT Atta, Danna , Letti FROM price ";

$result = mysqli_query($link, $sql);
if(!$result)
   echo 'Could not run query: ' . mysql_error();

   $row =mysqli_fetch_row($result) ;
   $AttaPrice=$row[0];
   $DannaPrice=$row[1];
   $LettiPrice=$row[2];
  $result -> free_result();
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
if($type=="Atta")
  $paymentDue=$paymentDue+$weight*$AttaPrice;
elseif ($type="Danna") {
   $paymentDue=$paymentDue+$weight*$DannaPrice;
 }
else
   $paymentDue=$paymentDue+$weight*$LettiPrice;
  # code...


// Check input errors before inserting in database
if( empty($date_err) && empty($customerID_err)  && empty($weight_err)  ){
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


$sql = "INSERT INTO entry (customerID,entryDate,type,weight ) VALUES (?, ? , ? , ?)";
if($stmt = mysqli_prepare($link, $sql)){
// Bind variables to the prepared statement as parameters
mysqli_stmt_bind_param($stmt, "ssss", $param_customerID, $entryDate,$type,$weight);
// Set parameters
$param_customerID = $customerID;





// Attempt to execute the prepared statement
if(mysqli_stmt_execute($stmt)){
// Redirect to login page
header("location: entryAddedSuccessfully.php");
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
        <h2 class="text-center" >New Entry</h2>
        <p class="text-center" >Please fill this form for new entry.</p>
        <div class="w-50 m-auto" >
          <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            
            <div class="form-group <?php echo (!empty($customerID_err)) ? 'has-error' : ''; ?>">
             <label>Customer ID</label>
              <input type="text" name="customerID" class="form-control" value="<?php echo $customerID; ?>">
              <span class="help-block"><?php echo $customerID_err; ?></span>
            </div> 

            <div class="form-group <?php echo (!empty($date_err)) ? 'has-error' : ''; ?>">
              <label >Date</label>
              <input type="date" name="entryDate" max="3000-12-31"
              min="1000-01-01" class="form-control "value="<?php echo $entryDate; ?>">
              <span class="help-block"><?php echo $date_err; ?></span>
            </div>
            <div class="form-group" >
              <label >Type</label>
              <select name="type" class="form-control">
        
                <option>Atta</option>
                <option>Danna</option>
                <option>Letti</option>
                
              </select>
            </div>
            
            
            <div class="form-group <?php echo (!empty($weight_err)) ? 'has-error' : ''; ?>">
             <label>Weight</label>
              <input type="text" name="weight" class="form-control" value="<?php echo $weight; ?>">
              <span class="help-block"><?php echo $weight_err; ?></span>
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








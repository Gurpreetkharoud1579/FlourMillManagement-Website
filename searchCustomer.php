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
$username = $customerID ="";
$username_err  = $customerID_err = "";
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
// Validate username

//check for customerID
if(empty(trim($_POST["customerID"]))){
$customerID_err = "Please enter a customer ID.";
}
elseif (! is_numeric(trim($_POST["customerID"]) )) {
  $customerID_err = "Please enter a numeric customer ID.";
   # code...
 } 
else{

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
$username_err = "There is no ".$param_customerID ."in record. Please try again";
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


// Close connection
//mysqli_close($link);
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
        <h2 class="text-center" >Search Customer</h2>
        <p class="text-center" >Please fill this form to see the details of customer.</p>
        <div class="w-50 m-auto" >
          <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($customerID_err)) ? 'has-error' : ''; ?>">
              <label>Customer ID</label>
              <input type="text" name="customerID" class="form-control" value="<?php echo $customerID; ?>">
              <span class="help-block"><?php echo $customerID_err; ?></span>
            </div>
            <div class="form-group">
              <input type="submit" class="btn btn-primary" value="Submit" name="filter">
            </div>
            
          </form>
        </div>
      </div>
      <?php  ?>
    </section>



    <!-- customer details-->
    <section class="my-5">
      <div class="wrapper container-fluid">
        <h2 class="text-center" >Customer Details</h2>
        <div class="w-50 m-auto" >
          
          <!-- customer detail-->
          
          <div class="table-responsive" >
            <table class="table">
              <thead class="thead-dark">
                <tr>
                  <th>Username</th>
                  <th>First Name</th>
                  <th>Last Name</th>
                  <th>Address</th>
                  <th>Payment Due</th>
                  <th>Contact Number</th>
                </tr>
                <?php
                $emp_query = "SELECT username,address,contactNumber,firstName,lastName,paymentDue FROM customers where ";
                // Date filter
                if(isset($_POST['filter'])){

                if ( empty($customerID_err) && !empty(trim($_POST["customerID"])) ) {
                   $emp_query .= "customerID =
                '".$customerID."' ";

                  # code...
                }
                
                
                $entryRecord = mysqli_query($link,$emp_query);
                // Check records found or not
                if($entryRecord->num_rows > 0){
                while($entry = mysqli_fetch_assoc($entryRecord)){
                $username = $entry['username'];
                $firstName = $entry['firstName'];
                $lastName = $entry['lastName'];
                $address = $entry['address'];
                $paymentDue = $entry['paymentDue'];
                $contactNumber = $entry['contactNumber'];

                echo "<tr>";
                  echo "<td>". $username ."</td>";
                  echo "<td>". $firstName ."</td>";
                  echo "<td>". $lastName ."</td>";
                  echo "<td>". $address ."</td>";
                  echo "<td>". $paymentDue ."</td>";
                  echo "<td>". $contactNumber ."</td>";

                echo "</tr>";
                }
                }else{
                echo "<tr>";
                  echo "<td colspan='6'>No record found.</td>";
                echo "</tr>";
                }

              }
              else{
                  echo "<tr>";
                  echo "<td colspan='6'>Entre Customer ID to get result.</td>";
                echo "</tr>";

                }
                ?>
              </thead>
            </table>
            
          </div>
        </div>
      </div>
      
    </section>




 <!-- payment detail-->
<section class="my-5">
      <div class="wrapper container-fluid">
        <h2 class="text-center" >Payment details</h2>
        <div class="w-50 m-auto" >
          
         
          
          <div class="table-responsive" >
            <table class="table">
              <thead class="thead-dark">
                <tr>
                  <th>Payment Date</th>
                  <th>amount</th>
                </tr>
                <?php
                $emp_query = "SELECT payDate,amount FROM pay where ";
                // Date filter
                if(isset($_POST['filter'])){

                if ( empty($customerID_err) && !empty(trim($_POST["customerID"])) ) {
                   $emp_query .= "customerID =
                '".$customerID."' ";

                  # code...
                }
                
                
                $entryRecord = mysqli_query($link,$emp_query);
                // Check records found or not
                if($entryRecord->num_rows > 0){
                while($entry = mysqli_fetch_assoc($entryRecord)){
                $payDate = $entry['payDate'];
                $amount = $entry['amount'];
               

                echo "<tr>";
                  echo "<td>". $payDate ."</td>";
                  echo "<td>". $amount ."</td>";
                echo "</tr>";
                }
                }else{
                echo "<tr>";
                  echo "<td colspan='6'>No record found.</td>";
                echo "</tr>";
                }

              }
              else{
                  echo "<tr>";
                  echo "<td colspan='6'>Entre Customer ID to get result.</td>";
                echo "</tr>";

                }
                ?>
              </thead>
            </table>
            
          </div>
        </div>
      </div>
      
    </section>









     
    <section class="my-5">
      <div class="wrapper container-fluid">
        <h2 class="text-center" >All Entries</h2>
        <div class="w-50 m-auto" >
          
          <!-- Entry List -->
          
          <div class="table-responsive" >
            <table class="table">
              <thead class="thead-dark">
                <tr>
                  <th>Entry Number</th>
                  <th>Type</th>
                  <th>Weight</th>
                  <th>Date of entry</th>
                </tr>
                <?php
                $emp_query = "SELECT * FROM entry where ";
                // Date filter
                if(isset($_POST['filter'])){
                $entryDate = $_POST['entryDate'];

                if ( empty($customerID_err) && !empty(trim($_POST["customerID"])) ) {
                   $emp_query .= "customerID =
                '".$customerID."' ";

                  # code...
                }
                
                
                $entryRecord = mysqli_query($link,$emp_query);
                // Check records found or not
                if($entryRecord->num_rows > 0){
                while($entry = mysqli_fetch_assoc($entryRecord)){
                $entryID = $entry['entryID'];
                $entryDate = $entry['entryDate'];
                $weight = $entry['weight'];
                $type = $entry['type'];
                echo "<tr>";
                  echo "<td>". $entryID ."</td>";
                  echo "<td>". $type ."</td>";
                  echo "<td>". $weight ."</td>";
                  echo "<td>". $entryDate ."</td>";
                echo "</tr>";
                }
                }else{
                echo "<tr>";
                  echo "<td colspan='4'>No record found.</td>";
                echo "</tr>";
                }

              }
              else{
                  echo "<tr>";
                  echo "<td colspan='4'>Entre Customer ID to get result.</td>";
                echo "</tr>";

                }
                ?>
              </thead>
            </table>
            
          </div>
        </div>
      </div>
      
    </section>
   
  
  
  
  
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  
</body>
</html>








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
$customerID ="";
 $customerID_err ="";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
// Validate username



//check for customerID
if(empty(trim($_POST["customerID"]))){
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


// Close connection
mysqli_close($link);
}
?>
<?php
include "config.php";
?>
<!doctype html>
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
  <body >

    <!-- navbar -->
    <?php include "menu.php"; ?>
    <!-- Script -->
    <script src='jquery-3.3.1.js' type='text/javascript'></script>
    <script src='jquery-ui.min.js' type='text/javascript'></script>
    
    <section class="my-5">
      <div class="wrapper container-fluid">
        <h2 class="text-center" >All Entries</h2>
        <div class="w-50 m-auto" >
          
          
          <!-- Search filter -->
          <form method='post' action='' class="justify-content-center">

            <div class="justify-content-center">
            <div class="form-group <?php echo (!empty($customerID_err)) ? 'has-error' : ''; ?>">
             <label>Customer ID</label>
              <input type="text" name="customerID" class="form-control" style=" width: 190px; " value="<?php echo $customerID; ?>">
              <span class="help-block"><?php echo $customerID_err; ?></span>
            </div>
            <div class="form-group ">
              <label >Date</label>
              <input type="date" name="entryDate" max="3000-12-31"
              min="1000-01-01" class="form-control " style=" width: 190px; " value="<?php echo $entryDate; ?>">
            </div>
            <div class="form-group">
              <input type="submit" class="btn btn-primary" value="Filter" name="filter">
              
            </div>
            </div>
          </form>
          <!-- Entry List -->
          
          <div class="table-responsive" >
            <table class="table">
              <thead class="thead-dark">
                <tr>
                  <th>Entry Number</th>
                  <th>Customer ID</th>
                  <th>Type</th>
                  <th>Weight</th>
                  <th>Date of entry</th>
                </tr>
                <?php
                $emp_query = "SELECT * FROM entry where 1";
                // Date filter
                if(isset($_POST['filter'])){
                $entryDate = $_POST['entryDate'];
                
                if(!empty($entryDate)){
                $emp_query .= " and entryDate=
                '".$entryDate."' ";
                }
                if ( empty($customerID_err) && !empty(trim($_POST["customerID"])) ) {
                   $emp_query .= " and customerID =
                '".$customerID."' ";

                  # code...
                }
                }
                // Sort
                //$emp_query .= " ORDER BY date_of_join DESC";
                $entryRecord = mysqli_query($link,$emp_query);
                // Check records found or not
                if($entryRecord->num_rows > 0){
                while($entry = mysqli_fetch_assoc($entryRecord)){
                $customerID = $entry['customerID'];
                $entryID = $entry['entryID'];
                $entryDate = $entry['entryDate'];
                $weight = $entry['weight'];
                $type = $entry['type'];
                echo "<tr>";
                  echo "<td>". $entryID ."</td>";
                  echo "<td>". $customerID ."</td>";
                  
                  echo "<td>". $type ."</td>";
                  echo "<td>". $weight ."</td>";
                  echo "<td>". $entryDate ."</td>";
                echo "</tr>";
                }
                }else{
                echo "<tr>";
                  echo "<td colspan='5'>No record found.</td>";
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
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
  <link href="https://fonts.googleapis.com/css?family=Josefin+Sans&display=swap" rel="stylesheet">

  
</head>
<body>
<?php include 'menu.php'; ?>



<div class="jumbotron jumbotron-fluid ">
  <h1 style="text-align:center;">Best flour at Best price !</h1>
  <h1 style="text-align:center;">Do visit SFM</h1>
  
  
</div>

<section class="my-5">
  <div class="py-5">
    <h1 class="text-center"> About Us</h1>
  </div>  



  <div class="container-fluid">
      <div class ="row">
        <div class="col-lg-6 col-md-6 col-12 ">
        <img src="images/about1.jpg" class="img-fluid aboutimage">
      
        </div>


        <div class="col-lg-6 col-md-6 col-md-12 ">
          <h2 class="display-5">SFM</h2>
           <p style="font-size:130% " class="py-3">Sidhuwal Flour Mill is located in sidhuwal,bhadson road,Patiala.We crush wheat and provide flour. We also sell flour i.e. wheat will be ours. SFM is running since 1970.</p>
           <p  style="font-size:100% " class="py-0"> Contact number : +919855643544 <br> Mail : sidhuwalflourmill@flourmills.com</p>
      
           <br/>

           <a href="about.php" class="btn btn-primary"> More about us</a>
      
        </div>
    


      </div>
  </div>

</section>
<footer class="bg-dark text-center text-white">Powered by Mill Pvt Ltd</footer>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>

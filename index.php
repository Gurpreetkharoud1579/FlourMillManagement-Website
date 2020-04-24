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
  <link rel="stylesheet" type="text/css" href="css/carousel.css">
  <link href="https://fonts.googleapis.com/css?family=Josefin+Sans&display=swap" rel="stylesheet">
  
  
</head>
<body>

<?php include 'menu.php'; ?>


	
<div id="demo" class="carousel slide" data-ride="carousel">
  <ul class="carousel-indicators">
    <li data-target="#demo" data-slide-to="0" class="active"></li>
    <li data-target="#demo" data-slide-to="1"></li>
    <li data-target="#demo" data-slide-to="2"></li>
  </ul>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="images/image2.jpg" alt="hulk" width="1100" height="500">
      <div class="carousel-caption">
        <h3>Whear Flour</h3>
        <p>SFM</p>
      </div>   
    </div>
    <div class="carousel-item">
      <img src="images/image1.jpg" alt="Power" width="1100" height="500">
      <div class="carousel-caption">
        <h3>Whear Flour</h3>
        <p>SFM</p>
      </div>   
    </div>
    <div class="carousel-item">
      <img src="images/image3.jpg" alt="deadlift" width="1100" height="500">
      <div class="carousel-caption">
         <h3>Whear Flour</h3>
        <p>SFM</p>
      </div>   
    </div>
  </div>
  <a class="carousel-control-prev" href="#demo" data-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </a>
  <a class="carousel-control-next" href="#demo" data-slide="next">
    <span class="carousel-control-next-icon"></span>
  </a>
</div>



  



<section class="my-4">
    <div class="py-4">
        <h1 class="text-center"> Welcome to Sidhuwal Flour Mill</h1>
    <div class="btn container-fluid"> 


  <a href="gallery.php" class="btn  btn-secondary " style="width: 200px;"role="button">Gallery</a> 
  <a href="addNewCustomer.php" class="btn  btn-success " style="width: 200px;"role="button">Add Customer</a> 
  <a href="newEntry.php" class="btn  btn-info " style="width: 200px;"role="button">New Entry</a> 
   <a href="searchCustomer.php" class="btn  btn-warning " style="width: 200px;"role="button">Search</a> 
  <a href="pay.php" class="btn   btn-danger " style="width: 200px;"role="button">Pay</a> 
   <a href="customers.php" class="btn   btn-dark " style="width: 200px;"role="button">Show Customers</a> 
  <a href="entries.php" class="btn   btn-info " style="width: 200px;"role="button">Show Entries</a> 


</div>  
    

</section>



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

	
	
  <<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

</body>
</html>
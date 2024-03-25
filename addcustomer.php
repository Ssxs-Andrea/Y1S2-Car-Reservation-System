<?php
session_start();
  //establish the connection to the database
  include ("connect.php");

  //if any form is submit
  if($_SERVER['REQUEST_METHOD']=="POST")
  {
    //save the input details into variables
    $name=$_POST['name'];
    $phoneno=$_POST['phoneno'];
    $email=$_POST['email'];
    $address=$_POST['address'];
    $postcode=$_POST['postcode'];
    $city=$_POST['city'];
    $state=$_POST['state'];

    //make the unique customer id
    $name_firstpart = strtoupper(substr($name,0,1));
    $id_firstpart = ord(substr($name, 0, 4));
    $random_num = mt_rand(100, 999);
    $id = "CUS" . $id_firstpart . ($name_firstpart) . $random_num ;

    //insert the customer details into the database
    if(!empty($name) && !empty($phoneno) && !empty($email) && !empty($address) && !empty($postcode) && !empty($city) && !empty($state)){
        $query="INSERT INTO customer_details (Customer_ID,Name,Phone_Number,Email_Address,Home_Address,Postcode,City,State)
        VALUES('$id','$name','$phoneno','$email','$address','$postcode','$city','$state');";
      }
  }
?>

<!-- html codes to display the content of the page -->
<!DOCTYPE html>
<html>
  <head>
    <title>Carental Company</title>
    <link rel = "icon" href = "carimage/icon.png" type = "image/x-icon">
    <!-- links to the css files -->
    <link rel="stylesheet" href="menubar.css">
    <link rel="stylesheet" href="addcustomer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>

  <body>
  <div id="page-container">
<div id="content-wrap">
  <!-- logo -->
  <div class="colour">
  <div class="logo">
  <img src="carimage/logo4.png" alt="logo" />
  </div>
  <!-- make the menu bar sticky -->
  <div id="navbar">
  <div id="main">
      <!--checkbox to open and close the side menu-->
      <input type="checkbox" id="checkmenubar">
      <label for="checkmenubar">
      <i  id="openmenu" class="fa fa-bars" style="font-size:35px;" ></i>
      <i id="closemenu" class="fa fa-bars" style="font-size:35px;"></i>
      </label>
  <!--sidebar link to each section-->
  <div class="menubar">
      <h1 class="menu_heading">Hello, <?php echo $_SESSION['Name']; ?></h1>
      <a class="menu_wording hover" href="Main page.php"><span>Dashboard</span></a>
      <a class="menu_wording active sub" href="addcustomer.php"><span>Add Customer</span></a>
    <!-- dropdown menu -->
    <div class="dropdown">
      <a class="menu_wording hover" href="#">Reservation  <i class="fas fa-angle-down"></i></a>
      <div class="dropdown-content">
        <a class="wording sub" href="newreservation.php">New Reservation</a>
        <a class="wording sub" href="updatereservation.php">Update Reservation</a>
        <a class="wording sub" href="cancelreservation.php">Cancel Reservation</a>
    </div>
  </div>
  <div class="dropdown">
    <a class="menu_wording hover" href="#">Details<i class="fas fa-angle-down"></i></a>
    <div class="dropdown-content">
    <a class="wording sub" href="checkcustomer.php">Customer Details</a>
    <a class="wording sub" href="checkreservation.php">Reservation Details</a>
    </div>
  </div>
  <a class="menu_wording logout" href="logout.php"><span>Log out</span></a> 
  </div> 
  </div>
  <!-- menu bar as active class -->
</div>
</div>





<!-- 
<div class="alignpage"> -->
  <br><br> 
  <h1 class="title1" style="text-align:center;">Customer Reservation Page</h1>
  <br> 

 


<?php
  //if the form is submit
  if(isset($_POST['submit'])) {
    $conn->query($query);
    //display the message and id
    echo'<div class="outputmsg">';
    echo'<br>';
    echo"Thanks for registering! Please take note of your Customer ID:<br>";
    echo'<br>';
    echo "<h2><b>$id</b></h2>";
    echo'<br>';
    echo'<br>';
    echo'</div>';
    echo'<br><br>';
    //link to add another customer or just start a new reservation
    echo'<a class="outputlink" href="addcustomer.php">Add Another Customer Details</a>';
    echo'<br>';
    echo'<a class="outputlink" href="newreservation.php">Start A New Reservation</a>';
    echo'</div>';
  
  }
  //ask the user to enter customer details
  else{
    echo'<br>';
    echo'<p class=instruction >Please enter your customer details as follows:</p>';
    echo'<br>';
    echo'<form action="" method="post">';
    echo'<div class="border">';
    echo'<table style="width:100%">';
    echo'<tr>';
    echo'<td class="label"><label class="question">Name: </label></td>';
    echo'<td><input class="answer" type="text" name="name" required autocomplete="off"></td>';
    echo'</tr>';
    echo'<tr>';
    echo'<td class="label"><label class="question">Phone Number: </label></td>';
    echo'<td><input class="answer" type="tel"name="phoneno" pattern="[0-9]{}" required autocomplete="off"></td>';
    echo'</tr>';
    echo'<tr>';
    echo'<td><label class="question">Email Address: </label></td>';
    echo'<td><input class="answer" type="email" name="email" required autocomplete="off"></td>';
    echo'</tr>';
    echo'<tr>';
    echo'<td><label class="question">Address: </label></td>';
    echo'<td><input class="answer" type="text" name="address" required autocomplete="off"></td>';
    echo'</tr>';
    echo'<tr>';
    echo'<td><label class="question">Post Code: </label></td>';
    echo'<td><input class="answer" type="text" name="postcode" required autocomplete="off" pattern="[0-9]{5}"></td>';
    echo'</tr>';        
    echo'<tr>';
    echo'<td><label class="question">City: </label></td>';
    echo'<td><input class="answer" type="text" name="city" required autocomplete="off"></td>';
    echo'</tr>';
    echo'<tr>';
    echo'<td><label class="question">State: </label></td>';
    echo'<td><select class="answer" class="input-fields" name="state" required>';
    echo'<option disabled selected hidden>-SELECT ONE-</option>';
    echo'<option>Johor</option>	';
    echo'<option>Kedah</option>';
    echo'<option>Kelantan</option>';
    echo'<option>Kuala Lumpur</option>';
    echo'<option>Labuan</option>';
    echo'<option>Melaka</option>';
    echo'<option>Negeri Sembilan</option>';
    echo'<option>Pahang</option>';
    echo'<option>Penang</option>';
    echo'<option>Perak</option>';
    echo'<option>Perlis</option>';
    echo'<option>Putrajaya</option>';
    echo'<option>Sabah</option>';
    echo'<option>Sarawak</option>';
    echo'<option>Selangor</option>';
    echo'<option>Terengganu</option>';
    echo'</select></td>';
    echo'</tr>';
    echo'<tr>';
    echo'</tr>';
    echo'<tr>';
    echo'<td></td>';
    echo'</tr>';
    echo'<td style="text-align:right"><button type="reset" class="reset">Reset</button></td>';
    echo'<td style="text-align:left"><button type="submit" name="submit" class="confirm">Confirm</button></td>';
    echo'</tr>';
    echo'</table>';
    echo'</div>';
    echo'</form><br><br><br><br>';
           
  }
  echo'</div>';
  
  echo'<footer id="add_cus">';
     echo' <div class="footer-content">';
        
         echo' <ul class="socials">';
             echo' <li><a href="https://www.facebook.com/" target="_blank"><i class="fa fa-facebook"></i></a></li>';
             echo' <li><a href="https://www.instagram.com/" target="_blank"><i class="fa fa-instagram"></i></a></li>';
             echo'<li ><a href="https://www.google.com/maps/dir/2.9432848,101.877767/university+of+nottingham/@2.9434193,101.8734151,
              17z/data=!3m1!4b1!4m9!4m8!1m1!4e1!1m5!1m1!1s0x31cdce0fd89c5829:0xca94557719d2191!2m2!1d101.8734406!2d2.9437504"  target="_blank"><i class="fa fa-map" ></i></a></li>';
              echo' <li><a href="https://www.youtube.com/" target="_blank"><i class="fa fa-youtube"></i></a></li>';
              echo' <li><a href="https://mail.google.com" target="_blank"><i class="fa fa-envelope"></i></a></li>';
              echo' </ul>';
              echo' </div>';
  
      echo'</footer> ';
      echo'</div>';
?>


</body> 
  
</html>
<?php

session_start();
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Carental Company</title>
    <link rel = "icon" href = "carimage/icon.png" type = "image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1">    <!-- to make the website looks good on all devices -->
 <!-- CSS FOR MENU AND RESERVATION DETAILS PAGE -->
    <link rel="stylesheet" href="menubar.css">
    <link rel="stylesheet" href="check.css">
    <!-- icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<div id="page-container">
<div id="content-wrap">
<!-- LOGO -->
<div class="colour">
<div class="logo">
  <img src="carimage/logo4.png" alt="logo" />
</div>

<!-- MAKE THE MENU BAR STICKY -->
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
    <h1 class="menu_heading">HELLO, <?php echo $_SESSION['Name']; ?></h1>
    <a class="menu_wording hover" href="Main page.php"><span>Dashboard</span></a>
    <a class="menu_wording sub" href="addcustomer.php"><span>Add Customer</span></a>
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
    <a class="menu_wording hover" href="#">Details  <i class="fas fa-angle-down"></i></a>
    <div class="dropdown-content">
    <a class="wording sub" href="checkcustomer.php">Customer Details</a>
    <a class="wording active sub" href="checkreservation.php">Reservation Details</a>
    </div>
  </div>
  <a class="menu_wording logout" href="logout.php"><span>Log out</span></a> 
  </div> 
    <!-- <a class="active" href="javascript:void(0)">
      <span style="font-size:25px;cursor:pointer" onclick="openNav()">&#9776; </span>
    </a> -->
  </div>
  <!-- MENU BAR AS ACTIVE CLASS -->
</div>
</div>
  <br>

<!-- SEARCH BAR -->

  <?php 
  
  if (isset($_GET['check']) )//If the user access reservation details page from customer details page, customer id will be auto-filled
  {
    $ID = $_GET['check'];
    // echo' <form action="" method="POST">';
    echo'<p style="font-size:20px;text-align:center"> ----Press Enter key to search----</p>';

    echo '<input type="text"name="search" value='.$ID.' id="myInput" onkeyup="mySearch()" autofocus placeholder="Search...." title="Type in Customer Id" style="float:left; margin:none;"readonly>';
    echo'<br>';

   echo' <button type="submit" class="button" style="float:inline-end;"><a href="checkreservation.php" style="color:white; text-decoration:none;">Show All Records</a></button>';
    //echo'</form>';
  }
  else //If the user deos not access reservation details page from customer details page but from menu bar, no customer id will be auto-filled and will ask the user to key in anything to search
  {
    echo' <input type="text" id="myInput" onkeyup="mySearch()" placeholder="Search...." title="Type in Reservation Id" >';
  }

// connect to database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "COMP1044_database";
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }

    $query = "SELECT Reservation_ID, Staff_ID, Customer_ID, Rental_Start_Date , Rental_End_Date, Number_of_Days, Total_Fee, Car_ID FROM reservation_details ";
    $result = mysqli_query($conn, $query);

    ?>


<!-- Table that will display reservation details created -->
<table id="myTable">

  <tr class="header">
  <th style="width:5%;">No</th> 
  <th style="width:15%;">Reservation ID</th> 
  <th style="width:10%;">Staff ID</th> 
  <th style="width:10%;">Customer ID</th> 
  <th style="width:10%;">Rental Start Date</th> 
  <th style="width:10%;">Rental End Date</th> 
  <th style="width:10%;">Total Fee</th>
  <th style="width:10%;">Car Model</th>
  <th style="width:20%;"> </th>
  </tr>

<!-- If data exists, fetch the data to $data -->
  <?php
if (mysqli_num_rows($result) > 0) { //open if 
    $sn=1;
  while($data = $result->fetch_assoc()) { //open while
 ?>
 
<!-- Display all the customer details from database -->
  <tr>
    <td><?php echo $sn; ?> </td>
    <td><?php echo $data['Reservation_ID']; ?></td>
    <td><?php echo $data['Staff_ID']; ?></td>
    <td><?php echo $data['Customer_ID']; ?></td>
    <td><?php echo $data['Rental_Start_Date']; ?></td>
    <td><?php echo $data['Rental_End_Date']; ?></td>
    <td><?php echo $data['Total_Fee']; ?></td>
    <td><?php echo $data['Car_ID']; ?></td>
    <td> 

    <!-UPDATE AND DELETE BUTTON-  -->
    <form action="" method="Get">
    <button class="button" type="submit" value="<?php  ?>"><a href="updatereservation.php? upd=<?php echo $data['Reservation_ID']; ?>" style="color:white; text-decoration:none;">Update</a></button>
    <button class="button" type="submit" value="<?php  ?>"><a href="cancelreservation.php? del=<?php echo $data['Reservation_ID']; ?>"style="color:white;text-decoration:none;">Cancel</a></button>

</form>
  </td>
  </tr>
  
<!-- Increase the no if data exist, else dispaly 'no data found' -->
<?php
  $sn++;}//close while
}//close if
else { 
  ?>
    <tr>
     <td colspan="8">No data found</td>
    </tr>
    <?php } ?>
    </table> 

  


    <script src="Scriptscript.js"></script>
</body>
</div>
<br>

<!-- Footer with icons that link to each social media are created -->
<footer>
 
    <div class="footer-content">
      
        <ul class="socials">
            <li><a href="https://www.facebook.com/" target="_blank"><i class="fa fa-facebook"></i></a></li>
            <li><a href="https://www.instagram.com/" target="_blank"><i class="fa fa-instagram"></i></a></li>
            <li ><a href="https://www.google.com/maps/dir/2.9432848,101.877767/university+of+nottingham/@2.9434193,101.8734151,
            17z/data=!3m1!4b1!4m9!4m8!1m1!4e1!1m5!1m1!1s0x31cdce0fd89c5829:0xca94557719d2191!2m2!1d101.8734406!2d2.9437504"  target="_blank"><i class="fa fa-map" ></i></a></li>
            <li><a href="https://www.youtube.com/" target="_blank"><i class="fa fa-youtube"></i></a></li>
            <li><a href="https://mail.google.com" target="_blank"><i class="fa fa-envelope"></i></a></li>
        </ul>
    </div>
    

</footer>
</div>
</html> 
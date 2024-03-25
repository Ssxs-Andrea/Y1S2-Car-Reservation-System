<?php
session_start();
  //establish the connection to the database
  include("connect.php");

  //if the user wants to cancel the reservation
  if($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['yes']))
  {
    //get the reservation id from previous session
    $id=$_SESSION['Reservation_ID'] ;

    //cancel the reservation
    if(!empty($id)){
      $sql="DELETE FROM reservation_details where Reservation_ID='$id'";
      $result=$conn->query($sql);
      $conn->close();
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
    <link rel="stylesheet" href="reservationpart.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>

  <body>
  <div id="page-container">
  <div id="page-container1">
  <div id="content-wrap">
  <!-- logo -->
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
<!-- dropdown menu -->
<a class="menu_wording hover" href="ccheckreservation.php">Reservation Details</a>
<div class="dropdown">
<a class="menu_wording hover" href="#">Reservation  <i class="fas fa-angle-down"></i></a>
<div class="dropdown-content">
  <a class="wording sub" href="cupdatereservation.php">Update Reservation</a>
  <a class="wording active sub" href="ccancelreservation.php">Cancel Reservation</a>
</div>
</div>
<a class="menu_wording hover"href="ccheckcustomer.php">Profile</a>
<a class="menu_wording logout" href="logout.php"><span>Log out</span></a> 
</div>
</div> 
</div>
<!-- MENU BAR AS ACTIVE CLASS -->
</div>
</div>
<br>

<div class="alignpage">
  <br>
  <h2 class="title1">Cancel Reservation Page</h2>
  <br>

<?php
    //if the user press yes to cancel the reservation
    if(isset($_POST['yes']))
    {
      echo'<div class="outputmsg">';echo'<br>';
      echo"You have successfully cancelled the reservation.<br>";
      echo"<br>";
      echo"<br>";
      echo'</div>';
      echo"<br>";
      echo"<br>";
      //link to cancel another reservation
      echo'<a class="outputlink" href="ccancelreservation.php">Cancel Another New Reservation</a>';
    }
    //if the user dont want to cancel the reservation
    elseif(isset($_POST['no']))
    {
      echo'<div class="outputmsg">';echo'<br>';
      echo'You did not delete the reservation.';
      echo"<br>";
      echo"<br>";
      echo'</div>';
      echo"<br>";
      echo"<br>";
      //link to cancel another reservation
      echo'<a class="outputlink" href="ccancelreservation.php">Cancel Another New Reservation</a>';
    }
    else {
      //ask the user to enter the reservation id
      echo'<form action="" method="post">';
      echo'<div>';
      echo'<br><br>';
      echo'<h4 class="instruction">Please enter your Reservation ID to cancel your reservation.</h4>';
      echo'<br>';
      //autofill if the user cancel from the reservation details page
      if (isset($_GET['del']) ){
          $ID = $_GET['del'];
          echo'<input class="answer" type="text" name="Reservation_ID"  value='.$ID.' required autocomplete="off" readonly>';
      }
      else{
      //for the user to input reservation id
      echo'<input class="answer" type="text" name="Reservation_ID"  required autocomplete="off">';
      }
      //button to press confirm
      echo'<br>';
      echo'<button class="confirm" type="submit" name="submit">Confirm</button>';
      echo'</form>';
      
      //if the user press submit then display the reservation details
      if(isset($_POST['submit'])){
        
          $Reservation_ID=$_POST['Reservation_ID'];
          $sql = "SELECT Reservation_ID FROM reservation_details WHERE Reservation_ID = '$Reservation_ID' AND Customer_ID = '$_SESSION[ID]'";
          $result = mysqli_query($conn, $sql);

          
          if (mysqli_num_rows($result) > 0) {
            // the entered Reservation_ID is valid
            $_SESSION['Reservation_ID'] = $Reservation_ID;
            $sql="SELECT * FROM reservation_details WHERE Reservation_ID = '$Reservation_ID'";
            $result = $conn->query($sql);
            $row=$result->fetch_assoc();

            //select the car details of reserved car
            $sql1="SELECT car_details.* 
            FROM car_details 
            INNER JOIN reservation_details 
            ON car_details.Car_ID = reservation_details.Car_ID 
            WHERE reservation_details.Reservation_ID = '$Reservation_ID'";
            $result1 = $conn->query($sql1);
            $row1=$result1->fetch_assoc();

            //select the customer who is reserving the car
            $sql2="SELECT customer_details.* 
            FROM customer_details 
            INNER JOIN reservation_details 
            ON customer_details.Customer_ID = reservation_details.Customer_ID 
            WHERE reservation_details.Reservation_ID = '$Reservation_ID'";
            $result2 = $conn->query($sql2);
            $row2=$result2->fetch_assoc();

            //display the reservation details
            echo"<table class=cardetails>";
            echo'<tr class="row1">';
            echo"<tr>";
            echo"<td><b>You are reserving:</b>";
            echo"<br>";
            echo"Type: ". $row1['Type'];
            echo"<br>";
            echo"Model: " . $row1['Brand'];
            echo"<br>";
            echo"Model: " . $row1['Model'];
            echo"<br>";
            echo"Colour: " . $row1['Colour'];
            echo"<br>";
            echo"Payment Amount Due: " ."RM". $row['Total_Fee'];
            echo"<br><br>";
            echo"Reserving From ". "<b>".$row['Rental_Start_Date'] ."</b>"." To " . "<b>".$row['Rental_End_Date'] ."</b>";
            echo'<br>';echo'<br>';
            echo"</td>";  
            echo"</tr>";  
            echo'<tr class="row2">';
            echo"<br>";
            echo"<td>";
            echo "<img src='".$row1['Car_Image']."' width='500' height='300'>";
            echo"</td>";
            echo"</tr>";
            echo"</table>";
            echo'<form method="post">';
            //ask if the user want to cancel the reservation
            echo'<label class="instruction">Are you sure you want to cancel your reservation?</label>';
            echo'<br>';
            ///button yes and no
            echo'<button class="reset" type="submit" name="yes">YES</button>';
            echo'<button class="confirm" type="submit" name="no">NO</button>';
            echo"<br>";echo"<br>";echo"<br>";echo"<br>";
            echo'</div>';
            echo'</form>';
          }
          else{
            //invalid reservation id and ask the user to enter again
            echo"<script>";
            echo"alert('Error: Invalid Reservation ID!');";
            echo"window.location='ccancelreservation.php';";
            echo"</script>";
          }
      }
    }  
 ?>

</div>

  </body>
  
 
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
</div> </div> </div>
</html>

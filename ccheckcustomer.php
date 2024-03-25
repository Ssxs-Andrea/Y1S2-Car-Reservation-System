<?php
session_start();
include("connect.php");

if(isset($_POST['update'])){
  $phoneno=$_POST['phoneno'];
  $sql="UPDATE customer_details SET Phone_Number = '$phoneno' WHERE Customer_ID = '$_SESSION[ID]'";
  if($conn->query($sql)===TRUE){
    header("Location:ccheckcustomer.php");
  }
}

if(isset($_POST['update1'])){
  $email=$_POST['email'];
  $sql="UPDATE customer_details SET Email_Address = '$email' WHERE Customer_ID = '$_SESSION[ID]'";
  if($conn->query($sql)===TRUE){
    header("Location:ccheckcustomer.php");
  }
}

?>

<!DOCTYPE html>
<html>
  <head>
    <title>Carental Company</title>
    <link rel = "icon" href = "carimage/icon.png" type = "image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- to make the website looks good on all devices -->
    <link rel="stylesheet" href="check.css">
    <link rel="stylesheet" href="reservationpart.css">
    <!-- icon -->
    <link rel="stylesheet" href="menubar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>
<div id="page-container">
<div id="page-container1">
  <div id="content-wrap">
<!-- LOGO -->
<div class="colour">
<div class="logo">
  <!-- <h6>CarRent</h6> -->
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
      <a class="wording sub" href="ccancelreservation.php">Cancel Reservation</a>
    </div>
  </div>
  <a class="menu_wording active hover"href="ccheckcustomer.php">Profile</a>
  <a class="menu_wording logout" href="logout.php"><span>Log out</span></a> 
  </div>
  </div> 
  </div>
  <!-- MENU BAR AS ACTIVE CLASS -->
</div>
</div>

<div class="alignpage">
  <br>

<?php
    $query = "SELECT * FROM customer_details WHERE Customer_ID='$_SESSION[ID]' ";
    $result = mysqli_query($conn, $query);   
?>

<?php
if ($result->num_rows > 0) {
    // output data of each row
    while($data = $result->fetch_assoc()) {
?>
     

<!-- Table that will display customer details created -->
<div class="alignpage">

<h1 class="title1" style="text-align:center;">Customer Profile Page</h1>
  <br> <br>
<div class="profile">
<div class="border">
  <p><b>Customer ID: </b><?php echo $data['Customer_ID']; ?></p> <br>
  <p><b>Name: </b><?php echo $data['Name']; ?></p> <br>
  <p><b>Phone Number: </b><?php echo $data['Phone_Number']; ?></p> <br>
  <p><b>Email Address: </b><?php echo $data['Email_Address']; ?></p> <br>
  <p><b>Home Address: </b><?php echo $data['Home_Address']; ?></p> <br>
  <p><b>Postcode: </b><?php echo $data['Postcode']; ?></p> <br>
  <p><b>City: </b><?php echo $data['City']; ?></p><br>
  <p><b>State: </b><?php echo $data['State']; ?></p><br>
    </div>
    <br><br>
    <!--CHECK RESERVATION BUTTON- -->
    <form action="" method="POST">
      <!-- If the button is clicked, the customer id wil be sent to reservation details page and user will be directed to reservation details page too-->
      <br><br>
      <table class="center">
      <tr>
      <td>
      <label class="question">Update your phone number:</label>
      <br>
      <input class="answer" type="text" name="phoneno" pattern="[0-9]{}"autocomplete="off">
      <br>
      <button class="confirm" type="submit" name="update">Confirm</button>
      </td>
      <!-- <br><br><br> -->
      <td>
      <label class="question" >Update your email:</label>
      <br>
      <input type="email" class="answer" name="email" autocomplete="off">
      <br>
      <button type="submit" class="confirm" name="update1">Confirm</button>
      </td>
      </tr>
    </table>
</form>
 </div>
  </div>

  <?php
     }
    } 
    ?>
</div>
<?php $conn->close();?>


<script src="Scriptscript.js"></script>

</body>


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
</div></div></div>
  
</html>
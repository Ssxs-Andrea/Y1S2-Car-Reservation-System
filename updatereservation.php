<?php
session_start();
  //establish the connection to the database
  include("connect.php");

  //function to calculate the number of days for rental
  function dateDiffInDays($date1, $date2) 
  {
      // Calculating the difference in timestamps
      $diff = strtotime($date2) - strtotime($date1);
  
      // 1 day = 24 hours
      // 24 * 60 * 60 = 86400 seconds
      return abs(round($diff / 86400)+1);
  }

//when the user click avaibility for checking the available dates
if(isset($_POST['check'])){
  //get the car id stored to display the car details
  $CarID =  $_SESSION['CarID'];
  //retrieve the start and end dates of the rental period from the user input
  $start_date = $_POST['Start_date'];
  $end_date = $_POST['End_date'];
  
  //query the reservation_details table to check if the selected date falls within any existing rental periods on the selected car
  $sql = "SELECT * FROM reservation_details WHERE ((Rental_Start_Date <= '$start_date' AND Rental_End_Date >= '$start_date') OR (Rental_Start_Date <= '$end_date' AND Rental_End_Date >= '$end_date')) AND (Car_ID = '$CarID')";
  $result = mysqli_query($conn, $sql);
  $row1=$result->fetch_assoc();

  //select all rental start date and rental end date on the selected car
  $sql1 = "SELECT Rental_Start_Date, Rental_End_Date FROM reservation_details WHERE Car_ID = '$CarID'";
  $result1 = $conn->query($sql1);

    
  //if the car model is null in the database, all date will be available
  $sql2 = "SELECT * FROM reservation_details WHERE Car_ID LIKE '$CarID'";
  $result2 = $conn->query($sql2);
  
    if (mysqli_num_rows($result) == 0) {
    while (($row=$result2->fetch_assoc())==NULL){
  
        echo"<script>";
                  echo"alert('The date can be selected. Please proceed to press confirm.');";
                  echo"</script>";
                  //break out of loop
                  break;
      }
    }
  

  //condition 1 to check if the selected date is booked then alert the user to choose other date
  while ($row=$result1->fetch_assoc()){

  if (mysqli_num_rows($result) > 0) {
    echo"<script>";
    echo"alert('Current car model has been booked from ".$row1['Rental_Start_Date']." to ".$row1['Rental_End_Date'].". Please select a different date.');";
    echo"</script>";
    break;
  } 
  else {
      //condition 2 to check if the selected date is booked then alert the user to choose other date
          if ($start_date < $row['Rental_Start_Date'])
              if ($end_date > $row['Rental_Start_Date']){
              echo"<script>";
              echo"alert('Current car model has been booked from ".$row['Rental_Start_Date']." to ".$row['Rental_End_Date'].". Please select a different date.');";
              echo"</script>";
              //break out of loop
              break;
              }
              else{
                //if none of the condition fulfils then the date can be booked
                echo"<script>";
                echo"alert('The date can be selected. Please proceed to press confirm.');";
                echo"</script>";
                //break out of loop
                break;
              }
              //if none of the condition fulfils then the date can be booked
              echo"<script>";
              echo"alert('The date can be selected. Please proceed to press confirm.');";
              echo"</script>";
              //break out of loop
              break;
          }

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
      <a class="menu_wording sub" href="addcustomer.php"><span>Add Customer</span></a>
    <!-- dropdown menu -->
    <div class="dropdown">
      <a class="menu_wording hover" href="#">Reservation  <i class="fas fa-angle-down"></i></a>
      <div class="dropdown-content">
        <a class="wording sub" href="newreservation.php">New Reservation</a>
        <a class="wording active sub" href="updatereservation.php">Update Reservation</a>
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

<div class="alignpage">
  <br>
  <h2 class="title1">Update Reservation Page</h2>
  <br> 
    
<?php
    //when the user press confirm to make the reservation
    if(isset($_POST['reserve'])){
      //if the user update from the reservation details page then set the id to their id
      if(isset($_GET['upd']) ){
        $ID = $_GET['upd'];
      }
      //if the user press availability to check for availability
      if(isset($_POST['check'])){
        $ID = $_GET['upd'];
      }
      //get the reservation id from previous sesion
      $Reservation_ID = $_SESSION['Reservation_ID'];
      //get the input and set them as variable
      $Start_date=$_POST['Start_date'];
      $End_date=$_POST['End_date'];
      //calculate the number of days for rental
      $Number_Of_Days=dateDiffInDays($Start_date,$End_date);
      //select the previous data in database
      $sql3="SELECT * FROM reservation_details WHERE Reservation_ID = '$Reservation_ID'";
      $result3 = $conn->query($sql3);
      $row3=$result3->fetch_assoc();
      //select the car details based on the reserved car
      $sql1="SELECT car_details.* 
            FROM car_details 
            INNER JOIN reservation_details 
            ON car_details.Car_ID = reservation_details.Car_ID 
            WHERE reservation_details.Reservation_ID = '$Reservation_ID'";
            $result1 = $conn->query($sql1);
            $row1=$result1->fetch_assoc();

      //get the daily rental fee and calculate the total fee
      $rentalfee = $row1['Daily_Rental_Fee'];
      $totalfee = $Number_Of_Days * $rentalfee ;

      //update the new reservation date into the database
      if(!empty($Reservation_ID)){
        $sql="UPDATE reservation_details SET Total_Fee='$totalfee',Rental_Start_date='$Start_date',Rental_End_date='$End_date',Number_Of_Days='$Number_Of_Days' WHERE Reservation_ID='$Reservation_ID'"; 
        if($conn->query($sql)===TRUE){
        }
        else{
        }
      }
      //display the message which the user successfully reserve a car and show the reservaton id
      echo'<div class="outputmsg">';echo'<br>';
      echo"Thanks for registering! Please take note of your Reservation ID:<br>";
      echo "<h2><b>$Reservation_ID</b></h2>";
      echo'<br><br>';
      echo'<p><b>Payment Amount Required: </b></p>';
      echo $row1['Brand'] .' '. $row1['Model'] . '/day: RM' . $row1['Daily_Rental_Fee'] ;
      echo"<br>";
      echo'Number of days: ' . $Number_Of_Days . ' day(s)';
      echo"<br>";
      echo'Total amount: <b>RM' . $totalfee.'</b>';
      echo"<br>";
      echo"License Plate Number: ". "<b>".$row1['License_Plate_Number'] ."</b>";
      echo"<br><br>";
      echo"Reserving From ". "<b>".$Start_date ."</b>"." To " . "<b>".$End_date ."</b>";
      echo'</div>';
      echo"<br>";
      echo"<br>";
      //links to make a new reservation or print the current reservation details
      echo'<a class="outputlink" href="updatereservation.php">Update Another New Reservation</a><br>';
      echo'<button class="outputlink2" onclick="print_current_page()">Click here to print your reservation details</button>';
    }
    else
    {
      echo'<form action="" method="post">';
      echo'<div>';
      echo'<br>';echo'<br>';
      echo'<h4 class="instruction">Please enter your Reservation ID to update or change your reservation.</h4>';
      echo'<br>';
      //autofill if direct from the reservation details page
      if (isset($_GET['upd']) ){
        $ID = $_GET['upd'];
        echo'<input class="answer" type="text" name="Reservation_ID" value='.$ID.' required autocomplete="off" readonly>';
      }
      //let the user to enter the reservation id
      else{
        echo'<input class="answer" type="text" name="Reservation_ID"  required autocomplete="off">';
      }
      //button to press submit
      echo'<br>';
      echo'<button class="confirm" type="submit" name="submit">Confirm</button>';
      echo'</form>';

      //if the user press submit after entering the reservation id, or when the user press avaibility to check for the available dates
      if(isset($_POST['submit']) || (isset($_POST['check']))){
        //if the user press submit get the reservation id and store in variable
        if(isset($_POST['submit'])){
          $Reservation_ID=$_POST['Reservation_ID'];
        }
        //if the user wants to check for available dates the reservation id will be retrieved from previous session
        if(isset($_POST['check'])){
          $Reservation_ID = $_SESSION['Reservation_ID'];
        }
            
        $sql = "SELECT Reservation_ID FROM reservation_details WHERE Reservation_ID = '$Reservation_ID'";
        $result = mysqli_query($conn, $sql);

        // check if query was successful
        if (mysqli_num_rows($result) > 0) {
          // the entered Reservation_ID is valid
          $_SESSION['Reservation_ID'] = $Reservation_ID;
          //select the reservation details of entered reservation id
          $sql="SELECT * FROM reservation_details WHERE Reservation_ID = '$Reservation_ID'";
          $result = $conn->query($sql);
          $row=$result->fetch_assoc();

          //select the car details of the reserved car
          $sql1="SELECT car_details.* 
            FROM car_details 
            INNER JOIN reservation_details 
            ON car_details.Car_ID = reservation_details.Car_ID 
            WHERE reservation_details.Reservation_ID = '$Reservation_ID'";
          $result1 = $conn->query($sql1);
          $row1=$result1->fetch_assoc();

          //select the customer details who is reserving the car
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
          echo"Total Amount: " ."<b>"."RM". $row['Total_Fee']."</b>";
          echo"<br>";
          echo"License Plate Number: ". "<b>".$row1['License_Plate_Number'] ."</b>";
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
          
          //if the user press availablity to check the available dates then autofill back the input
          if(isset($_POST['check'])){
            echo'<label class="instruction">Please update your date: <br><br>Start Date:</label>';
            echo'<input class="answer" type="date" id="Start_date" name="Start_date" value='.$start_date.' required>';
            echo'<label class="instruction" for="End_date">End date:</label>';
            echo'<input class="answer" type="date" id="End_date" name="End_date" value='.$end_date.' required>';
            echo'<br>';echo'<br>';
          }
          //submit will not autofill the details
          if(isset($_POST['submit'])){
            echo'<label class="instruction">Please update your date: <br><br>Start Date:</label>';
            echo'<input class="answer" type="date" id="Start_date" name="Start_date" required autocomplete="off">';
            echo'<label class="instruction">End Date:</label>';
            echo'<input class="answer" type="date" id="End_date" name="End_date" required autocomplete="off">';
            echo'<br><br><br>';
            }
            //all the buttons to check availability, reset or comfirm
            echo'<button class="confirm" type="submit" name="check">Availability</button>';
            echo'<button class="reset" type="reset">Reset</button>';
            echo'<button class="confirm" type="submit" name="reserve">Confirm</button>';  
            echo'<br><br><br></div>';
            echo'</form>';
        } 
        else
        {
        //the entered reservation id is invalid
        //thus alert the user to input again
            echo"<script>";
            echo"alert('Error: Invalid Reservation ID!');";
            echo"window.location='updatereservation.php';";
            echo"</script>";
        }
      }
    }  
?>
  </div>
  </div>
  </body>
  
  <br>
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
 
    </div>
</footer>
</html>

<script>
  // Disable dates that have already passed
  var today = new Date().toISOString().split('T')[0];
  document.getElementById("Start_date").setAttribute("min", today);
  document.getElementById("End_date").setAttribute("min", today);
  // Update the min attribute of the end date input element when the start date changes
  document.getElementById("Start_date").addEventListener("change", function() {
  document.getElementById("End_date").setAttribute("min", this.value);
  });

  //to print the page
  function print_current_page(){
  window.print();
  }
</script>
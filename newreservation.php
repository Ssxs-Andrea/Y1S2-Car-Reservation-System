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
    $sql1 = "SELECT Rental_Start_Date, Rental_End_Date FROM reservation_details WHERE Car_ID = '$CarID' ORDER BY(DATEDIFF(Rental_Start_Date, '$start_date')) LIMIT 1";
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
        <a class="wording active sub" href="newreservation.php">New Reservation</a>
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

<div class="alignpage">
  <br>
  <h2 class="title1">New Reservation Page</h2>
  <br><br><br>  
    
<?php
    //when the user press confirm to make the reservation
    if(isset($_POST['reserve']))
    {
      //store the input as variables
      $start_date = $_POST['Start_date'];
      $end_date = $_POST['End_date'];
      $customer_id = $_POST['customer_Id'];

      //check if the customer id exist in the database
      $sql = "SELECT Customer_ID FROM customer_details WHERE Customer_ID = '$customer_id'";
      $result = mysqli_query($conn, $sql);
     
      if (mysqli_num_rows($result) > 0) {
        //the entered Customer_ID is valid
        //get the car id from previous saved input to select the details
        $CarID = $_SESSION['CarID'];
        $sql1="SELECT * FROM car_details WHERE Car_ID = '$CarID'";
        $result1 = $conn->query($sql1);
        $row1=$result1->fetch_assoc();
        //display the car details
        //format the unique reservation id
        $name = $row1['Colour'];
        $car_firstpart = strtoupper(substr($name,0,1));
        $name2 = strtoupper(substr($CarID,0,2));
        $random_num = mt_rand(1000, 9999);
        $reservation_Id = "REV" . $car_firstpart . $name2 . $random_num ;

        //get the username from login
        $Username=$_SESSION['Username'];

        //get the staff id to stored in reservation details
        $sql2="SELECT Staff_ID FROM `staff_details` WHERE Username='$Username';";
        $result2 = $conn->query($sql2);
        $row2=$result2->fetch_assoc();
        $Staff_ID=$row2["Staff_ID"];
  
        //store all the input details into variables
        $customer_Id=$_POST['customer_Id'];
        $Start_date=$_POST['Start_date'];
        $End_date=$_POST['End_date'];
        //calculate the number of days with function
        $Number_Of_Days=dateDiffInDays($Start_date,$End_date);
        //get the daily rental fee from car details
        $rentalfee = $row1['Daily_Rental_Fee'];
        //calculate the total fee
        $totalfee = $Number_Of_Days * $rentalfee ;
  
        //insert the data into the database
        $sql="INSERT INTO reservation_details (Total_Fee,Staff_ID,Reservation_ID,Car_ID,Customer_ID,Rental_Start_Date,Rental_End_Date,Number_Of_Days)
        VALUES('$totalfee','$Staff_ID','$reservation_Id','$CarID','$customer_Id','$Start_date','$End_date',$Number_Of_Days);";
        $conn->query($sql);
    
        //display the message which the user successfully reserve a car and show the reservaton id
        echo'<div class="outputmsg">';
        echo"Thanks for registering! Please take note of your Reservation ID:<br><br>";
        echo "<h2><b>$reservation_Id</b></h2>";
        echo'<br><br>';
        echo'<p><b>Payment Amount Required: </b></p>';
        echo $row1['Brand'] .' '. $row1['Model'] . '/day: RM' . $row1['Daily_Rental_Fee'] ;
        echo"<br>";
        echo'Number of days: ' . $Number_Of_Days . ' day(s)';
        echo"<br>";
        echo"Total Amount: " ."<b>"."RM". $totalfee."</b>";
        echo"<br>";
        echo"License Plate Number: ". "<b>".$row1['License_Plate_Number'] ."</b>";
        echo"<br><br>";
        echo"Reserving From <b>$Start_date</b> To <b>$End_date</b>";
        echo'</div>';
        echo"<br>";
        echo"<br>";
        //links to make a new reservation or print the current reservation details
        echo'<a class="outputlink" href="newreservation.php">Add Another New Reservation</a><br>';
        echo'<button class="outputlink2" onclick="print_current_page()">Click here to print your reservation details</button>';
      } 
      else {
        //the entered Customer_ID is invalid
        //thus alert the user to input again
          echo"<script>";
          echo"alert('Error: Invalid Customer ID!');";
          echo"window.location='newreservation.php';";
          echo"</script>";
          
      }
    }
    else {
      //enable the user to choose the car model wanted to reserve
      //display all the car models
      echo'<p class=instruction >Please choose your car model:</p>';
      echo'<form action="" method="post">';
      echo'<div>';
        echo'<select class="answer" name="car_model" id="car_model">';
        echo'<option disabled selected hidden value="none">-SELECT ONE-</option>';
          echo'<optgroup label="Luxurious Car">';
              echo'<option class="opt" value="Rolls Royce Phantom">Rolls Royce Phantom</option>';
              echo'<option class="opt"value="Bentley Continental Flying Spur">Bentley Continental Flying Spur</option>';
              echo'<option class="opt"value="Mercedes Benz CLS 350">Mercedes Benz CLS 350</option>';
              echo'<option class="opt"value="Jaguar S Type">Jaguar S Type</option>';
          echo'</optgroup>';
          echo'<optgroup label="Sports Car">';
              echo'<option class="opt"value="Ferrari F430 Scuderia">Ferrari F430 Scuderia</option>';
              echo'<option class="opt"value="Lamborghini Murcielago LP640">Lamborghini Murcielago LP640</option>';
              echo'<option class="opt"value="Porsche Boxster">Porsche Boxster</option>';
              echo'<option class="opt"value="Lexus SC430">Lexus SC430</option>';
          echo'</optgroup>';
          echo'<optgroup label="Classics Car">';
              echo'<option class="opt"value="Jaguar MK 2">Jaguar MK 2</option>';
              echo'<option class="opt"value="Rolls Royce Silver Spirit Limousine">Rolls Royce Silver Spirit Limousine</option>';
              echo'<option class="opt"value="MG TD">MG TD</option>';
          echo'</optgroup>';
      echo'</select>';
      echo'<br>';
      //button to submit the reservation
      echo'<button type="submit" class="confirm" name="submit" id="submit" disabled>Confirm</button>';
      echo'</form>';
         
      //set the car id based on the user selection
      if(isset($_POST['submit'])){
        if($_POST["car_model"]== 'Rolls Royce Phantom'){
            $CarID = 'LC001';
        }
        elseif($_POST["car_model"]== 'Bentley Continental Flying Spur'){
            $CarID = 'LC002';
        }
        elseif($_POST["car_model"]== 'Mercedes Benz CLS 350'){
            $CarID = 'LC003';
        }
        elseif($_POST["car_model"]== 'Jaguar S Type'){
            $CarID = 'LC004';
        }
        elseif($_POST["car_model"]== 'Ferrari F430 Scuderia'){
            $CarID = 'SC001';
        }
        elseif($_POST["car_model"]== 'Lamborghini Murcielago LP640'){
            $CarID = 'SC002';
        }
        elseif($_POST["car_model"]== 'Porsche Boxster'){
            $CarID = 'SC003';
        }
        elseif($_POST["car_model"]== 'Lexus SC430'){
            $CarID = 'SC004';
        }
        elseif($_POST["car_model"]== 'Jaguar MK 2'){
            $CarID = 'CC001';
        }
        elseif($_POST["car_model"]== 'Rolls Royce Silver Spirit Limousine'){
            $CarID = 'CC002';
        }
        elseif($_POST["car_model"]== 'MG TD'){
            $CarID = 'CC003';
        }
        else{
            echo"Please select the car you wish to reserve.";
        }
      //save the car id into session for further use
      $_SESSION['CarID'] = $CarID;
      }

      //if the user press submit after selecting the car, or when the user press avaibility to check for the available dates
      if(isset($_POST['submit']) || (isset($_POST['check']))){
          //if the user wants to check for available dates the input customer id will be saved
          if(isset($_POST['check']))
          {
          $customer_Id = $_POST['customer_Id'];
          }
          //get the car id from previous session and saved the car id into session again for further use
          $CarID =  $_SESSION['CarID'];
          $_SESSION['CarID'] = $CarID;
          //select the car details of the selected car id to display
          $sql="SELECT * FROM car_details WHERE Car_ID = '$CarID'";
          $result = $conn->query($sql);
          $row=$result->fetch_assoc();
          echo"<table class=cardetails>";
          echo'<tr class="row1">';
          echo"<td><b>You are reserving:</b>";
          echo"<br>";
          echo"Type: ". $row['Type'];
          echo"<br>";
          echo"Model: " . $row['Brand'];
          echo"<br>";
          echo"Model: " . $row['Model'];
          echo"<br>";
          echo"Colour: " . $row['Colour'];
          echo"<br>";
          echo"Daily Rental Fee: " ."RM". $row['Daily_Rental_Fee'];
          echo'<br>';
          echo'<br>';echo'<br>';
          echo"</td>";  
          echo"</tr>";  
          echo'<tr class="row2">';
          echo"<br>";
          echo"<td>";
          echo "<img src='".$row['Car_Image']."' width='500' height='300'>";
          echo"</td>";
          echo"</tr>";
          echo"</table>";

          //display the form for user to input customer id and dates wanted to be reserved
          echo'<form method="post">';
            echo'<label class="instruction">Please enter your Customer ID: </label>';
            echo"<br>";
            //submit will not autofill the details
            if(isset($_POST['submit'])){
            echo'<input class="answer" type="text" name="customer_Id" required autocomplete="off">';
            echo'<br>';echo'<br>';echo'<br>';
            echo'<label class="instruction">Please select your reservation date: </label><br>';
            echo'<label class="instruction" for="Start_date">Start date:</label>';
            echo'<input class="answer" type="date" id="Start_date" name="Start_date" required autocomplete="off">';
            echo'<label class="instruction" for="End_date">End date:</label>';
            echo'<input class="answer" type="date" id="End_date" name="End_date" required autocomplete="off">';
            echo'<br>';echo'<br>';
            }
            //check avaibility will autofill back the inputs
            if(isset($_POST['check'])){
              $customer_Id = $_POST['customer_Id'];
              echo'<input class="answer" type="text" name="customer_Id" value='.$customer_Id.' required>';
              echo'<br>';echo'<br>';echo'<br>';
              echo'<label class="instruction">Please select your reservation date: </label><br>';
              echo'<label class="instruction" for="Start_date">Start date:</label>';
              echo'<input class="answer" type="date" id="Start_date" name="Start_date" value='.$start_date.' required>';
              echo'<label class="instruction" for="End_date">End date:</label>';
              echo'<input class="answer" type="date" id="End_date" name="End_date" value='.$end_date.' required>';
              echo'<br>';echo'<br>';
            }
            //all the buttons to check availability, reset or comfirm
            echo'<button class="confirm" type="submit" name="check">Availability</button>';
            echo'<button class="reset" type="reset">Reset</button>';
            echo'<button class="confirm" type="submit" name="reserve">Confirm</button>';
            echo'<br>';echo'<br>';echo'<br>';echo'<br>';
            echo'</div>';
          echo'</form>'; 
      }
    }
?>
</div>

<br><br><br>
  </div>
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
  </body>
  
</html>

<script>
  // disable the button until an option is selected
  const myDropdown = document.getElementById("car_model");
  const myButton = document.getElementById("submit");
  // Disable the button by default
  myButton.disabled = true;
  // Enable the button when an option is selected
  myDropdown.addEventListener("change", toggleButton);
  function toggleButton() {
    if (myDropdown.value === "none") {
      myButton.disabled = true;
    } 
    else {
    myButton.disabled = false;
    }
  }

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
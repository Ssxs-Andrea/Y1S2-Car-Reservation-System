<?php
  session_start();
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Carental Company</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- to make the website looks good on all devices -->
    <link rel = "icon" href = "carimage/icon.png" type = "image/x-icon">
    <link rel="stylesheet" href="menubar.css"> <!-- CSS for menu bar -->
    <link rel="stylesheet" href="check.css">     <!-- CSS for main page  -->
    <!-- icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   

    


</head>
<body>
<div id="page-container">
<div id="content-wrap">
<!-- top navigation bar  -->
<div class="colour">
<!-- LOGO -->
<div class="logo">
  <!-- <h6>CarRent</h6> -->
  <img src="carimage/logo4.png" alt="logo" />
</div>
<!-- MAKE THE NAVIGATION BAR STICKY -->
<div id="navbar">

<div id="main">

      <!--checkbox to open and close the side menu-->
      <input type="checkbox" id="checkmenubar">
    <label for="checkmenubar">
    <i  id="openmenu" class="fa fa-bars" style="font-size:35px;" ></i>
      <i id="closemenu" class="fa fa-bars" style="font-size:35px;"></i>
    </label>

   <!--sidebar link to each section-->
   <div class="menubar" >
    <h1 class="menu_heading">Hello, <?php echo $_SESSION['Name']; ?></h1>  <!-- DISPLAY USERNAME UPON LOGIN -->
    <a class="menu_wording active hover" href="Main page.php"><span>Dashboard</span></a>
    <a class="menu_wording hover" href="addcustomer.php"><span>Add Customer</span></a>
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
    <a class="wording sub" href="checkreservation.php">Reservation Details</a>
    </div>
  </div>
  <a class="menu_wording logout" href="logout.php"><span>Log out</span></a> 
  </div> 
    
  </div>

</div>
</div>


<!-- AUTO SLIDESHOW --> 
 <div class="slideshow-container">
<!-- First slideshow -->
  <div class="mySlides fade">
    <img src="carimage/Poster1.jpg" style="width:100%; height:80vh">
  </div>
  <!-- second slideshow -->
  <div class="mySlides fade">
    <img src="carimage/Poster2.jpg" style="width:100% ;height:80vh">
  </div>
  <!-- third slideshow -->
  <div class="mySlides fade">
    <img src="carimage/Poster3.jpg" style="width:100%; height:80vh;">
  </div>

 

  
  </div>
  <br>
  <!-- The dot will hover according to the slideshow -->
  <div style="text-align:center">
    <span class="dot"></span> 
    <span class="dot"></span> 
    <span class="dot"></span>
     
  </div>    
  
   
  <!-- CAR DETAILS -->
  
   <!--sidebar link to each section-->
   <br><br><br><br><br>

<!-- First Car container -->

  <div class="wrappercar">
   
    <div class="containercar" >

    
     <a class="outputlink" href="newreservation.php" style="text-decoration:none; color:white;font-family:'Comic Sans MS';">Make New Reservation</a>


      <div id="start">
        <img src="carimage/LC001.jpg" style="width:100%;height:100%;" >
        <!-- The container will fade when pointed -->
        <div class="overlayfade">
          <div class="textfade">Rolls Royce Phantom <br>- Colour: Blue <br>- RM 9800 per day</div>
        </div>

      </div>
      
      <div id="slide1">
        <img src="carimage/LC004.jpg" alt="" style="width:100%;height:100%;">
        <div class="overlayfade">
          <div class="textfade">Jaguar S Type <br>- Colour: Champagne <br>- RM 1350 per day</div>

        </div>

        <li> 
          <div class="button"> 
          <!-- <a href="#slide3">Check Availability</a> -->
          </div>
          </li>

      </div>

      <div id="slide2">
        
        <img src="carimage/LC003.jpg" alt="" style="width:100%;height:100%;">
        <div class="overlayfade">
          <div class="textfade">Mercedes Benz CLS 350 <br>- Colour: Silver <br>- RM 1350 per day</div>
        </div>
      </div>

      <div id="slide3">
        
        <img src="carimage/LC002.jpg" alt="" style="width:100%;height:100%;">
        <div class="overlayfade">
          <div class="textfade">Bentley Continental Flying Spur <br>- Colour: White <br>- RM 4800 per day</div>
        </div>
      </div>
    
      
      <h6>Luxurious Car</h6>

      <!-- create buttons that correspond to the slides -->
      <div class="navigationcar">
        
      <li> 
      <div class="btnbtn"> 
      <a href="#start"><img src="carimage/LC001.jpg" alt="" style="width:100%;height:100%;"></a>
      </div>
      </li>
  
      <li>
      <div class="btnbtn">	
      <a href="#slide1"><img src="carimage/LC004.jpg" alt="" style="width:100%;height:100%;"></a>
     </div>
     </li> 
  
     <li>
      <div class="btnbtn">
      <a href="#slide2"><img src="carimage/LC003.jpg" alt="" style="width:100%;height:100%;"></a>
      </div>
      </li>
  
      <li>
      <div class="btnbtn">	
      <a href="#slide3"><img src="carimage/LC002.jpg"  alt="" style="width:100%;height:100%;"></a>
      </div>
      </li> 
  
      </div>
    </div>  
    
  </div>


  
<!-- Second Car container -->

  <div class="wrappercar">
    
   
    <div class="containercar">

    <a class="outputlink" href="newreservation.php" style="text-decoration:none; color:white;font-family:'Comic Sans MS';">Make New Reservation</a>
      <div id="start2">
        <img src="carimage/SC001.jpg" style="width:100%;height:100%;" >
        <div class="overlayfade">
          <div class="textfade">Ferrari F430 Scuderia <br>- Colour: Red <br>- RM 6000 per day</div>
        </div>
      </div>

      <div id="slide4">
        <img src="carimage/SC002.jpg" alt="" style="width:100%;height:100%;">
        <div class="overlayfade">
          <div class="textfade">Lamborghini Murcielago LP640 <br>- Colour: Matte Black <br>- RM 7000 per day</div>
        </div>

      </div>
      <div id="slide5">
        <img src="carimage/SC003.jpg" alt="" style="width:100%;height:100%;">
        <div class="overlayfade">
          <div class="textfade">Porsche Boxster <br>- Colour: White <br>- RM 2800 per day</div>
        </div>
      </div>

      <div id="slide6">
        <img src="carimage/SC004.jpg" alt="" style="width:100%;height:100%;">
        <div class="overlayfade">
          <div class="textfade">Lexus SC430 <br>- Colour: Black <br>- RM 1600 per day</div>
          
        </div>
      </div>

      <h6 >Sport Car</h6>

      <div class="navigationcar">
      <li> 
      <div class="btnbtn"> 
      <a href="#start2"><img src="carimage/SC001.jpg" alt="" style="width:100%;height:100%;"></a>
      </div>
      </li>
  
      <li>
      <div class="btnbtn">	
      <a href="#slide4"><img src="carimage/SC002.jpg" alt="" style="width:100%;height:100%;"></a>
     </div>
     </li> 
  
     <li>
      <div class="btnbtn">
      <a href="#slide5"><img src="carimage/SC003.jpg" alt="" style="width:100%;height:100%;"></a>
      </div>
      </li>
  
      <li>
      <div class="btnbtn">	
      <a href="#slide6"><img src="carimage/SC004.jpg"  alt="" style="width:100%;height:100%;"></a>
      </div>
      </li> 
  
      
      </div>   
    </div>   
  </div>
 


<!-- Third Car container -->

  <div class="wrappercar">
    
    
    <div class="containercar">

    <a class="outputlink" href="newreservation.php" style="text-decoration:none; color:white;font-family:'Comic Sans MS';">Make New Reservation</a>
      <div id="start3">
        <img src="carimage/CC001.jpg" style="width:100%;height:100%;" >
        <div class="overlayfade">
          <div class="textfade">Jaguar MK 2 <br>- Colour: White <br>- RM 2200 per day</div>
        </div>
      </div>

      <div id="slide7">
        <img src="carimage/CC002.jpg" alt="" style="width:100%;height:100%;">
        <div class="overlayfade">
          <div class="textfade">Rolls Royce Silver Spirit Limousine <br>- Colour: Georgian Silver <br>- RM 3200 per day</div>
        </div>

      </div>
      <div id="slide8">
        <img src="carimage/CC003.jpg" alt="" style="width:100%;height:100%;">
        <div class="overlayfade">
          <div class="textfade">MG TD <br>- Colour: Red <br>- RM 2500 per day</div>
        </div>
      </div>

      <h6>Classics Car</h6> 

      <div class="navigationcar">
      <li> 
      <div class="btnbtn"> 
      <a href="#start3"><img src="carimage/CC001.jpg" alt="" style="width:100%;height:100%;"></a>
      </div>
      </li>
  
      <li>
      <div class="btnbtn">	
      <a href="#slide7"><img src="carimage/CC002.jpg" alt="" style="width:100%;height:100%;"></a>
     </div>
     </li> 
  
     <li>
      <div class="btnbtn">
      <a href="#slide8"><img src="carimage/CC003.jpg" alt="" style="width:100%;height:100%;"></a>
      </div>
      </li>

  
      
      </div>
      
    </div>  
    
  </div>
  </div>
  </body>

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
<!-- Javascript -->
  <script src="Scriptscript.js"></script> 

</html> 
    



<?php
session_start();

    include("connect.php");
    //error_reporting(0);

    if($_SERVER['REQUEST_METHOD']=="POST")
    {
        //something was posted
        $ID = $_POST['ID'];
        $_SESSION['ID']=$ID;

        if(!empty($ID))
        {
            //read from database            
            $query = "SELECT * FROM customer_details where Customer_ID='$ID' limit 1";
            $result=mysqli_query($conn,$query);
            while ($row=$result->fetch_assoc()){
                if (mysqli_num_rows($result) > 0) {
                    $_SESSION['Name']=$row['Name'];
                  break;
              }
            }
            $result1=mysqli_query($conn,$query);

            if($result1)
            {
                $user_data=mysqli_fetch_assoc($result1);
                if ($user_data['Customer_ID']===$ID)
                {
                    header("Location:ccheckreservation.php");
                    die;
                }
                else{
                    echo"<script>";
                    echo"alert('Error: Invalid Customer ID!');";
                    echo"window.location='clogin.php';";
                    echo"</script>";
                }
            }
        }
        else
        {
            echo "Please enter some valid information";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="register.css">
    <title>Carental Company</title>
    <link rel = "icon" href = "carimage/icon.png" type = "image/x-icon">
</head>
<body>
   <div class="master-div-style">
    <h1>Login</h1>
    <form method="POST">
        <input type="text" class="name" name="ID" placeholder="Enter your Customer ID" required autocomplete="off">
        <button class="button">Login</button><br>
        <a href="login.php" class="link1">Staff login page</a>
    </form>     
   </div>
   <div>

   </div>
</body>
</html>

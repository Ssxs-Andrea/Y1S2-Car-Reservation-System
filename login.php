<?php
session_start();

    include("connect.php");
    //error_reporting(0);

    if($_SERVER['REQUEST_METHOD']=="POST")
    {
        //something was posted
        $Username = $_POST['Username'];
        $Password=$_POST['Password'];

        if(!empty($Username) && !empty($Password) && !is_numeric($Username))
        {
            //read from database            
            $query = "SELECT * FROM staff_details where Username='$Username' limit 1";
            $result=mysqli_query($conn,$query);
            // mysqli_query($conn,$query);

            if($result)
            {
                $_SESSION['Username']=$Username;
                $user_data=mysqli_fetch_assoc($result);
                if ($user_data['Password']===$Password && $user_data['Username']===$Username)
                {
                    $_SESSION['Name']=$user_data['Name'];
                    header("Location:Main Page.php");
                    die;
                }
                else{
                    echo'<script>
                    alert("Error:Invalid username or password!");
                    window.location.href="login.php";
                    </script>';
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
        <input type="text" class="name" name="Username" placeholder="Enter your Username" required autocomplete="off">
        <input type="text" class="passwords" name="Password" placeholder="Enter your passwords" required autocomplete="off">
        <button class="button">Login</button><br>
        <p class=havent>Haven't signed up?</p>
        <a href="register.php" class="link1">Click to sign up</a>
        <br>
        <a href="clogin.php" class="link2">Customer login page</a>
    </form>     
   </div>
   <div>

   </div>
</body>
</html>

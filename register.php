<?php
session_start();

    include("connect.php");

    $check=TRUE;

    if($_SERVER['REQUEST_METHOD']=="POST")
    {
        //something was posted
        $Username=$_POST['Username'];
        $name = $_POST['name'];
        $password=$_POST['password'];
        $email=$_POST['email'];
        $phone_number=$_POST['phone_number'];
        $length=strlen($password);

        $name_firstpart = strtoupper(substr($name,0,1));
        $id_firstpart = ord(substr($name, 0, 4));
        $random_num = mt_rand(100, 999);
        $Staff_ID = "STF" . $id_firstpart . ($name_firstpart) . $random_num ;


        if(!empty($name) && !empty($password) && !empty($Username) && !empty($email) && $length>=6)
        {

            //save to database
            
            $query = "INSERT INTO staff_details (Staff_ID,Username,name,password,Email_Address,phone_number) VALUES('$Staff_ID','$Username','$name','$password','$email','$phone_number');";
            // mysqli_query($conn,$query);

            if($conn->query($query)) 
            {
                header("Location:login.php");
            }
        }else
        {
            echo "Please try again!";
        }
        if ($length<6){
            $check=FALSE;
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
   <div style="margin-top:7%" class="master-div-style">
    <!-- <div style="font-size: 30px;text-align: center;">Register</div> -->
    <h1>Register</h1>
    <form action="register.php" method="POST">
    <input type="text" class="username" name="Username" placeholder="Enter your Username" required autocomplete="off" value="<?php echo isset($_POST['Username']) ? $_POST['Username'] : ''; ?>">
    <input type="email" class="email" name="email" placeholder="Enter your email" required autocomplete="off" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>">
    <input type="text" class="name" name="name" placeholder="Enter your name" required autocomplete="off" value="<?php echo isset($_POST['name']) ? $_POST['name'] : ''; ?>">
    <input type="text" class="passwords" name="password" placeholder="Enter your passwords" required autocomplete="off">
    <?php if ($check==False){
        echo "<p class=error>Please enter a password that is more than 6 characters</p>";
    }?>
    <input type="tel" class="phone_number" name="phone_number" placeholder="Enter your phone number" required autocomplete="off" value="<?php echo isset($_POST['phone_number']) ? $_POST['phone_number'] : ''; ?>"> 
    <button class="button">Sign up</button><br>
    </form>     
   </div>
   <div>

   </div>
</body>
</html>
<?php
$servername = "localhost";
$username = "root";
$password = "";


// Create connection
$conn = new mysqli($servername, $username, $password,"COMP1044_database" );

// Check connection
/* if($conn) echo "Connected successfully"; */


if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>
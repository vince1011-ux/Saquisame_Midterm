<?php 
$con = mysqli_connect("localhost","root","","act4");
  // Check connection
if($con === false){
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>
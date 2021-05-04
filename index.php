<!DOCTYPE html>
<html lang="en">
<head>
    <title>Lab Activity 3 - Login</title> 

    <meta charset="UTF-8">
    <link rel="stylesheet" href="stylenivince.css"/>
    <meta name="viewport" content="width-device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   
</head>  
<body>
                
    <div class="wrapper">
        <div class="form">
            <h1 id="hhhh">Login</h1>
            <form action="" method="post" name="login">
            <div class="container">
                <form class="form group" action="/authenticator.php">
                    <input class="text" id="username" type="text" name="username" placeholder="Username"><br>
                    <input class="text" id="password" type="password" name="password" placeholder="Password">
                </form>

                <center><button type="submit" class="btn" method="post" name="login">Login</button>
                    <button type="button" class="btn" name="register" onclick="window.location.href='../ITECT100C-Webpage/signup.php'">Register</button>
                </center>
                <!--<button type="button"  class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal" onclick="openWin()">Login</button>-->
                <h1><a href="../ITECT100C-Webpage/forgot.php"> Forgot Password </a></h1>               

            </div>
        </div>
    </div>

</body>

<!--<?php 
session_start();
  
require_once "config.php";

$_SESSION["verify"] = false;
$_SESSION["code_access"] = false;
 
if($_SERVER["REQUEST_METHOD"] == "POST"){
  
    if(empty(trim($_POST["username"]))){
        echo "<h3>Username is empty.</h3><a href='Login.php'></a>";
    } else{
        $username = trim($_POST["username"]);
    }
     
    if(empty(trim($_POST["password"]))){
        echo "<h3>Password is empty.</h3><a href='Login.php'></a>";
    } else{
        $password = trim($_POST["password"]);
    }
     
    if(empty($username_err) && empty($password_err)){ 
        $sql = "SELECT id, username, password FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($con, $sql)){ 
            mysqli_stmt_bind_param($stmt, "s", $param_username);
             
            $param_username = $username;
             
            if(mysqli_stmt_execute($stmt)){ 
                mysqli_stmt_store_result($stmt);
                 
                if(mysqli_stmt_num_rows($stmt) == 1){ 
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){

                            $_SESSION["verify"] = true;
                            $_SESSION["code_access"] = true;
                            
                            $_SESSION["id"] = $id;

                            $link = "<script>window.open('http://localhost/ITECT100B-Webpage/authenticator.php')</script>"; 
                            echo $link; 

                        } else{                              
                            echo "<h3>Password is incorrect.</h3>";
                        }
                    }
                } else{ 
                    echo "<h3>Username is incorrect.</h3>";
                }
            } else{
                echo "<h3>Something went wrong.</h3>";
            }
            mysqli_stmt_close($stmt);
        }
    }
    mysqli_close($con);
}
?>-->

<?php

    include 'config.php';

    $_SESSION["verify"] = false;
    $_SESSION["code_access"] = false;

    if (isset($_POST['username'])){
        
        $username = stripslashes($_REQUEST['username']); // removes backslashes
        $username = mysqli_real_escape_string($con,$username); //escapes special characters in a string
        
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con,$password);

        date_default_timezone_set('Asia/Manila');
        $currentDate = date('Y-m-d H:i:s');
        $currentDate_timestamp = strtotime($currentDate);
        $_SESSION["current"] = $currentDate;
        
        $query = "SELECT * FROM `users` WHERE username='$username' and password='$password'";
        $result = mysqli_query($con,$query) or die(mysql_error());
        $rows = mysqli_num_rows($result);

        if($rows==1){

            $_SESSION["verify"] = true;
            $_SESSION["code_access"] = true;

            $_SESSION["id"] = $id;
            $_SESSION['username'] = $username;

            $sql = "INSERT INTO `userlog` (user_id, username, activity, dateandtime) VALUES ('$id', '$username', 'Logged In', '$currentDate')";
            $result = mysqli_query($con, $sql);

            header("location: ../ITECT100C-Webpage/authenticator.php");

        }else{
            echo "<h3>Username and password is incorrect.</h3>";
        }

    }else{

    }
?>

</html>
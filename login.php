<?php
require_once "config.php";

date_default_timezone_set('Asia/Kolkata');
session_start();
if (isset($_POST['submit'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $query = "SELECT * FROM user WHERE username = '$username' AND pass = '" . md5($password) . " ' ";
    $result1 = mysqli_query($conn, $query);

    if (mysqli_num_rows($result1) > 0) {

        $row = mysqli_fetch_row($result1);
        $to = $row[0];
        $_SESSION['username'] = $username;
        $otp = rand(100000, 999999);
        $q = "insert into login_data VALUES('$username', '$otp')";
        $r = mysqli_query($conn, $q);
        $from = "007rawatakhilesh007@gmail.com";
        $to_email = $to;
        $subject = "Verification";
        $body = " $username Your OTP for 10 Minute is : $otp";
        $headers = "From: $from";

        if (mail($to_email, $subject, $body, $headers)) {
            $timestamp =  $_SERVER["REQUEST_TIME"]; 
            $_SESSION['time'] = $timestamp;   
        } else {
            echo "Email sending failed...";
        }
        if (mysqli_num_rows($result1) > 0) {
            header("location: ./verify.php");
            exit();
        }
    } else {
        echo "<script>
       alert('incorrrect password/username');

       </script>";
        mysqli_close($conn);
    }
}
?>



<!DOCTYPE html>
<html>

<head>
    <title>Login site</title>
</head>

<style>

* {
  box-sizing: border-box;
}

body{
    background-image: url("1.jpg");
    background-repeat: no-repeat, repeat;
    background-size: cover;
}

input{
    width: 250px;
    height: 35px;
    border: 2px solid red;
    border-radius: 4px;
}

input[type="submit"]{
    width: 125px;
    height: 35px;
    border: 2px solid yellowgreen;
    border-radius: 3px;
}

input[type="submit"]:hover{
    background: rebeccapurple;
}

.mydiv{
    border: red solid 2px;
    border-radius: 25px;
    margin: auto;
    background-color: yellow;
    color: red;
}

.div1{
    border: red solid 2px;
    border-radius: 25px;
    margin-top: 100px;
    margin-left: auto;
    margin-right: auto;
 
    padding-top: 35px;
    width: 50vw;
    background-color: gray;
}

.btn1:hover{
    background: rebeccapurple;
}

.btn1{
    font-size: 20px;
    border: cyan solid 2px;
    border-radius: 3px;
}


</style>

<body><br><br>
<div class="div1">
<div class="mydiv">
    <form method="post" action="">
        <table align="center">
            <caption> Login Form </caption>
            <tr>
                <td>Username : </td>
                <td><input type="text" name="username" placeholder="Enter Username" required></td>
            </tr>
            <tr>
                <td>Password : </td>
                <td><input type="password" name="password" placeholder="Enter Password" required></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="submit" name="submit"></td>
            </tr>
        </table>
    </form>
    <p align="center">If New  Register Here &nbsp;&nbsp;&nbsp;<button class="btn1"><a href="./register.php">Register</a></button></p>
</div>
</div>
</body>

</html>
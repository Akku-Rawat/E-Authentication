<?php

require_once "config.php";

if (isset($_POST['submit'])) {

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $cpassword = mysqli_real_escape_string($conn, $_POST['cpassword']);
    $query_email = mysqli_query($conn, "SELECT * from user where email = '$email'");
    $query_username = mysqli_query($conn, "SELECT * from user where username = '$username'");
    if(mysqli_num_rows($query_email)>0){
        echo " <script>alert('Email Already exist')</script> ";
        //header("location: ./register.php");
    }
    if(mysqli_num_rows($query_username)>0){
        echo "<script>alert(' Username Already exist')</script>";
        //header("location: ./register.php");
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Please Enter Valid Email ID<br>";
        //header("location: ./register.php");
    }
    if (strlen($password) < 4) {
        echo "<script>alert('Password must be minimum of 4 characters')</script>";
        //header("location: ./register.php");
    }
    if ($password != $cpassword) {
        echo "Password and Confirm Password doesn't match<br>";
        //header("location: ./register.php");
    }
    $pass = md5($password);
    $register_query = "INSERT INTO user VALUES('$email', '$username', '$pass')";
    $result = mysqli_query($conn, $register_query);

    if ($result) {
        header("location: ./login.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
        mysqli_close($conn);
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Register site</title>
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
            <caption> Registration Form </caption>
            <tr>
                <td>E-Mail : </td>
                <td><input type="email" name="email" placeholder="Enter Email" required></td>
            </tr>
            <tr>
                <td>Username : </td>
                <td><input type="text" name="username" placeholder="Enter Username" required></td>
            </tr>
            <tr>
                <td>Password : </td>
                <td><input type="password" name="password" placeholder="Enter Password" required></td>
            </tr>
            <tr>
                <td>Confirm Password : </td>
                <td><input type="password" name="cpassword" placeholder="Confirm Password" required></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="Register" name="submit"></td>
            </tr>
        </table>
    </form>

    <p align="center">If already registered &nbsp;&nbsp;&nbsp;<button class="btn1"><a href="./login.php">login</a></button></p>
    </div>
    </div>
</body>

</html>

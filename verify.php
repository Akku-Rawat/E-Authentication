<?php
require_once "config.php";

date_default_timezone_set('Asia/Kolkata');
session_start();
if (isset($_POST['submit'])) {
    $myotp = mysqli_real_escape_string($conn, $_POST['otp']);
    $query2 = "SELECT * FROM login_data WHERE username = '" . $_SESSION['username'] . "' AND otp = '$myotp' ";
    $result2 = mysqli_query($conn, $query2);
    $timestamp =  $_SERVER["REQUEST_TIME"];
    if (($timestamp - $_SESSION['time']) > 600) {
        echo "<script>
       alert('OTP expired');

       </script>";
        //header("location: ./login.php");
    } else if (mysqli_num_rows($result2) > 0) {
        $q3 = "delete from login_data where username = '" . $_SESSION['username'] . "' ";
        mysqli_query($conn, $q3);
        header("location: ./dashboard.php");
        exit();
    } else {
        echo "<script>
       alert('incorrrect OTP');

       </script>";
        mysqli_close($conn);
    }
}


?>


<!DOCTYPE html>
<html>

<head>
    <title>Verify</title>
</head>
<style>
    body {
        background-image: url("1.jpg");
        background-repeat: no-repeat, repeat;
        background-size: cover;
    }

    input[type="number"] {
        width: 250px;
        height: 35px;
    }

    input[type="submit"] {
        width: 125px;
        height: 35px;
        border: 2px solid yellowgreen;
        border-radius: 3px;
    }

    input[type="submit"]:hover {
        background: rebeccapurple;

    }


    .mydiv {
        border: red solid 2px;
        border-radius: 25px;
        margin: auto;
        background-color: yellow;
        color: red;
    }

    .div1 {
        border: red solid 2px;
        border-radius: 25px;
        margin-top: 100px;
        margin-left: auto;
        margin-right: auto;

        padding-top: 35px;
        width: 30vw;
        background-color: gray;
    }
</style>

<body><br><br>
    <div class="div1">
        <div class="mydiv">
            <form method="post" action="">
                <table align="center">
                    <tr>
                        <td>OTP: </td>
                        <td><input type="number" name="otp" placeholder="Enter OTP" required></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input type="submit" value="submit" name="submit"></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</body>

</html>
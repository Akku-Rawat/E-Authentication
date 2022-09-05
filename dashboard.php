<?php
session_start();
require_once "config.php";

if(isset($_SESSION["username"]))
{
 $username = $_SESSION["username"];
}else {
    $link_address = 'login.php';
    echo "<h3>You are accessing dashboard without loging in first login here <a href='".$link_address."'>Login</a><h3>";
    exit();
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Dashboard area</title>
</head>
<style>

.btn2:hover{
    background: rebeccapurple;
}

.btn2{
    font-size: 20px;
}

</style>
<body>
    <div class="form">
        <h3>You are now on <?php echo $username; ?>  dashboard page.</h3>
        <button class="btn2"><a href="./logout.php">logout</a></button>
    </div>
</body>
</html>
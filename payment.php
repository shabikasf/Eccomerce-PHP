<?php
session_start();

$uid = 0;
if (isset($_SESSION['id'])) {
    $uid = $_SESSION['id'];
} else {
    header("Location: login.php");
    exit();
}

$servername = "localhost";
$username = "root";
$pwd = "";
$dbname = "ecommerce";
$port = 3307;

$conn = mysqli_connect($servername, $username, $pwd, $dbname, $port);
$error = true;
if ($conn) {
    $error = false;
}

$stm1 = "SELECT `pid` FROM `cart` WHERE `uid` = '$uid'";
$res1 = mysqli_query($conn, $stm1);


while($row = mysqli_fetch_assoc($res1)){
    $sql = "INSERT INTO `ordertbl`(`pid`, `uid`) VALUES ('" . $row['pid'] . "', '$uid')";
    $result = mysqli_query($conn, $sql);
    
}
$stm2 = "DELETE FROM `cart` WHERE `uid` ='$uid'";
$res2 = mysqli_query($conn, $stm2);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
        crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 offset-md-3 text-center">
                <h2>Payment Successful</h2>
                <p>Thank you for your purchase!</p>
                <a href="home.php" class="btn btn-primary">Back to Home</a>
            </div>
        </div>
    </div>
</body>

</html>

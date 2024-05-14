<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

$servername = "localhost";
$username = "root";
$pwd = "";
$dbname = "ecommerce";
$port = 3307;

$conn = mysqli_connect($servername, $username, $password, $dbname, $port);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$uid = $_SESSION['id'];
$sql = "SELECT * FROM `user` WHERE `id`='$uid'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $name = $row['name'];
    $phone = $row['phone'];
    $email = $row['email'];
    $address = $row['address'];
    $gender = $row['gender'];
} else {
    echo "User details not found!";
    exit();
}

mysqli_close($conn);
?>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Account</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
        crossorigin="anonymous">
    <style>
        body {
        background-color: #f8f9fa;
        color: #343a40;
        }
        nav div ul li a{
            color: white;
        }
        h3{
            margin: 2rem 0;
            text-shadow: 2px 2px 20px black;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg " style="background-color: #710193">
    <a class="navbar-brand" href="home.php"><img src="cartimg.png" height="40px" alt=""></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                <a class="nav-link" href="home.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="myAccount.php">My account</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="cart.php">Cart</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="order.php">Orders</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="logout.php">log out</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container mt-5">
        <h2>My Account</h2>
        <form>
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" value="<?php echo $name; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="gender">Gender:</label>
                <input type="text" class="form-control" id="gender" value="<?php echo $gender; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="phone">Phone:</label>
                <input type="text" class="form-control" id="phone" value="<?php echo $phone; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" value="<?php echo $email; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="address">Address:</label>
                <textarea class="form-control" id="address" rows="3" readonly><?php echo $address; ?></textarea>
            </div>
        </form>
    </div>
</body>

</html>

<?php
session_start();
$uid = 0;
if(isset($_SESSION['id'])){
   $uid = $_SESSION['id'];
}else{
    header("Location:login.page");
}

$pid = $_GET['id']; 
$servername = "localhost";
$username = "root";
$pwd = "";
$dbname = "ecommerce";
$port = 3307;

$conn = new mysqli($servername, $username, $pwd, $dbname, $port);

$error = false;
if ($conn->connect_error) {
    $error = true;
}


$sql = "SELECT * FROM `product` WHERE pid='$pid'";
$result = mysqli_query($conn, $sql);
if($result)
    $product = mysqli_fetch_assoc($result);

if(isset($_GET['cart'])){
        $pid = $_GET['cart'];
        $sql = "INSERT INTO `cart` (`uid`, `pid`) VALUES($uid, $pid)";
        $result = mysqli_query($conn, $sql);
        $loc = "Location: productDetail.php?id=".$pid;
        header($loc);
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Detail</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            color: #343a40;
        }
        nav div ul li a{
            color: white;
        }
         h3 {
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

    <div class="container">
        <h3 class="catalog-heading">About <?php echo $product['pname'] ?></h3>
        <div class="row">
            <div class="col-md-4">
                <img src="<?php echo $product['url']; ?>" class="img-fluid" alt="Product Image">
            </div>
            <div class="col-md-8">
                <h2><?php echo $product['description']; ?></h2>
                <p>Price: $<?php echo number_format($product['price'], 2); ?></p>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugit nihil, ea enim ullam eum labore laborum quasi eius exercitationem consectetur corrupti facere voluptatibus tenetur perferendis asperiores delectus modi voluptatum ad officia alias minus natus quisquam! Deleniti fugiat aut placeat tenetur ipsum, laudantium minus, fugit quibusdam optio atque incidunt error perspiciatis ad porro nisi illo aspernatur ex cumque eveniet, assumenda modi neque autem hic? Quae esse recusandae sed obcaecati cupiditate. Eos numquam a nobis similique optio, illum sit, neque nemo veritatis distinctio quam repellat consequuntur non? Inventore, in minima veritatis veniam eaque, sunt sint fugiat illum modi repudiandae itaque tempore vitae!</p>
                <div class="btn-group" role="group" aria-label="Product Actions">
                <a href="buy.php?product=<?php echo $product['pid'];?>" class="btn btn-primary">Buy Now</a>
                <a href="productDetail.php?cart=<?php echo $product['pid'];?>" class="btn btn-success">Add to Cart</a>
                </div>
            </div>
        </div>
    </div>

</body>
</html>

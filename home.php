<?php
    session_start();
    
    $uid=0;
    if(isset($_SESSION['id'])){
        $uid = $_SESSION['id'];
    }else{
        header("Location: login.php");
        exit();
    }

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

    if(isset($_GET['cart'])){
        $pid = $_GET['cart'];
        $sql = "INSERT INTO `cart` (`uid`, `pid`) VALUES($uid, $pid)";
        $result = mysqli_query($conn, $sql);
        header("Location:home.php");
        exit();
    }


?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
  <title>Home</title>
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

    <?php
        if($error)
            echo '<div class="alert alert-danger" role="alert">
                Connection failed: ' . $conn->connect_error . '
            </div>';
    ?>

    <div class="container">
    <h3>Discover products</h3>
    <div class="row">
        <?php
        $sql = "SELECT * FROM `product`";
        $result = mysqli_query($conn, $sql);

        while($product = mysqli_fetch_assoc($result)) {
            ?>
            <div class="col-md-4 mb-4">
                <div class="card" style="width:300px; height:400px">
                    <a href="productDetail.php?id=<?php echo $product['pid']; ?>">
                        <img src="<?php echo $product['url']; ?>" class="card-img-top" style="height: 200px; width: 300px" alt="Product Image">
                    </a>
                    <div class="card-body">
                        <h5 class="card-title" style="height:50px"><?php echo $product['description']; ?></h5>
                        <p class="card-text" style="height:50px">$<?php echo number_format($product['price'], 2); ?></p>
                        <a href="home.php?cart=<?php echo $product['pid']; ?>" class="btn btn-primary cart">Add to Cart</a>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
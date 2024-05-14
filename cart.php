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

    $conn = mysqli_connect($servername, $username, $pwd, $dbname, $port);
    $error = true;
    if ($conn) {
        $error = false;
    }

    $sql = "SELECT * FROM `cart` WHERE `uid` = '$uid'";
    $result = mysqli_query($conn, $sql);

    if(isset($_GET['delete'])){
        $cid = $_GET['delete'];
        $delete = true;
        $sql = "DELETE FROM `cart` WHERE `cid` = $cid";
        $result = mysqli_query($conn, $sql);
        header("Location:cart.php");
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
  <title>My Cart</title>
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
    .buy{
        color: #000;
        text-decoration: none;
    }
    .buy:hover{
        color: #fff;
        text-decoration: none;
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

    <div class="container my-4">


    <table class="table" id="myTable">
      <thead>
        <tr>
          <th scope="col">PID</th>
          <th scope="col">Name</th>
          <th scope="col">Price</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php 
          if($result){
            $pid = 0;
            while($row = mysqli_fetch_assoc($result)){
                $sqli = "SELECT * FROM `product` WHERE `pid`='{$row['pid']}'";
                $result1 = mysqli_query($conn, $sqli);
                if($result1){
                    $product = mysqli_fetch_assoc($result1);
                    $pid = $pid + 1;
                    echo "<tr>
                    <th scope='row'>". $pid . "</th>
                    <td>". $product['pname'] . "</td>
                    <td>". $product['price'] . "</td>
                    <td> <button class='delete btn btn-sm btn-danger' id=d".$row['cid'].">Remove From Cart</button>  </td>
                </tr>";
                }
            }
        } 
        ?>


      </tbody>
    </table>
    <hr>
    <div>
        <a href='buy.php' class='buy btn btn-md btn-warning'>Checkout</a>
    </div>
  </div>
  
  
    <script>
        deletes = document.getElementsByClassName('delete');
        Array.from(deletes).forEach((element) => {
        element.addEventListener("click", (e) => {
            console.log("edit ");
            cid = e.target.id.substr(1);

            if (confirm("Are you sure you want to delete this product!")) {
            console.log("yes");
            window.location = `cart.php?delete=${cid}`;
            }
            else {
            console.log("no");
            }
        })
        })
    </script>
</body>
</html>
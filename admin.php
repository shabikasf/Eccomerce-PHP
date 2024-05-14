<?php  
$insert = false;
$update = false;
$delete = false;

$servername = "localhost";
$username = "root";
$pwd = "";
$dbname = "ecommerce";
$port = 3307;


$conn = new mysqli($servername, $username, $pwd, $dbname, $port);


if (!$conn){
   echo '<div class="alert alert-danger" role="alert">
            Connection failed: ' . $conn->connect_error . '
          </div>';
}

if(isset($_GET['delete'])){
  $pid = $_GET['delete'];
  $delete = true;
  $sql = "DELETE FROM `product` WHERE `pid` = $pid";
  $result = mysqli_query($conn, $sql);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
if (isset( $_POST['pidEdit'])){
  
    $pid = $_POST["pidEdit"];
    $name = $_POST["pnameEdit"];
    $price = $_POST["priceEdit"];
    $quantity = $_POST["quantityEdit"];
    $url = $_POST["urlEdit"];
    $description = $_POST["descriptionEdit"];

  
    $sql = "UPDATE `product` SET `pname` = '$name' , `price` = '$price', `quantity` = '$quantity', `description` = '$description' WHERE `product`.`pid` = '$pid'";
    $result = mysqli_query($conn, $sql);
    if($result){
        $update = true;
    }
    else{
        echo "OOPS! Something went wrong";
    }
}
else{
    $name = $_POST["pname"];
    $price = $_POST["price"];
    $quantity = $_POST["quantity"];
    $url = $_POST["url"];
    $description = $_POST["description"];

  
  $sql = "INSERT INTO `product` (`pname`, `price`, `quantity`, `url`, `description`) VALUES ('$name', '$price', '$quantity', '$url', '$description')";
  $result = mysqli_query($conn, $sql);

   
  if($result){ 
      $insert = true;
  }
  else{
      echo 'The record was not inserted successfully because of this error ---> . mysqli_error($conn)';
      
  } 
}
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


  <title>Adminstration</title>
  <style>
    div ul li a{
      color: white;
    }
  </style>

</head>

<body>
 

  
  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Edit this Note</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form action="admin.php" method="POST">
          <div class="modal-body">
            <input type="hidden" name="pidEdit" id="pidEdit">
            <div class="form-group">
              <label for="pname">Product Name</label>
              <input type="text" class="form-control" id="pnameEdit" name="pnameEdit" aria-describedby="emailHelp">
            </div>

            <div class="form-group">
              <label for="price">Price</label>
              <input type="text" class="form-control" id="priceEdit" name="priceEdit" aria-describedby="emailHelp">
            </div>

            <div class="form-group">
              <label for="quantity">Quantity</label>
              <input type="text" class="form-control" id="quantityEdit" name="quantityEdit" aria-describedby="emailHelp">
            </div>
            <div class="form-group">
              <label for="url">Product Image Url</label>
              <input type="text" class="form-control" id="urlEdit" name="urlEdit" aria-describedby="emailHelp">
            </div>

            <div class="form-group">
              <label for="desc">Product Description</label>
              <textarea class="form-control" id="descriptionEdit" name="descriptionEdit" rows="3"></textarea>
            </div> 
          </div>
          <div class="modal-footer d-block mr-auto">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <nav class="navbar navbar-expand-lg " style="background-color: #710193">
    <a class="navbar-brand" href="#"><img src="cartimg.png" height="40px" alt=""></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Contact Us</a>
        </li>

      </ul>
    </div>
  </nav>

  <?php
  if($insert){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> Product details has been inserted successfully
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
  }
  ?>
  <?php
  if($delete){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> Product has been deleted successfully
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
  }
  ?>
  <?php
  if($update){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong>Product has been updated successfully
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
  }
  ?>
  <div class="container my-4">
    <h2>Add a new product</h2>
    <form action="admin.php" method="POST">
        <div class="form-group">
            <label for="pname">Product Name</label>
            <input type="text" class="form-control" id="pname" name="pname" aria-describedby="emailHelp">
        </div>

        <div class="form-group">
            <label for="price">Price</label>
            <input type="text" class="form-control" id="price" name="price" aria-describedby="emailHelp">
        </div>

        <div class="form-group">
            <label for="quantity">Quantity</label>
            <input type="text" class="form-control" id="quantity" name="quantity" aria-describedby="emailHelp">
        </div>

        <div class="form-group">
            <label for="url">Product Image Url</label>
            <input type="text" class="form-control" id="url" name="url" aria-describedby="emailHelp">
        </div>

        <div class="form-group">
            <label for="desc">Product Description</label>
            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
        </div> 
      
        <button type="submit" class="btn btn-primary">Add Product</button>
    </form>
  </div>

  <div class="container my-4">


    <table class="table" id="myTable">
      <thead>
        <tr>
          <th scope="col">PID</th>
          <th scope="col">Name</th>
          <th scope="col">Price</th>
          <th scope="col">Quantity</th>
          <th scope="col">Url</th>
          <th scope="col">Description</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php 
          $sql = "SELECT * FROM `product`";
          $result = mysqli_query($conn, $sql);
          $pid = 0;
          while($row = mysqli_fetch_assoc($result)){
            $pid = $pid + 1;
            echo "<tr>
            <th scope='row'>". $pid . "</th>
            <td>". $row['pname'] . "</td>
            <td>". $row['price'] . "</td>
            <td>". $row['quantity'] . "</td>
            <td>". $row['url'] . "</td>
            <td>". $row['description'] . "</td>
            <td> <button class='edit btn btn-sm btn-primary' id=".$row['pid'].">Edit</button> <button class='delete btn btn-sm btn-primary' id=d".$row['pid'].">Delete</button>  </td>
          </tr>";
        } 
          ?>


      </tbody>
    </table>
  </div>
  <hr>
  
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
    crossorigin="anonymous"></script>
  <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready(function () {
      $('#myTable').DataTable();

    });
  </script>
  <script>
    edits = document.getElementsByClassName('edit');
    Array.from(edits).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("edit ");
        tr = e.target.parentNode.parentNode;
        name = tr.getElementsByTagName("td")[0].innerText;
        price = tr.getElementsByTagName("td")[1].innerText;
        quanity = tr.getElementsByTagName("td")[2].innerText;
        url = tr.getElementsByTagName("td")[3].innerText;
        description = tr.getElementsByTagName("td")[4].innerText;
        pnameEdit.value = pname;
        priceEdit.value = price;
        quantityEdit.value = quantity;
        urlEdit.value = url;
        descriptionEdit.value = description;
        pidEdit.value = e.target.id;
        console.log(e.target.id)
        $('#editModal').modal('toggle');
      })
    })

    deletes = document.getElementsByClassName('delete');
    Array.from(deletes).forEach((element) => {
      element.addEventListener("click", (e) => {
        pid = e.target.id.substr(1);

        if (confirm("Are you sure you want to delete this product!")) {
          window.location = `admin.php?delete=${pid}`;
        }
      })
    })
  </script>
</body>

</html>
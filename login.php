<?php
session_start();

$servername = "localhost";
$username = "root";
$pwd = "";
$dbname = "ecommerce";
$port = 3307;


$conn = new mysqli($servername, $username, $pwd, $dbname, $port);


if ($conn->connect_error) {
    echo '<div class="alert alert-danger" role="alert">
            Connection failed: ' . $conn->connect_error . '
          </div>';
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST["username"];
    $password = $_POST["password"];

    $query = "SELECT * FROM user WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row["password"])) {
            $_SESSION["id"] = $row['id'];
            if(strtolower($row["role"]) === "user" ){
                header("Location: home.php");
                exit();
            }
            else if(strtolower($row["role"]) === "admin"){
                header("Location: admin.php");
                exit();

            }
        } else {
            $_SESSION["error"] = "Incorrect password";
            echo '<div class="alert alert-danger" role="alert">
            Incorrect Passoword
            </div>';
        }
    } else {
        $_SESSION["error"] = "User not found";
        echo '<div class="alert alert-danger" role="alert">
            User not found
          </div>';
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            /* background: linear-gradient(135deg, #b8c6db, #f5f7fa);
            background-size: cover;
            background-repeat: no-repeat;
            height: 100vh; */
            background-image: url("bg.jpg");
            background-size: cover;
            background-repeat: no-repeat;
        }
        .login-form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .login-header {
            text-align: left;
            color: #fff;
        }
        .form-group label {
            color: #343a40;
            font-weight: 600; 
        }
        .form-control {
            color: #495057; 
        }
        .btn-primary {
            letter-spacing: 0.5px;
            background-color: #007bff;
            border-color: #007bff;
            font-weight: 600;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <h1 class="login-header">Login</h1>
            <p class="login-header">Hi, Welcome back 👋</p>
            <div class="login-form">
                <form action="login.php" method="POST">
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Login</button>
                </form>
                <div class="text-center mt-3">
                    <p>Not a user? <a href="register.php">Register here</a></p>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>



<?php

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
    $role = "user";
    $stmt = $conn->prepare("INSERT INTO user (name, email, phone, gender, address, role, password) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $name, $email, $phone, $gender, $address, $user, $password);

    
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $gender = $_POST["gender"];
    $address = $_POST["address"];
    
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    
    if ($stmt->execute() === TRUE) {
        echo '<div class="alert alert-success" role="alert">
                Registration successful!
              </div>';
    } else {
        echo '<div class="alert alert-danger" role="alert">
                Error: ' . $stmt->error . '
              </div>';
    }


    $stmt->close();
    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url("bg.jpg");
            background-size: cover;
            background-repeat: no-repeat;
        }
        .registration-header {
            text-align: left;
            color:#fff;
        }

        .registration-form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
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
        <div class="col-md-6">
            <h1 class="registration-header">Sign Up</h1>
            <p class="registration-header">Join us and explore our platform</p>
            <div class="registration-form">
                <form action="register.php" method="POST">
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone:</label>
                        <input type="tel" class="form-control" id="phone" name="phone">
                    </div>
                    <div class="form-group">
                        <label for="gender">Gender:</label>
                        <select class="form-control" id="gender" name="gender">
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="address">Address:</label>
                        <textarea class="form-control" id="address" name="address" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Register</button>
                </form>
                <div class="text-center mt-3">
                    <p>Already a user? <a href="login.html">Sign in here</a></p>
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


<?php
include("../config/db.php");

if(isset($_POST['register']))
{
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $college = $_POST['college'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if($password != $confirm_password)
    {
        echo "<script>alert('Passwords do not match');</script>";
    }
    else
    {
        $password = password_hash($password, PASSWORD_DEFAULT);

        $sql1 = "INSERT INTO users(email,password,role,status)
                 VALUES('$email','$password','student','active')";

        if(mysqli_query($conn,$sql1))
        {
            $user_id = mysqli_insert_id($conn);

            $sql2 = "INSERT INTO students(user_id,full_name,phone,college_name)
                     VALUES('$user_id','$fullname','$phone','$college')";

            mysqli_query($conn,$sql2);

            echo "<script>
                    alert('Registration Successful');
                  </script>";
        }
        else
        {
            echo "Error : ".mysqli_error($conn);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration | InternLink</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="../assets/css/style.css">

    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>

<nav class="navbar navbar-expand-lg bg-white shadow-sm">

<div class="container">

<a class="navbar-brand fw-bold text-primary" href="../index.php">

InternLink

</a>

<button class="navbar-toggler"
type="button"
data-bs-toggle="collapse"
data-bs-target="#navbarNav">

<span class="navbar-toggler-icon"></span>

</button>

<div class="collapse navbar-collapse" id="navbarNav">

<ul class="navbar-nav ms-auto">

<li class="nav-item">
<a class="nav-link" href="../index.php">Home</a>
</li>

<li class="nav-item">
<a class="nav-link" href="../about.php">About</a>
</li>

<li class="nav-item">
<a class="nav-link" href="../contact.php">Contact</a>
</li>

<li class="nav-item">
<a class="nav-link active" href="#">Register</a>
</li>

</ul>

</div>

</div>

</nav>

<section class="py-5">

<div class="container">

<div class="row justify-content-center">

<div class="col-lg-7">

<div class="card shadow border-0">

<div class="card-body p-5">

<div class="text-center mb-4">

<i class="bi bi-person-plus-fill display-3 text-primary"></i>

<h2 class="fw-bold mt-3">

Student Registration

</h2>

<p class="text-muted">

Create your InternLink account

</p>

</div>

<form method="POST" action="">

<div class="row">

<div class="col-md-6 mb-3">

<label class="form-label">Full Name</label>

<input
type="text"
class="form-control"
name="fullname"
placeholder="Enter Full Name"
required>

</div>

<div class="col-md-6 mb-3">

<label class="form-label">Email Address</label>

<input
type="email"
class="form-control"
name="email"
placeholder="Enter Email"
required>

</div>

<div class="col-md-6 mb-3">

<label class="form-label">Mobile Number</label>

<input
type="tel"
class="form-control"
name="phone"
placeholder="Enter Mobile Number"
required>
</div>

<div class="col-md-6 mb-3">

<label class="form-label">College Name</label>

<input
type="text"
class="form-control"
name="college"
placeholder="Enter College Name"
required>

</div>

<div class="col-md-6 mb-3">

<label class="form-label">Password</label>

<input
type="password"
class="form-control"
name="password"
placeholder="Create Password"
required>

</div>

<div class="col-md-6 mb-3">

<label class="form-label">Confirm Password</label>

<input
type="password"
class="form-control"
name="confirm_password"
placeholder="Confirm Password"
required>

</div>
<div class="col-12 mt-3">

<div class="d-grid">

<button
type="submit"
name="register"
class="btn btn-primary btn-lg">
Create Account

</button>

</div>

</div>

</div>

<div class="text-center mt-4">

<p>

Already have an account?

<a href="login.php" class="text-decoration-none fw-bold">

Login Here

</a>

</p>

</div>

<div class="text-center">

<a href="../index.php" class="text-decoration-none">

← Back to Home

</a>

</div>

</form>

</div>

</div>

</div>

</div>

</div>

</section>

<footer class="bg-dark text-white text-center py-4">

<div class="container">

<p class="mb-0">

© 2026 InternLink | All Rights Reserved

</p>

</div>

</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
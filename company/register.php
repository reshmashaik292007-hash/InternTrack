
<?php

include("../config/db.php");
include("../includes/functions.php");

if(isset($_POST['register']))
{
    $company_name = trim($_POST['company_name']);
    $email = normalizeEmail($_POST['email']);
    $website = trim($_POST['website']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Company name reuses the same "3-50 chars" length rule as validateName(),
    // but company names legitimately contain digits, punctuation, etc.
    // (e.g. "TCS", "7-Eleven Pvt Ltd"), so we don't use the alphabets-only check here.
    if(strlen($company_name) < 3 || strlen($company_name) > 100)
    {
        $companyNameError = "Company name must be between 3 and 100 characters.";
    }
    else
    {
        $companyNameError = "";
    }

    $emailError = validateEmail($email);
    $passwordError = validatePassword($password);

    if($companyNameError !== "")
    {
        echo "<script>alert(" . json_encode($companyNameError) . ");</script>";
    }
    elseif($emailError !== "")
    {
        echo "<script>alert(" . json_encode($emailError) . ");</script>";
    }
    elseif($passwordError !== "")
    {
        echo "<script>alert(" . json_encode($passwordError) . ");</script>";
    }
    elseif($password != $confirm_password)
    {
        echo "<script>alert('Passwords do not match');</script>";
    }
    else
    {
        $checkStmt = mysqli_prepare($conn, "SELECT user_id FROM users WHERE email=?");
        mysqli_stmt_bind_param($checkStmt, "s", $email);
        mysqli_stmt_execute($checkStmt);
        mysqli_stmt_store_result($checkStmt);

        if(mysqli_stmt_num_rows($checkStmt) > 0)
        {
            echo "<script>alert('Email already exists');</script>";
        }
        else
        {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $stmt1 = mysqli_prepare($conn, "INSERT INTO users(email,password,role,status) VALUES(?,?,'company','active')");
            mysqli_stmt_bind_param($stmt1, "ss", $email, $hashedPassword);

            if(mysqli_stmt_execute($stmt1))
            {
                $user_id = mysqli_insert_id($conn);

                $description = !empty($_POST['description']) ? trim($_POST['description']) : "New Company";
                $location = !empty($_POST['address']) ? trim($_POST['address']) : (!empty($_POST['location']) ? trim($_POST['location']) : "India");
                $logo = "default_logo.png";

                $stmt2 = mysqli_prepare($conn, "INSERT INTO companies (user_id,company_name,website,description,location,logo) VALUES (?,?,?,?,?,?)");
                mysqli_stmt_bind_param($stmt2, "isssss", $user_id, $company_name, $website, $description, $location, $logo);

                if(mysqli_stmt_execute($stmt2))
                {
                    echo "<script>
                    alert('Company Registration Successful');
                    window.location='login.php';
                    </script>";
                }
                else
                {
                    echo mysqli_error($conn);
                }
            }
            else
            {
                echo mysqli_error($conn);
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Company Registration | InternLink</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="../assets/css/style.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>

<body>

<nav class="navbar navbar-expand-lg bg-white shadow-sm">

<div class="container">

<a class="navbar-brand fw-bold text-primary" href="../index.php">

InternLink

</a>

<button class="navbar-toggler" type="button"
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
<a class="nav-link active" href="#">Company Register</a>
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

<i class="bi bi-building-add display-3 text-primary"></i>

<h2 class="fw-bold mt-3">

Company Registration

</h2>

<p class="text-muted">

Create your company account

</p>

</div>

<form method="POST" action="">

<div class="row">

<div class="col-md-6 mb-3">
<label class="form-label">Company Name</label>
<input
type="text"
class="form-control"
name="company_name"
placeholder="Enter Company Name"
minlength="3"
maxlength="100"
required>
</div>

<div class="col-md-6 mb-3">
<label class="form-label">Company Email</label>
<input
type="email"
class="form-control"
name="email"
placeholder="Enter Company Email"
required>
</div>

<div class="col-md-6 mb-3">
<label class="form-label">Contact Number</label>
<input
type="tel"
class="form-control"
name="phone"
placeholder="Enter Contact Number">
</div>

<div class="col-md-6 mb-3">
<label class="form-label">Website</label>
<input
type="url"
class="form-control"
name="website"
placeholder="https://example.com"
required>
</div>

<div class="col-md-12 mb-3">
<label class="form-label">Company Address</label>
<textarea
class="form-control"
name="address"
rows="3"
placeholder="Enter Company Address"></textarea>
</div>

<div class="col-md-6 mb-3">
<label class="form-label">Password</label>
<input
type="password"
class="form-control"
name="password"
placeholder="Create Password"
minlength="8"
maxlength="64"
pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^A-Za-z0-9]).{8,64}$"
title="At least 8 characters, with 1 uppercase, 1 lowercase, 1 number, and 1 special character. No spaces."
required>

<div class="form-text">
Min 8 characters, with uppercase, lowercase, a number, and a special character.
</div>

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
Create Company Account
</button>
</div>
</div>

</div>

<div class="text-center mt-4">
<p>
Already have a company account?
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
<?php
session_start();
include("../config/db.php");

if(!isset($_SESSION['company_id']))
{
    header("Location: login.php");
    exit();
}

if(isset($_POST['post']))
{
    $user_id = $_SESSION['company_id'];

    $company = mysqli_query($conn,"SELECT company_id FROM companies WHERE user_id='$user_id'");
    $companyData = mysqli_fetch_assoc($company);
    $company_id = $companyData['company_id'];

    $title = $_POST['title'];
    $location = $_POST['location'];
    $duration = $_POST['duration'];
    $stipend = $_POST['stipend'];
    $description = $_POST['description'];
    $requirements = $_POST['requirements'];
    $deadline = $_POST['deadline'];
    $type = $_POST['type'];

    $sql = "INSERT INTO internships(company_id,category_id,title,description,requirements,location_type,duration,stipend,min_stipend_value,deadline,is_active)
             VALUES('$company_id',1,'$title','$description','$requirements','$type','$duration','$stipend',0,'$deadline',1)";
    if(mysqli_query($conn,$sql))
    {
        echo "<script>alert('Internship Posted Successfully');</script>";
    }
    else
    {
        echo mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Post Internship | InternLink</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="../assets/css/style.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">

<div class="container">

<a class="navbar-brand fw-bold" href="../index.php">
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
<a class="nav-link" href="dashboard.php">Dashboard</a>
</li>

<li class="nav-item">
<a class="nav-link active" href="#">Post Internship</a>
</li>

<li class="nav-item">
<a class="nav-link" href="applicants.php">Applicants</a>
</li>

<li class="nav-item">
<a class="nav-link" href="profile.php">Profile</a>
</li>

<li class="nav-item">
<a class="nav-link text-warning" href="login.php">Logout</a>
</li>

</ul>

</div>

</div>

</nav>

<section class="py-5">

<div class="container">

<div class="row justify-content-center">

<div class="col-lg-8">

<div class="card shadow border-0">

<div class="card-header bg-primary text-white">

<h3 class="mb-0">
Post New Internship
</h3>

</div>

<div class="card-body">

<form method="POST">

<div class="mb-3">

<label class="form-label">
Internship Title
</label>

<input
type="text"
class="form-control"
name="title"
placeholder="e.g. Frontend Developer"
required>

</div>

<div class="mb-3">

<label class="form-label">
Location
</label>

<input
type="text"
class="form-control"
name="location"
placeholder="Enter Location"
required>

</div>

<div class="row">

<div class="col-md-6 mb-3">

<label class="form-label">
Duration
</label>

<input
type="text"
class="form-control"
name="duration"
placeholder="e.g. 6 Months"
required>

</div>

<div class="col-md-6 mb-3">

<label class="form-label">
Stipend
</label>

<input
type="text"
class="form-control"
name="stipend"
placeholder="e.g. ₹25,000 / Month"
required>

</div>

</div>

<div class="mb-3">

<label class="form-label">
Job Description
</label>

<textarea
class="form-control"
rows="5"
name="description"
placeholder="Enter internship description"
required></textarea>

</div>

<div class="mb-3">

<label class="form-label">
Required Skills
</label>

<textarea
class="form-control"
rows="4"
name="requirements"
placeholder="HTML, CSS, JavaScript, PHP"
required></textarea>
</div>

<div class="row">

<div class="col-md-6 mb-3">

<label class="form-label">
Application Deadline
</label>

<input
type="date"
class="form-control"
name="deadline"
required>

</div>

<div class="col-md-6 mb-3">

<label class="form-label">
Internship Type
</label>

<select class="form-select form-select-lg" name="type" required>
    <option value="">Select Type</option>
    <option value="On-site">On-site</option>
    <option value="Remote">Remote</option>
    <option value="Hybrid">Hybrid</option>
</select>
</div>

</div>

<div class="d-grid mt-4">

<button
type="submit"
name="post"
class="btn btn-primary btn-lg">

Post Internship

</button>

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

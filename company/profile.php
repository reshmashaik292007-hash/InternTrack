<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Company Profile | InternLink</title>

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
<a class="nav-link" href="post-internship.php">Post Internship</a>
</li>

<li class="nav-item">
<a class="nav-link" href="applicants.php">Applicants</a>
</li>

<li class="nav-item">
<a class="nav-link active" href="#">Profile</a>
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

Company Profile

</h3>

</div>

<div class="card-body">

<div class="text-center mb-4">

<i class="bi bi-building display-1 text-primary"></i>

<h4 class="mt-3">

ABC Technologies Pvt. Ltd.

</h4>

<p class="text-muted">

Software Development Company

</p>

</div>

<form>

<div class="row">

<div class="col-md-6 mb-3">

<label class="form-label">

Company Name

</label>

<input
type="text"
class="form-control"
value="ABC Technologies Pvt. Ltd.">

</div>

<div class="col-md-6 mb-3">

<label class="form-label">

Company Email

</label>

<input
type="email"
class="form-control"
value="hr@abctech.com">

</div>

<div class="col-md-6 mb-3">

<label class="form-label">

Contact Number

</label>

<input
type="tel"
class="form-control"
value="9876543210">

</div>

<div class="col-md-6 mb-3">

<label class="form-label">

Website

</label>

<input
type="url"
class="form-control"
value="https://www.abcteach.com">

</div>

<div class="col-12 mb-3">

<label class="form-label">

Company Address

</label>

<textarea
class="form-control"
rows="4">Hyderabad, Telangana, India</textarea>

</div>
<div class="col-12 mb-3">

<label class="form-label">

Company Description

</label>

<textarea
class="form-control"
rows="5">ABC Technologies Pvt. Ltd. is a software development company specializing in web development, mobile applications, cloud computing, and AI solutions. We provide internship opportunities for students to gain real-world experience.</textarea>

</div>

<div class="col-12">

<div class="d-grid">

<button
type="submit"
class="btn btn-primary btn-lg">

Update Profile

</button>

</div>

</div>

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
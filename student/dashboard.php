<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard | InternLink</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">

<div class="container">

<a class="navbar-brand fw-bold" href="../index.php">

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

<a class="nav-link active" href="#">

Dashboard

</a>

</li>

<li class="nav-item">

<a class="nav-link" href="internships.php">

Internships

</a>

</li>

<li class="nav-item">

<a class="nav-link" href="my-applications.php">

My Applications

</a>

</li>

<li class="nav-item">

<a class="nav-link" href="profile.php">

Profile

</a>

</li>

<li class="nav-item">

<a class="nav-link text-warning" href="login.php">

Logout

</a>

</li>

</ul>

</div>

</div>

</nav>

<section class="py-5">

<div class="container">

<h2 class="fw-bold mb-4">

Welcome, Student 👋

</h2>

<div class="row">

<div class="col-md-4 mb-4">

<div class="card shadow border-0 text-center p-4">

<i class="bi bi-briefcase-fill display-4 text-primary"></i>

<h3 class="mt-3">25</h3>

<p class="mb-0">Available Internships</p>

</div>

</div>

<div class="col-md-4 mb-4">

<div class="card shadow border-0 text-center p-4">

<i class="bi bi-send-fill display-4 text-success"></i>

<h3 class="mt-3">8</h3>

<p class="mb-0">Applications Sent</p>

</div>

</div>

<div class="col-md-4 mb-4">

<div class="card shadow border-0 text-center p-4">

<i class="bi bi-check-circle-fill display-4 text-warning"></i>

<h3 class="mt-3">3</h3>

<p class="mb-0">Shortlisted</p>

</div>

</div>

</div>

<div class="card shadow border-0 mt-4">

<div class="card-header bg-primary text-white">

<h5 class="mb-0">

Latest Internships

</h5>

</div>

<div class="card-body">

<table class="table table-hover">

<thead>

<tr>

<th>Company</th>

<th>Role</th>

<th>Location</th>

<th>Action</th>

</tr>

</thead>

<tbody>

<tr>

<td>Google</td>

<td>Frontend Developer</td>

<td>Hyderabad</td>

<td>

<a href="#" class="btn btn-sm btn-primary">

Apply

</a>

</td>

</tr>

<tr>

<td>Microsoft</td>

<td>Data Analyst</td>

<td>Bengaluru</td>

<td>

<a href="#" class="btn btn-sm btn-primary">

Apply

</a>

</td>

</tr>
<tr>

<td>Amazon</td>

<td>Cloud Engineer</td>

<td>Chennai</td>

<td>

<a href="#" class="btn btn-sm btn-primary">

Apply

</a>

</td>

</tr>

<tr>

<td>Infosys</td>

<td>Python Developer</td>

<td>Hyderabad</td>

<td>

<a href="#" class="btn btn-sm btn-primary">

Apply

</a>

</td>

</tr>

</tbody>

</table>

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
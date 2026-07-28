<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Admin Dashboard | InternLink</title>

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

<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">

<span class="navbar-toggler-icon"></span>

</button>

<div class="collapse navbar-collapse" id="navbarNav">

<ul class="navbar-nav ms-auto">

<li class="nav-item">
<a class="nav-link active" href="#">Dashboard</a>
</li>

<li class="nav-item">
<a class="nav-link" href="students.php">Students</a>
</li>

<li class="nav-item">
<a class="nav-link" href="companies.php">Companies</a>
</li>

<li class="nav-item">
<a class="nav-link" href="internships.php">Internships</a>
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

<h2 class="fw-bold mb-4">

Admin Dashboard

</h2>

<div class="row">

<div class="col-md-3 mb-4">

<div class="card shadow border-0 text-center p-4">

<i class="bi bi-people-fill display-4 text-primary"></i>

<h3 class="mt-3">250</h3>

<p>Total Students</p>

</div>

</div>

<div class="col-md-3 mb-4">

<div class="card shadow border-0 text-center p-4">

<i class="bi bi-building display-4 text-success"></i>

<h3 class="mt-3">40</h3>

<p>Companies</p>

</div>

</div>

<div class="col-md-3 mb-4">

<div class="card shadow border-0 text-center p-4">

<i class="bi bi-briefcase-fill display-4 text-warning"></i>

<h3 class="mt-3">75</h3>

<p>Internships</p>

</div>

</div>

<div class="col-md-3 mb-4">

<div class="card shadow border-0 text-center p-4">

<i class="bi bi-file-earmark-check-fill display-4 text-danger"></i>

<h3 class="mt-3">420</h3>

<p>Applications</p>

</div>

</div>

</div>

<div class="card shadow border-0 mt-4">

<div class="card-header bg-primary text-white">

<h5 class="mb-0">

Recent Activity

</h5>

</div>

<div class="card-body">

<table class="table table-hover">

<thead>

<tr>

<th>Name</th>

<th>Activity</th>

<th>Date</th>

</tr>

</thead>

<tbody>

<tr>

<td>Rahul Sharma</td>

<td>Applied for Frontend Internship</td>

<td>Today</td>

</tr>

<tr>

<td>Google</td>

<td>Posted New Internship</td>

<td>Today</td>

</tr>

<tr>

<td>Priya Reddy</td>

<td>Updated Student Profile</td>

<td>Yesterday</td>

</tr>

<tr>

<td>Infosys</td>

<td>Approved Candidate</td>

<td>Yesterday</td>

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

<script src="../assets/js/script.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Applicants | InternLink</title>

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
<a class="nav-link active" href="#">Applicants</a>
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

<h2 class="fw-bold mb-4">

Internship Applicants

</h2>

<div class="card shadow border-0">

<div class="card-header bg-primary text-white">

<h5 class="mb-0">

Applicants List

</h5>

</div>

<div class="card-body">

<table class="table table-hover align-middle">

<thead class="table-light">

<tr>

<th>Name</th>
<th>Email</th>
<th>Role</th>
<th>Resume</th>
<th>Status</th>

</tr>

</thead>

<tbody>

<tr>

<td>Rahul Sharma</td>

<td>rahul@gmail.com</td>

<td>Frontend Developer</td>

<td>

<a href="#" class="btn btn-sm btn-outline-primary">

View Resume

</a>

</td>

<td>

<span class="badge bg-warning text-dark">

Pending

</span>

</td>

</tr>

<tr>

<td>Priya Reddy</td>

<td>priya@gmail.com</td>

<td>Python Developer</td>

<td>

<a href="#" class="btn btn-sm btn-outline-primary">

View Resume

</a>

</td>

<td>

<span class="badge bg-success">

Shortlisted

</span>

</td>

</tr>
<tr>

<td>Arjun Kumar</td>

<td>arjun@gmail.com</td>

<td>UI/UX Designer</td>

<td>

<a href="#" class="btn btn-sm btn-outline-primary">

View Resume

</a>

</td>

<td>

<span class="badge bg-primary">

Applied

</span>

</td>

</tr>

<tr>

<td>Sneha Patel</td>

<td>sneha@gmail.com</td>

<td>Cloud Engineer</td>

<td>

<a href="#" class="btn btn-sm btn-outline-primary">

View Resume

</a>

</td>

<td>

<span class="badge bg-danger">

Rejected

</span>

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
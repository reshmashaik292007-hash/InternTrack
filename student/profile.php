<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>My Applications | InternLink</title>

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
<a class="nav-link" href="internships.php">Internships</a>
</li>

<li class="nav-item">
<a class="nav-link active" href="#">My Applications</a>
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

My Internship Applications

</h2>

<div class="card shadow border-0">

<div class="card-body">

<table class="table table-hover align-middle">

<thead class="table-primary">

<tr>

<th>Company</th>

<th>Role</th>

<th>Location</th>

<th>Status</th>

<th>Date</th>

</tr>

</thead>

<tbody>

<tr>

<td>Google</td>

<td>Frontend Developer</td>

<td>Hyderabad</td>

<td>

<span class="badge bg-success">

Shortlisted

</span>

</td>

<td>20 Jul 2026</td>

</tr>

<tr>

<td>Microsoft</td>

<td>Data Analyst</td>

<td>Bengaluru</td>

<td>

<span class="badge bg-warning text-dark">

Under Review

</span>

</td>

<td>18 Jul 2026</td>

</tr>

<tr>

<td>Amazon</td>

<td>Cloud Engineer</td>

<td>Chennai</td>

<td>

<span class="badge bg-primary">

Applied

</span>

</td>

<td>16 Jul 2026</td>

</tr>

<tr>

<td>Infosys</td>

<td>Python Developer</td>

<td>Hyderabad</td>

<td>

<span class="badge bg-danger">

Rejected

</span>

</td>

<td>10 Jul 2026</td>

</tr>

</tbody>

</table>

<div class="text-center mt-4">

<a href="internships.php" class="btn btn-primary">

Apply for More Internships

</a>

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
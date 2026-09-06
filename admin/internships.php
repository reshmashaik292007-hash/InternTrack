<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Manage Internships | InternLink</title>

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
<a class="nav-link" href="dashboard.php">Dashboard</a>
</li>

<li class="nav-item">
<a class="nav-link" href="students.php">Students</a>
</li>

<li class="nav-item">
<a class="nav-link" href="companies.php">Companies</a>
</li>

<li class="nav-item">
<a class="nav-link active" href="#">Internships</a>
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

Manage Internships

</h2>

<div class="card shadow border-0">

<div class="card-body">

<table class="table table-hover align-middle">

<thead class="table-primary">

<tr>

<th>ID</th>
<th>Internship</th>
<th>Company</th>
<th>Location</th>
<th>Duration</th>
<th>Status</th>

</tr>

</thead>

<tbody>

<tr>
<td>301</td>
<td>PHP Developer Intern</td>
<td>Tech Solutions</td>
<td>Hyderabad</td>
<td>3 Months</td>
<td><span class="badge bg-success">Open</span></td>
</tr>

<tr>
<td>302</td>
<td>Frontend Developer Intern</td>
<td>Google</td>
<td>Bangalore</td>
<td>6 Months</td>
<td><span class="badge bg-success">Open</span></td>
</tr>

<tr>
<td>303</td>
<td>Python Developer Intern</td>
<td>Infosys</td>
<td>Pune</td>
<td>4 Months</td>
<td><span class="badge bg-warning text-dark">Closing Soon</span></td>
</tr>

<tr>
<td>304</td>
<td>Java Full Stack Intern</td>
<td>TCS</td>
<td>Chennai</td>
<td>6 Months</td>
<td><span class="badge bg-danger">Closed</span></td>
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
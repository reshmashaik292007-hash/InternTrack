<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Manage Students | InternLink</title>

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
<a class="nav-link active" href="#">Students</a>
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

Manage Students

</h2>

<div class="card shadow border-0">

<div class="card-body">

<table class="table table-hover align-middle">

<thead class="table-primary">

<tr>

<th>ID</th>
<th>Name</th>
<th>Email</th>
<th>College</th>
<th>Status</th>

</tr>

</thead>

<tbody>

<tr>

<td>101</td>
<td>Rahul Sharma</td>
<td>rahul@gmail.com</td>
<td>ABC Engineering College</td>

<td>

<span class="badge bg-success">

Active

</span>

</td>

</tr>

<tr>

<td>102</td>
<td>Priya Reddy</td>
<td>priya@gmail.com</td>
<td>XYZ Engineering College</td>

<td>

<span class="badge bg-success">

Active

</span>

</td>

</tr>

<tr>

<td>103</td>
<td>Arjun Kumar</td>
<td>arjun@gmail.com</td>
<td>SRKR Engineering College</td>

<td>

<span class="badge bg-warning text-dark">

Pending

</span>

</td>

</tr>

<tr>

<td>104</td>
<td>Sneha Patel</td>
<td>sneha@gmail.com</td>
<td>GVP College</td>

<td>

<span class="badge bg-danger">

Blocked

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

<script src="../assets/js/script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
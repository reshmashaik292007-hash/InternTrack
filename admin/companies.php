<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Manage Companies | InternLink</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="../assets/css/style.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>

<body>

<?php
session_start();
include("../config/db.php");

if(!isset($_SESSION['admin_id']))
{
    header("Location: login.php");
    exit();
}

// FIXED: Get all companies from database
$stmt = mysqli_prepare($conn, "
    SELECT
        c.company_id,
        c.company_name,
        u.email,
        c.location,
        u.status,
        c.is_verified
    FROM companies c
    JOIN users u ON c.user_id = u.user_id
    ORDER BY c.company_id DESC
");
mysqli_stmt_execute($stmt);
$companies_result = mysqli_stmt_get_result($stmt);
$total_companies = mysqli_num_rows($companies_result);
?>

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
<a class="nav-link active" href="#">Companies</a>
</li>

<li class="nav-item">
<a class="nav-link" href="internships.php">Internships</a>
</li>

<li class="nav-item">
<a class="nav-link" href="applications.php">Applications</a>
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

Manage Companies

</h2>

<div class="card shadow border-0">

<div class="card-body">

<table class="table table-hover align-middle">

<thead class="table-primary">

<tr>

<th>ID</th>
<th>Company</th>
<th>Email</th>
<th>Location</th>
<th>Verified</th>
<th>Status</th>

</tr>

</thead>

<tbody>

<?php

if ($total_companies > 0) {

    while ($company = mysqli_fetch_assoc($companies_result)) {
?>

<tr>

<td><?php echo htmlspecialchars($company['company_id']); ?></td>
<td><?php echo htmlspecialchars($company['company_name']); ?></td>
<td><?php echo htmlspecialchars($company['email']); ?></td>
<td><?php echo htmlspecialchars($company['location'] ?? 'N/A'); ?></td>

<td>

<?php
$is_verified = $company['is_verified'];
echo ($is_verified == 1) ? '<span class="badge bg-success">Verified</span>' : '<span class="badge bg-warning text-dark">Pending</span>';
?>

</td>

<td>

<?php

$status = htmlspecialchars($company['status']);

if ($status == 'active') {
    echo '<span class="badge bg-success">Active</span>';
} elseif ($status == 'pending') {
    echo '<span class="badge bg-warning text-dark">Pending</span>';
} else {
    echo '<span class="badge bg-danger">Blocked</span>';
}

?>

</td>

</tr>

<?php
    }

} else {
?>

<tr>
<td colspan="6" class="text-center text-muted py-4">
No companies registered yet
</td>
</tr>

<?php
}

?>

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

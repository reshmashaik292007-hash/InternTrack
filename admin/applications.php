<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Manage Applications | InternLink</title>

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

// FIXED: Get all applications from database
$stmt = mysqli_prepare($conn, "
    SELECT
        a.application_id,
        s.full_name as student_name,
        u.email as student_email,
        i.title as internship_title,
        c.company_name,
        a.status,
        a.applied_at
    FROM applications a
    JOIN students s ON a.student_id = s.student_id
    JOIN users u ON s.user_id = u.user_id
    JOIN internships i ON a.internship_id = i.internship_id
    JOIN companies c ON i.company_id = c.company_id
    ORDER BY a.applied_at DESC
");
mysqli_stmt_execute($stmt);
$applications_result = mysqli_stmt_get_result($stmt);
$total_applications = mysqli_num_rows($applications_result);
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
<a class="nav-link" href="companies.php">Companies</a>
</li>

<li class="nav-item">
<a class="nav-link" href="internships.php">Internships</a>
</li>

<li class="nav-item">
<a class="nav-link active" href="#">Applications</a>
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

Manage Applications

</h2>

<div class="card shadow border-0">

<div class="card-body">

<div class="table-responsive">

<table class="table table-hover align-middle">

<thead class="table-primary">

<tr>

<th>ID</th>
<th>Student</th>
<th>Email</th>
<th>Company</th>
<th>Internship</th>
<th>Status</th>
<th>Applied On</th>

</tr>

</thead>

<tbody>

<?php

if ($total_applications > 0) {

    while ($application = mysqli_fetch_assoc($applications_result)) {
?>

<tr>
<td><?php echo htmlspecialchars($application['application_id']); ?></td>
<td><?php echo htmlspecialchars($application['student_name']); ?></td>
<td><?php echo htmlspecialchars($application['student_email']); ?></td>
<td><?php echo htmlspecialchars($application['company_name']); ?></td>
<td><?php echo htmlspecialchars($application['internship_title']); ?></td>

<td>

<?php

$status = htmlspecialchars($application['status']);

if ($status == 'shortlisted') {
    echo '<span class="badge bg-success">Shortlisted</span>';
} elseif ($status == 'accepted') {
    echo '<span class="badge bg-primary">Accepted</span>';
} elseif ($status == 'rejected') {
    echo '<span class="badge bg-danger">Rejected</span>';
} else {
    echo '<span class="badge bg-warning text-dark">Applied</span>';
}

?>

</td>

<td><?php echo date("d M Y", strtotime($application['applied_at'])); ?></td>

</tr>

<?php
    }

} else {
?>

<tr>
<td colspan="7" class="text-center text-muted py-4">
No applications submitted yet
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

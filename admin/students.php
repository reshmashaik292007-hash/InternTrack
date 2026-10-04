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

<?php
session_start();
include("../config/db.php");

if(!isset($_SESSION['admin_id']))
{
    header("Location: login.php");
    exit();
}

// FIXED: Get all students from database
$stmt = mysqli_prepare($conn, "
    SELECT
        s.student_id,
        s.full_name,
        u.email,
        s.college_name,
        u.status
    FROM students s
    JOIN users u ON s.user_id = u.user_id
    ORDER BY s.student_id DESC
");
mysqli_stmt_execute($stmt);
$students_result = mysqli_stmt_get_result($stmt);
$total_students = mysqli_num_rows($students_result);
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
<a class="nav-link active" href="#">Students</a>
</li>

<li class="nav-item">
<a class="nav-link" href="companies.php">Companies</a>
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

<?php

if ($total_students > 0) {

    while ($student = mysqli_fetch_assoc($students_result)) {
?>

<tr>

<td><?php echo htmlspecialchars($student['student_id']); ?></td>
<td><?php echo htmlspecialchars($student['full_name']); ?></td>
<td><?php echo htmlspecialchars($student['email']); ?></td>
<td><?php echo htmlspecialchars($student['college_name']); ?></td>

<td>

<?php

$status = htmlspecialchars($student['status']);

if ($status == 'active') {
    echo '<span class="badge bg-success">Active</span>';
} elseif ($status == 'pending') {
    echo '<span class="badge bg-warning text-dark">Pending</span>';
} else {
    echo '<span class="badge bg-danger">Inactive</span>';
}

?>

</td>

</tr>

<?php
    }

} else {
?>

<tr>
<td colspan="5" class="text-center text-muted py-4">
No students registered yet
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

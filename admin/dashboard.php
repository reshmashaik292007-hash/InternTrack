<?php
session_start();
include("../config/db.php");

if(!isset($_SESSION['admin_id']))
{
    header("Location: login.php");
    exit();
}

// Counts
$totalStudents = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM students"));

$totalCompanies = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM companies"));

$totalInternships = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM internships"));

$totalApplications = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM applications"));

// Recent Applications
$recent = mysqli_query($conn,"
SELECT
s.full_name,
i.title,
a.applied_at
FROM applications a
JOIN students s
ON a.student_id=s.student_id
JOIN internships i
ON a.internship_id=i.internship_id
ORDER BY a.applied_at DESC
LIMIT 5
");
?>
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

<h3 class="mt-3"><?php echo $totalStudents; ?></h3>

<p>Total Students</p>

</div>

</div>

<div class="col-md-3 mb-4">

<div class="card shadow border-0 text-center p-4">

<i class="bi bi-building display-4 text-success"></i>

<h3 class="mt-3"><?php echo $totalCompanies; ?></h3>

<p>Companies</p>

</div>

</div>

<div class="col-md-3 mb-4">

<div class="card shadow border-0 text-center p-4">

<i class="bi bi-briefcase-fill display-4 text-warning"></i>

<h3 class="mt-3"><?php echo $totalInternships; ?></h3>

<p>Internships</p>

</div>

</div>

<div class="col-md-3 mb-4">

<div class="card shadow border-0 text-center p-4">

<i class="bi bi-file-earmark-check-fill display-4 text-danger"></i>

<h3 class="mt-3"><?php echo $totalApplications; ?></h3>

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

<?php
if(mysqli_num_rows($recent)>0)
{
    while($row=mysqli_fetch_assoc($recent))
    {
?>
<tr>

<td><?php echo $row['full_name']; ?></td>

<td>
Applied for
<?php echo $row['title']; ?>
</td>

<td>
<?php echo date("d M Y",strtotime($row['applied_at'])); ?>
</td>

</tr>

<?php
    }
}
else
{
?>
<tr>
<td colspan="3" class="text-center">
No Recent Activity
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
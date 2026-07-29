<?php
session_start();
include("../config/db.php");

if(!isset($_SESSION['student_id']))
{
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['student_id'];

$student = mysqli_query($conn,"SELECT student_id FROM students WHERE user_id='$user_id'");
$studentData = mysqli_fetch_assoc($student);
$student_id = $studentData['student_id'];

$sql = "SELECT
            c.company_name,
            i.title,
            i.location_type,
            a.status,
            a.applied_at
        FROM applications a
        JOIN internships i ON a.internship_id = i.internship_id
        JOIN companies c ON i.company_id = c.company_id
        WHERE a.student_id='$student_id'
        ORDER BY a.applied_at DESC";

$result = mysqli_query($conn,$sql);
?>

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
<th>Applied Date</th>

</tr>

</thead>

<tbody>

<?php
if(mysqli_num_rows($result)>0)
{
    while($row=mysqli_fetch_assoc($result))
    {
        if($row['status']=="applied")
            $badge="primary";
        elseif($row['status']=="shortlisted")
            $badge="success";
        elseif($row['status']=="accepted")
            $badge="success";
        elseif($row['status']=="rejected")
            $badge="danger";
        else
            $badge="warning";
?>

<tr>

<td><?php echo $row['company_name']; ?></td>

<td><?php echo $row['title']; ?></td>

<td><?php echo $row['location_type']; ?></td>

<td>

<span class="badge bg-<?php echo $badge; ?>">

<?php echo ucfirst($row['status']); ?>

</span>

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

<td colspan="5" class="text-center">

No Applications Yet

</td>

</tr>

<?php
}
?>

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
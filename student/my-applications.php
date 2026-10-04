<?php
session_start();
include("../config/db.php");

if (!isset($_SESSION['student_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['student_id'];

/* FIXED: Get student ID from user */
$stmt = mysqli_prepare($conn, "SELECT student_id FROM students WHERE user_id = ?");
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$student = mysqli_fetch_assoc($result);
$student_id = $student['student_id'];

/* FIXED: Get student's applications */
$stmt = mysqli_prepare($conn, "
    SELECT
        i.internship_id,
        i.title,
        c.company_name,
        i.location_type,
        i.stipend,
        a.status,
        a.applied_at
    FROM applications a
    JOIN internships i ON a.internship_id = i.internship_id
    JOIN companies c ON i.company_id = c.company_id
    WHERE a.student_id = ?
    ORDER BY a.applied_at DESC
");
mysqli_stmt_bind_param($stmt, "i", $student_id);
mysqli_stmt_execute($stmt);
$applications_query = mysqli_stmt_get_result($stmt);
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>My Applications | InternLink</title>

<link
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet">

<link
rel="stylesheet"
href="../assets/css/style.css">

<link
rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>

<body>


<!-- Navbar -->

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">

<div class="container">

<a
class="navbar-brand fw-bold"
href="../index.php">

InternLink

</a>

<button class="navbar-toggler"
type="button"
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
<a class="nav-link active" href="my-applications.php">My Applications</a>
</li>

<li class="nav-item">
<a class="nav-link" href="profile.php">Profile</a>
</li>

<li class="nav-item">
<a class="nav-link text-warning" href="logout.php">Logout</a>
</li>

</ul>

</div>

</div>

</nav>


<!-- My Applications -->

<section class="py-5">

<div class="container">

<h2 class="fw-bold mb-4">

My Applications

</h2>


<div class="card shadow border-0">

<div class="card-header bg-primary text-white">

<h5 class="mb-0">

Application Status

</h5>

</div>


<div class="card-body">

<div class="table-responsive">

<table class="table table-hover align-middle">

<thead class="table-light">

<tr>

<th>Company</th>

<th>Internship</th>

<th>Location</th>

<th>Stipend</th>

<th>Status</th>

<th>Applied On</th>

</tr>

</thead>


<tbody>


<?php

if (mysqli_num_rows($applications_query) > 0) {

    while ($application = mysqli_fetch_assoc($applications_query)) {

?>

<tr>

<td>

<?php
echo htmlspecialchars($application['company_name']);
?>

</td>

<td>

<?php
echo htmlspecialchars($application['title']);
?>

</td>

<td>

<?php
echo htmlspecialchars($application['location_type']);
?>

</td>

<td>

<?php
echo htmlspecialchars($application['stipend']);
?>

</td>

<td>

<?php

$status = $application['status'];

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

<td>

<?php
echo date("d M Y", strtotime($application['applied_at']));
?>

</td>

</tr>


<?php

    }

} else {

?>

<tr>

<td
colspan="6"
class="text-center text-muted py-4">

No applications yet. <a href="internships.php">Browse internships</a>

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


<!-- Footer -->

<footer class="bg-dark text-white text-center py-4">

<div class="container">

<p class="mb-0">

© 2026 InternLink | All Rights Reserved

</p>

</div>

</footer>


</body>

</html>

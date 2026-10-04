<?php
session_start();
include("../config/db.php");

if (!isset($_SESSION['student_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['student_id'];

// FIXED: Get student name
$stmt = mysqli_prepare($conn, "SELECT full_name FROM students WHERE user_id = ?");
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$student_data = mysqli_fetch_assoc($result);
$student_name = $student_data['full_name'] ?? 'Student';

// FIXED: Get student ID
$stmt = mysqli_prepare($conn, "SELECT student_id FROM students WHERE user_id = ?");
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$student_row = mysqli_fetch_assoc($result);
$student_id = $student_row['student_id'];

// FIXED: Count available internships (is_active = 1)
$stmt = mysqli_prepare($conn, "SELECT COUNT(*) as count FROM internships WHERE is_active = 1");
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$total_internships = mysqli_fetch_assoc($result)['count'];

// FIXED: Count student's applications
$stmt = mysqli_prepare($conn, "SELECT COUNT(*) as count FROM applications WHERE student_id = ?");
mysqli_stmt_bind_param($stmt, "i", $student_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$total_applications = mysqli_fetch_assoc($result)['count'];

// FIXED: Count student's shortlisted applications
$stmt = mysqli_prepare($conn, "SELECT COUNT(*) as count FROM applications WHERE student_id = ? AND status = 'shortlisted'");
mysqli_stmt_bind_param($stmt, "i", $student_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$total_shortlisted = mysqli_fetch_assoc($result)['count'];

// FIXED: Get latest internships
$stmt = mysqli_prepare($conn, "
    SELECT i.internship_id, i.title, c.company_name, i.location_type
    FROM internships i
    JOIN companies c ON i.company_id = c.company_id
    WHERE i.is_active = 1
    ORDER BY i.created_at DESC
    LIMIT 5
");
mysqli_stmt_execute($stmt);
$latest_internships = mysqli_stmt_get_result($stmt);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard | InternLink</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">

<div class="container">

<a class="navbar-brand fw-bold" href="../index.php">

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

<a class="nav-link active" href="#">

Dashboard

</a>

</li>

<li class="nav-item">

<a class="nav-link" href="internships.php">

Internships

</a>

</li>

<li class="nav-item">

<a class="nav-link" href="my-applications.php">

My Applications

</a>

</li>

<li class="nav-item">

<a class="nav-link" href="profile.php">

Profile

</a>

</li>

<li class="nav-item">

<a class="nav-link text-warning" href="logout.php">

Logout

</a>

</li>

</ul>

</div>

</div>

</nav>

<section class="py-5">

<div class="container">

<h2 class="fw-bold mb-4">

Welcome, <?php echo htmlspecialchars($student_name); ?> 👋

</h2>

<div class="row">

<div class="col-md-4 mb-4">

<div class="card shadow border-0 text-center p-4">

<i class="bi bi-briefcase-fill display-4 text-primary"></i>

<h3 class="mt-3"><?php echo $total_internships; ?></h3>

<p class="mb-0">Available Internships</p>

</div>

</div>

<div class="col-md-4 mb-4">

<div class="card shadow border-0 text-center p-4">

<i class="bi bi-send-fill display-4 text-success"></i>

<h3 class="mt-3"><?php echo $total_applications; ?></h3>

<p class="mb-0">Applications Sent</p>

</div>

</div>

<div class="col-md-4 mb-4">

<div class="card shadow border-0 text-center p-4">

<i class="bi bi-check-circle-fill display-4 text-warning"></i>

<h3 class="mt-3"><?php echo $total_shortlisted; ?></h3>

<p class="mb-0">Shortlisted</p>

</div>

</div>

</div>

<div class="card shadow border-0 mt-4">

<div class="card-header bg-primary text-white">

<h5 class="mb-0">

Latest Internships

</h5>

</div>

<div class="card-body">

<table class="table table-hover">

<thead>

<tr>

<th>Company</th>

<th>Role</th>

<th>Location</th>

<th>Action</th>

</tr>

</thead>

<tbody>

<?php
if ($latest_internships && mysqli_num_rows($latest_internships) > 0) {
    while ($internship = mysqli_fetch_assoc($latest_internships)) {
?>

<tr>

<td><?php echo htmlspecialchars($internship['company_name']); ?></td>

<td><?php echo htmlspecialchars($internship['title']); ?></td>

<td><?php echo htmlspecialchars($internship['location_type']); ?></td>

<td>

<a href="apply.php?id=<?php echo $internship['internship_id']; ?>" class="btn btn-sm btn-primary">

Apply

</a>

</td>

</tr>

<?php
    }
} else {
?>
<tr>
    <td colspan="4" class="text-center text-muted py-4">No internships available.</td>
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

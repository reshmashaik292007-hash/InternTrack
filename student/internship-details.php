<?php
session_start();
include("../config/db.php");

// Check if internship ID is provided
if(!isset($_GET['id']) || empty($_GET['id'])) {
    die("Internship ID is required");
}

$internship_id = (int)$_GET['id'];

// Get internship details from database
$stmt = mysqli_prepare($conn, "
    SELECT i.*, c.company_name, c.logo, cat.category_name
    FROM internships i
    JOIN companies c ON i.company_id = c.company_id
    JOIN categories cat ON i.category_id = cat.category_id
    WHERE i.internship_id = ?
");
mysqli_stmt_bind_param($stmt, "i", $internship_id);
mysqli_stmt_execute($stmt);
$internship_result = mysqli_stmt_get_result($stmt);
$internship = mysqli_fetch_assoc($internship_result);

if(!$internship) {
    die("Internship not found");
}

// Check if student is logged in and has already applied
$has_applied = false;
if(isset($_SESSION['student_id'])) {
    $user_id = $_SESSION['student_id'];
    $stmt = mysqli_prepare($conn, "SELECT student_id FROM students WHERE user_id = ?");
    mysqli_stmt_bind_param($stmt, "i", $user_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $student = mysqli_fetch_assoc($result);

    if($student) {
        $stmt = mysqli_prepare($conn, "SELECT application_id FROM applications WHERE internship_id = ? AND student_id = ?");
        mysqli_stmt_bind_param($stmt, "ii", $internship_id, $student['student_id']);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        $has_applied = mysqli_stmt_num_rows($stmt) > 0;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo htmlspecialchars($internship['title']); ?> | InternLink</title>

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

<?php if(isset($_SESSION['student_id'])): ?>
<li class="nav-item">
<a class="nav-link" href="dashboard.php">Dashboard</a>
</li>

<li class="nav-item">
<a class="nav-link" href="internships.php">Internships</a>
</li>

<li class="nav-item">
<a class="nav-link" href="my-applications.php">My Applications</a>
</li>

<li class="nav-item">
<a class="nav-link" href="profile.php">Profile</a>
</li>

<li class="nav-item">
<a class="nav-link text-warning" href="logout.php">Logout</a>
</li>
<?php else: ?>
<li class="nav-item">
<a class="nav-link" href="login.php">Login</a>
</li>
<?php endif; ?>

</ul>

</div>

</div>
</nav>

<section class="py-5">

<div class="container">

<div class="card shadow border-0">

<div class="card-body">

<h2 class="fw-bold text-primary">
<?php echo htmlspecialchars($internship['title']); ?>
</h2>

<h5 class="mb-3">
<i class="bi bi-building"></i> <?php echo htmlspecialchars($internship['company_name']); ?>
</h5>

<hr>

<p><strong><i class="bi bi-geo-alt-fill text-danger"></i> Location:</strong> <?php echo htmlspecialchars($internship['location_type']); ?></p>

<p><strong><i class="bi bi-clock text-info"></i> Duration:</strong> <?php echo htmlspecialchars($internship['duration']); ?></p>

<p><strong><i class="bi bi-cash-coin text-success"></i> Stipend:</strong> <?php echo htmlspecialchars($internship['stipend']); ?></p>

<p><strong><i class="bi bi-bookmark text-warning"></i> Category:</strong> <?php echo htmlspecialchars($internship['category_name']); ?></p>

<p><strong><i class="bi bi-calendar-event text-secondary"></i> Deadline:</strong> <?php echo date('d F Y', strtotime($internship['deadline'])); ?></p>

<h4 class="mt-4">
<i class="bi bi-file-text"></i> Job Description
</h4>

<p>
<?php echo nl2br(htmlspecialchars($internship['description'])); ?>
</p>

<?php if(!empty($internship['requirements'])): ?>
<h4 class="mt-4">
<i class="bi bi-check-circle"></i> Requirements
</h4>

<p>
<?php echo nl2br(htmlspecialchars($internship['requirements'])); ?>
</p>
<?php endif; ?>

<div class="mt-4">

<?php if(isset($_SESSION['student_id'])): ?>
    <?php if($has_applied): ?>
    <button class="btn btn-success" disabled>
        <i class="bi bi-check-circle"></i> Already Applied
    </button>
    <?php else: ?>
    <a href="apply.php?id=<?php echo $internship_id; ?>" class="btn btn-primary">
        <i class="bi bi-send"></i> Apply Now
    </a>
    <?php endif; ?>
<?php else: ?>
<a href="login.php?redirect=internship-details.php?id=<?php echo $internship_id; ?>" class="btn btn-primary">
    <i class="bi bi-send"></i> Login to Apply
</a>
<?php endif; ?>

<a href="internships.php" class="btn btn-outline-secondary">
Back
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
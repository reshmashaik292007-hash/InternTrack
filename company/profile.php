<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Company Profile | InternLink</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="../assets/css/style.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>

<body>

<?php
session_start();
include("../config/db.php");

if(!isset($_SESSION['company_id']))
{
    header("Location: login.php");
    exit();
}

// FIXED: Get company profile from database
$user_id = $_SESSION['company_id'];

$stmt = mysqli_prepare($conn, "
    SELECT
        c.company_id,
        c.company_name,
        u.email,
        c.website,
        c.description,
        c.location,
        c.is_verified
    FROM companies c
    JOIN users u ON c.user_id = u.user_id
    WHERE c.user_id = ?
");
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$company = mysqli_fetch_assoc($result);

if (!$company) {
    die("Company profile not found.");
}

$message = "";
$message_type = "";

// Handle profile update
if (isset($_POST['update_profile'])) {
    $company_name = trim($_POST['company_name']);
    $website = trim($_POST['website']);
    $description = trim($_POST['description']);
    $location = trim($_POST['location']);

    // FIXED: Update company profile using prepared statement
    $stmt = mysqli_prepare($conn, "
        UPDATE companies
        SET company_name = ?, website = ?, description = ?, location = ?
        WHERE user_id = ?
    ");
    mysqli_stmt_bind_param($stmt, "ssssi", $company_name, $website, $description, $location, $user_id);

    if (mysqli_stmt_execute($stmt)) {
        $company['company_name'] = $company_name;
        $company['website'] = $website;
        $company['description'] = $description;
        $company['location'] = $location;
        $message = "Profile updated successfully!";
        $message_type = "success";
    } else {
        $message = "Error updating profile: " . mysqli_error($conn);
        $message_type = "danger";
    }
}
?>

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
<a class="nav-link" href="post-internship.php">Post Internship</a>
</li>

<li class="nav-item">
<a class="nav-link" href="appllicants.php">Applicants</a>
</li>

<li class="nav-item">
<a class="nav-link active" href="#">Profile</a>
</li>

<li class="nav-item">
<a class="nav-link text-warning" href="logout.php">Logout</a>
</li>

</ul>

</div>

</div>

</nav>

<section class="py-5">

<div class="container">

<div class="row justify-content-center">

<div class="col-lg-8">

<div class="card shadow border-0">

<div class="card-header bg-primary text-white">

<h3 class="mb-0">

Company Profile

</h3>

</div>

<div class="card-body">

<div class="text-center mb-4">

<i class="bi bi-building display-1 text-primary"></i>

<h4 class="mt-3">

<?php echo htmlspecialchars($company['company_name']); ?>

</h4>

<?php
if ($company['is_verified']) {
    echo '<p class="text-success"><i class="bi bi-check-circle-fill"></i> Verified Company</p>';
} else {
    echo '<p class="text-warning"><i class="bi bi-clock-fill"></i> Pending Verification</p>';
}
?>

</div>

<?php
if ($message != "") {
    echo '<div class="alert alert-' . $message_type . ' py-2 mb-3">' . htmlspecialchars($message) . '</div>';
}
?>

<form method="POST">

<div class="row">

<div class="col-md-6 mb-3">

<label class="form-label">

Company Name

</label>

<input
type="text"
class="form-control"
name="company_name"
value="<?php echo htmlspecialchars($company['company_name']); ?>"
required>

</div>

<div class="col-md-6 mb-3">

<label class="form-label">

Company Email

</label>

<input
type="email"
class="form-control"
value="<?php echo htmlspecialchars($company['email']); ?>"
disabled>

</div>

<div class="col-md-6 mb-3">

<label class="form-label">

Website

</label>

<input
type="url"
class="form-control"
name="website"
value="<?php echo htmlspecialchars($company['website'] ?? ''); ?>">

</div>

<div class="col-md-6 mb-3">

<label class="form-label">

Location

</label>

<input
type="text"
class="form-control"
name="location"
value="<?php echo htmlspecialchars($company['location'] ?? ''); ?>">

</div>

<div class="col-12 mb-3">

<label class="form-label">

Company Description

</label>

<textarea
class="form-control"
name="description"
rows="5"><?php echo htmlspecialchars($company['description'] ?? ''); ?></textarea>

</div>

<div class="col-12">

<div class="d-grid">

<button
type="submit"
name="update_profile"
class="btn btn-primary btn-lg">

Update Profile

</button>

</div>

</div>

</div>

</form>

</div>

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

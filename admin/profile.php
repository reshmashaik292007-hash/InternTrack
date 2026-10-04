<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Admin Profile | InternLink</title>

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

// FIXED: Get admin profile from database
$user_id = $_SESSION['admin_id'];

$stmt = mysqli_prepare($conn, "
    SELECT
        a.admin_id,
        a.full_name,
        u.email,
        u.status,
        u.last_login
    FROM admins a
    JOIN users u ON a.user_id = u.user_id
    WHERE a.user_id = ?
");
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$admin = mysqli_fetch_assoc($result);

if (!$admin) {
    die("Admin profile not found.");
}
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
<a class="nav-link" href="applications.php">Applications</a>
</li>

<li class="nav-item">
<a class="nav-link active" href="#">Profile</a>
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

<div class="row justify-content-center">

<div class="col-lg-6">

<div class="card shadow border-0">

<div class="card-body text-center">

<i class="bi bi-person-circle display-1 text-primary"></i>

<h2 class="mt-3"><?php echo htmlspecialchars($admin['full_name']); ?></h2>

<p class="text-muted">System Administrator</p>

<hr>

<div class="text-start">

<p><strong>Name:</strong> <?php echo htmlspecialchars($admin['full_name']); ?></p>

<p><strong>Email:</strong> <?php echo htmlspecialchars($admin['email']); ?></p>

<p><strong>Role:</strong> Super Admin</p>

<p><strong>Status:</strong>
<?php
$status = htmlspecialchars($admin['status']);
if ($status == 'active') {
    echo '<span class="badge bg-success">Active</span>';
} else {
    echo '<span class="badge bg-warning">Inactive</span>';
}
?>
</p>

<p><strong>Last Login:</strong> <?php echo $admin['last_login'] ? date("d M Y H:i", strtotime($admin['last_login'])) : 'Never'; ?></p>

</div>

<button class="btn btn-primary mt-3">

Edit Profile

</button>

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

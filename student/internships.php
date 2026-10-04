<?php
session_start();
include("../config/db.php");
if(!isset($_SESSION['student_id'])){
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['student_id'];

// Get student name
$stmt = mysqli_prepare($conn, "SELECT full_name FROM students WHERE user_id = ?");
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$student = mysqli_fetch_assoc($result);
$student_name = $student['full_name'] ?? 'Student';

// Get internships
$search_title = "";
if(($_SERVER['REQUEST_METHOD'] ?? '') === 'POST') {
    $search_title = trim($_POST['search'] ?? '');
}

if(!empty($search_title)) {
    $stmt = mysqli_prepare($conn, "SELECT i.internship_id,i.title,i.stipend,i.duration,i.location_type,c.company_name
        FROM internships i
        JOIN companies c ON i.company_id=c.company_id
        WHERE i.is_active=1 AND (i.title LIKE ? OR c.company_name LIKE ?)
        ORDER BY i.internship_id DESC");
    $search_pattern = "%" . $search_title . "%";
    mysqli_stmt_bind_param($stmt, "ss", $search_pattern, $search_pattern);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
} else {
    $result = mysqli_query($conn, "SELECT i.internship_id,i.title,i.stipend,i.duration,i.location_type,c.company_name
        FROM internships i
        JOIN companies c ON i.company_id=c.company_id
        WHERE i.is_active=1
        ORDER BY i.internship_id DESC");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Internships</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand fw-bold" href="../index.php">InternLink</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="dashboard.php">Dashboard</a></li>
                <li class="nav-item"><a class="nav-link active" href="internships.php">Internships</a></li>
                <li class="nav-item"><a class="nav-link" href="my-applications.php">My Applications</a></li>
                <li class="nav-item"><a class="nav-link" href="profile.php">Profile</a></li>
                <li class="nav-item"><a class="nav-link text-warning" href="logout.php">Logout</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container py-5">
    <h2 class="fw-bold mb-4">Available Internships</h2>

    <!-- Search Form -->
    <form method="POST" class="mb-4">
        <div class="row g-3">
            <div class="col-md-10">
                <input type="text" name="search" class="form-control" placeholder="Search by title or company..." value="<?php echo htmlspecialchars($search_title); ?>">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">Search</button>
            </div>
        </div>
        <?php if(!empty($search_title)): ?>
        <div class="mt-2">
            <a href="internships.php" class="btn btn-sm btn-secondary">Clear Search</a>
        </div>
        <?php endif; ?>
    </form>

    <div class="row">
    <?php if(mysqli_num_rows($result) > 0): ?>
        <?php while($row=mysqli_fetch_assoc($result)){ ?>
        <div class="col-lg-4 mb-4">
            <div class="card shadow h-100">
                <div class="card-body">
                    <h4><?php echo htmlspecialchars($row['title']); ?></h4>
                    <h6 class="text-primary"><?php echo htmlspecialchars($row['company_name']); ?></h6>
                    <p>📍 <?php echo htmlspecialchars($row['location_type']); ?></p>
                    <p>💰 <?php echo htmlspecialchars($row['stipend']); ?></p>
                    <p>⏳ <?php echo htmlspecialchars($row['duration']); ?></p>
                    <a href="internship-details.php?id=<?php echo $row['internship_id']; ?>" class="btn btn-outline-primary w-100 mb-2">View Details</a>
                    <a href="apply.php?id=<?php echo $row['internship_id']; ?>" class="btn btn-primary w-100">Apply Now</a>
                </div>
            </div>
        </div>
        <?php } ?>
    <?php else: ?>
        <div class="col-12 text-center py-5">
            <p class="text-muted fs-5">No internships available.</p>
            <?php if(!empty($search_title)): ?>
                <a href="internships.php" class="btn btn-primary">View All Internships</a>
            <?php endif; ?>
        </div>
    <?php endif; ?>
    </div>
</div>

<footer class="bg-dark text-white text-center py-4">
    <div class="container">
        <p class="mb-0">© 2026 InternLink | All Rights Reserved</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
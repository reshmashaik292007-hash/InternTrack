<?php
include("config/db.php");

// Get real statistics from database
$stats = [
    'companies' => 0,
    'students' => 0,
    'internships' => 0,
    'applications' => 0
];

$result = mysqli_query($conn, "SELECT COUNT(*) as cnt FROM companies");
if ($result) {
    $row = mysqli_fetch_assoc($result);
    $stats['companies'] = (int)($row['cnt'] ?? 0);
    mysqli_free_result($result);
}

$result = mysqli_query($conn, "SELECT COUNT(*) as cnt FROM students");
if ($result) {
    $row = mysqli_fetch_assoc($result);
    $stats['students'] = (int)($row['cnt'] ?? 0);
    mysqli_free_result($result);
}

$result = mysqli_query($conn, "SELECT COUNT(*) as cnt FROM internships WHERE is_active = 1");
if ($result) {
    $row = mysqli_fetch_assoc($result);
    $stats['internships'] = (int)($row['cnt'] ?? 0);
    mysqli_free_result($result);
}

$result = mysqli_query($conn, "SELECT COUNT(*) as cnt FROM applications");
if ($result) {
    $row = mysqli_fetch_assoc($result);
    $stats['applications'] = (int)($row['cnt'] ?? 0);
    mysqli_free_result($result);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - InternLink</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<!-- ================= NAVBAR ================= -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
    <div class="container">
        <a class="navbar-brand fw-bold text-primary fs-3" href="index.php">
            InternLink
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-lg-center">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="internships.php">Internships</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="companies.php">Companies</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="about.php">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.php">Contact</a>
                </li>
                <li class="nav-item ms-lg-3">
                    <a class="btn btn-outline-primary" href="student/login.php">
                        Login
                    </a>
                </li>
                <li class="nav-item ms-lg-2">
                    <a class="btn btn-primary" href="student/register.php">
                        Register
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- ================= PAGE HEADER ================= -->
<section class="py-5 bg-light">
    <div class="container">
        <h1 class="display-4 fw-bold mb-3">About InternLink</h1>
        <p class="lead text-muted">Bridging the gap between students and opportunities</p>
    </div>
</section>

<!-- ================= ABOUT SECTION ================= -->
<section class="py-5">
    <div class="container">
        <div class="row align-items-center mb-5">
            <div class="col-lg-6 mb-4">
                <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?w=600" class="img-fluid rounded shadow" alt="Team">
            </div>
            <div class="col-lg-6">
                <h2 class="fw-bold mb-3">Our Mission</h2>
                <p class="fs-5 text-muted mb-3">
                    InternLink is dedicated to connecting ambitious students with world-class companies for meaningful internship experiences. We believe that internships are the bridge between education and career success.
                </p>
                <p class="fs-5 text-muted">
                    Our platform makes it easy for students to discover opportunities, apply to positions, and track their applications all in one place. For companies, we provide a streamlined way to reach talented candidates and manage their recruitment pipeline.
                </p>
            </div>
        </div>

        <hr class="my-5">

        <!-- Why Choose Us -->
        <div class="row mt-5">
            <div class="col-lg-12">
                <h2 class="fw-bold mb-5 text-center">Why Choose InternLink?</h2>
            </div>

            <div class="col-md-6 mb-4">
                <div class="card border-0 shadow p-4 h-100">
                    <i class="bi bi-lightning-charge-fill text-warning display-4 mb-3"></i>
                    <h5>Quick & Easy Apply</h5>
                    <p class="text-muted">Apply to internships with just one click. No lengthy forms or complicated processes.</p>
                </div>
            </div>

            <div class="col-md-6 mb-4">
                <div class="card border-0 shadow p-4 h-100">
                    <i class="bi bi-shield-check text-danger display-4 mb-3"></i>
                    <h5>Verified Companies</h5>
                    <p class="text-muted">All companies on our platform are verified to ensure quality internship experiences.</p>
                </div>
            </div>

            <div class="col-md-6 mb-4">
                <div class="card border-0 shadow p-4 h-100">
                    <i class="bi bi-graph-up-arrow text-success display-4 mb-3"></i>
                    <h5>Career Growth</h5>
                    <p class="text-muted">Gain valuable experience, build your portfolio, and launch your career with top companies.</p>
                </div>
            </div>

            <div class="col-md-6 mb-4">
                <div class="card border-0 shadow p-4 h-100">
                    <i class="bi bi-patch-check-fill text-primary display-4 mb-3"></i>
                    <h5>Best Opportunities</h5>
                    <p class="text-muted">Access exclusive internship opportunities from leading companies across various industries.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ================= STATS SECTION ================= -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-3 mb-4">
                <div>
                    <h3 class="display-5 fw-bold text-primary"><?php echo $stats['companies']; ?></h3>
                    <p class="text-muted">Active Companies</p>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div>
                    <h3 class="display-5 fw-bold text-primary"><?php echo $stats['students']; ?></h3>
                    <p class="text-muted">Active Students</p>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div>
                    <h3 class="display-5 fw-bold text-primary"><?php echo $stats['internships']; ?></h3>
                    <p class="text-muted">Internship Positions</p>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div>
                    <h3 class="display-5 fw-bold text-primary"><?php echo $stats['applications']; ?></h3>
                    <p class="text-muted">Total Applications</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ================= FOOTER ================= -->
<footer class="bg-dark text-white py-5 mt-5">
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-4">
                <h5>InternLink</h5>
                <p>Connecting students with amazing internship opportunities.</p>
            </div>
            <div class="col-md-4 mb-4">
                <h5>Quick Links</h5>
                <ul class="list-unstyled">
                    <li><a href="index.php" class="text-white-50 text-decoration-none">Home</a></li>
                    <li><a href="internships.php" class="text-white-50 text-decoration-none">Internships</a></li>
                    <li><a href="companies.php" class="text-white-50 text-decoration-none">Companies</a></li>
                </ul>
            </div>
            <div class="col-md-4 mb-4">
                <h5>Contact</h5>
                <p class="text-white-50">info@internlink.com<br>+1 (555) 123-4567</p>
            </div>
        </div>
        <hr class="bg-white-50">
        <p class="text-center text-white-50 mb-0">&copy; 2026 InternLink. All rights reserved.</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

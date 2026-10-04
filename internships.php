<?php
include("config/db.php");

$search_title = "";
$search_location = "";
$where_conditions = ["i.is_active = 1"];
$params = [];
$param_types = "";

// Handle search
if (($_SERVER['REQUEST_METHOD'] ?? '') === 'POST' || (isset($_GET['search']) && $_GET['search'] !== '')) {
    if (($_SERVER['REQUEST_METHOD'] ?? '') === 'POST') {
        $search_title = trim($_POST['search_title'] ?? '');
        $search_location = trim($_POST['search_location'] ?? '');
    } else {
        $search_title = trim($_GET['search'] ?? '');
        $search_location = trim($_GET['location'] ?? '');
    }

    if (!empty($search_title)) {
        $where_conditions[] = "(i.title LIKE ? OR i.description LIKE ?)";
        $search_pattern = "%" . $search_title . "%";
        $params[] = $search_pattern;
        $params[] = $search_pattern;
        $param_types .= "ss";
    }

    if (!empty($search_location)) {
        $where_conditions[] = "i.location_type LIKE ?";
        $params[] = "%" . $search_location . "%";
        $param_types .= "s";
    }
}

// Build final query
$where_clause = implode(" AND ", $where_conditions);
$query = "SELECT i.internship_id, i.title, i.stipend, i.duration, i.location_type, c.company_name
          FROM internships i
          JOIN companies c ON i.company_id = c.company_id
          WHERE $where_clause
          ORDER BY i.internship_id DESC";

// Execute with prepared statement
if (!empty($params)) {
    $stmt = mysqli_prepare($conn, $query);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, $param_types, ...$params);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
    } else {
        $result = mysqli_query($conn, $query);
    }
} else {
    $result = mysqli_query($conn, $query);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Internships - InternLink</title>
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
                    <a class="nav-link active" href="internships.php">Internships</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="companies.php">Companies</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about.php">About</a>
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
        <h1 class="display-4 fw-bold mb-3">All Internships</h1>
        <p class="lead text-muted">Browse all available internship opportunities from top companies</p>
    </div>
</section>

<!-- ================= SEARCH & FILTER ================= -->
<section class="py-4 bg-white border-bottom">
    <div class="container">
        <form method="POST" action="">
            <div class="row g-3">
                <div class="col-md-5">
                    <input type="text" class="form-control" name="search_title" placeholder="Search internships..."
                           value="<?php echo htmlspecialchars($search_title); ?>">
                </div>
                <div class="col-md-4">
                    <input type="text" class="form-control" name="search_location" placeholder="Filter by location..."
                           value="<?php echo htmlspecialchars($search_location); ?>">
                </div>
                <div class="col-md-3">
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary flex-grow-1">Search</button>
                        <a href="internships.php" class="btn btn-secondary">Clear</a>
                    </div>
                </div>
            </div>
        </form>
        <?php if (!empty($search_title) || !empty($search_location)) { ?>
        <div class="mt-3">
            <small class="text-muted">
                <strong>Filters Applied:</strong>
                <?php if (!empty($search_title)) echo htmlspecialchars($search_title) . " "; ?>
                <?php if (!empty($search_location)) echo "in " . htmlspecialchars($search_location); ?>
            </small>
        </div>
        <?php } ?>
    </div>
</section>

<!-- ================= INTERNSHIPS GRID ================= -->
<section class="py-5">
    <div class="container">
        <?php if(mysqli_num_rows($result) > 0) { ?>
        <div class="row g-4">
            <?php while($row = mysqli_fetch_assoc($result)) { ?>
            <div class="col-lg-4 col-md-6">
                <div class="card shadow h-100 border-0">
                    <div class="card-body">
                        <h4 class="card-title"><?php echo htmlspecialchars($row['title']); ?></h4>
                        <h6 class="text-primary fw-bold mb-3"><?php echo htmlspecialchars($row['company_name']); ?></h6>

                        <div class="mb-3">
                            <p class="mb-2"><i class="bi bi-geo-alt-fill text-danger"></i> <?php echo htmlspecialchars($row['location_type']); ?></p>
                            <p class="mb-2"><i class="bi bi-cash-coin text-success"></i> <?php echo htmlspecialchars($row['stipend']); ?></p>
                            <p class="mb-3"><i class="bi bi-calendar-range text-info"></i> <?php echo htmlspecialchars($row['duration']); ?></p>
                        </div>

                        <a href="student/login.php" class="btn btn-primary w-100">
                            <i class="bi bi-arrow-right"></i> Apply Now
                        </a>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
        <?php } else { ?>
        <div class="alert alert-info text-center py-5">
            <h4>No internships available.</h4>
            <p>Check back soon for new opportunities!</p>
        </div>
        <?php } ?>
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

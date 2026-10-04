<?php
include("config/db.php");

$search_company = "";
$where_conditions = [];
$params = [];
$param_types = "";

// Handle search
if (($_SERVER['REQUEST_METHOD'] ?? '') === 'POST' || (isset($_GET['search']) && $_GET['search'] !== '')) {
    if (($_SERVER['REQUEST_METHOD'] ?? '') === 'POST') {
        $search_company = trim($_POST['search_company'] ?? '');
    } else {
        $search_company = trim($_GET['search'] ?? '');
    }

    if (!empty($search_company)) {
        $where_conditions[] = "(c.company_name LIKE ? OR c.description LIKE ?)";
        $search_pattern = "%" . $search_company . "%";
        $params[] = $search_pattern;
        $params[] = $search_pattern;
        $param_types = "ss";
    }
}

// Build final query
$where_clause = !empty($where_conditions) ? "WHERE " . implode(" AND ", $where_conditions) : "";

$query = "SELECT c.company_id, c.company_name, c.website, c.location,
          COUNT(i.internship_id) as internship_count
          FROM companies c
          LEFT JOIN internships i ON c.company_id = i.company_id AND i.is_active = 1
          $where_clause
          GROUP BY c.company_id, c.company_name, c.website, c.location
          ORDER BY internship_count DESC";

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
    <title>Top Companies - InternLink</title>
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
                    <a class="nav-link active" href="companies.php">Companies</a>
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
        <h1 class="display-4 fw-bold mb-3">Top Hiring Companies</h1>
        <p class="lead text-muted">Explore companies actively recruiting interns</p>
    </div>
</section>

<!-- ================= SEARCH ================= -->
<section class="py-4 bg-white border-bottom">
    <div class="container">
        <form method="POST" action="">
            <div class="row g-3">
                <div class="col-md-8">
                    <input type="text" class="form-control" name="search_company" placeholder="Search companies..."
                           value="<?php echo htmlspecialchars($search_company); ?>">
                </div>
                <div class="col-md-4">
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary flex-grow-1">Search</button>
                        <a href="companies.php" class="btn btn-secondary">Clear</a>
                    </div>
                </div>
            </div>
        </form>
        <?php if (!empty($search_company)) { ?>
        <div class="mt-3">
            <small class="text-muted">
                <strong>Search Results for:</strong> <?php echo htmlspecialchars($search_company); ?>
            </small>
        </div>
        <?php } ?>
    </div>
</section>

<!-- ================= COMPANIES GRID ================= -->
<section class="py-5">
    <div class="container">
        <?php if(mysqli_num_rows($result) > 0) { ?>
        <div class="row g-4">
            <?php while($row = mysqli_fetch_assoc($result)) { ?>
            <div class="col-lg-4 col-md-6">
                <div class="card shadow h-100 border-0">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <h4 class="card-title"><?php echo htmlspecialchars($row['company_name']); ?></h4>
                            <span class="badge bg-primary"><?php echo $row['internship_count']; ?> Openings</span>
                        </div>

                        <div class="mb-3">
                            <?php if($row['website']) { ?>
                            <p class="mb-2">
                                <i class="bi bi-globe text-info"></i>
                                <a href="<?php echo htmlspecialchars($row['website']); ?>" target="_blank" class="text-decoration-none">
                                    Visit Website
                                </a>
                            </p>
                            <?php } ?>
                            <?php if($row['location']) { ?>
                            <p class="mb-3">
                                <i class="bi bi-geo-alt-fill text-danger"></i>
                                <?php echo htmlspecialchars($row['location']); ?>
                            </p>
                            <?php } ?>
                        </div>

                        <a href="internships.php" class="btn btn-primary w-100">
                            View Internships
                        </a>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
        <?php } else { ?>
        <div class="alert alert-info text-center py-5">
            <h4>No companies available.</h4>
            <p>Check back soon!</p>
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

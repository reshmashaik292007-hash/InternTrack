<?php
include("config/db.php");

$search_title = "";
$search_location = "";

// Handle search from index
if (($_SERVER['REQUEST_METHOD'] ?? '') === 'POST') {
    $search_title = trim($_POST['search_title'] ?? '');
    $search_location = trim($_POST['search_location'] ?? '');

    if (!empty($search_title) || !empty($search_location)) {
        // Redirect to search page with query params
        $query_params = [];
        if (!empty($search_title)) $query_params['search_title'] = $search_title;
        if (!empty($search_location)) $query_params['search_location'] = $search_location;
        $redirect_url = "search.php?" . http_build_query($query_params);
        header("Location: $redirect_url");
        exit();
    }
}

// Get featured internships (is_active = 1, order by deadline)
$featured_query = "SELECT i.internship_id, i.title, i.stipend, i.duration, i.location_type, c.company_name
                   FROM internships i
                   JOIN companies c ON i.company_id = c.company_id
                   WHERE i.is_active = 1
                   ORDER BY i.deadline ASC
                   LIMIT 6";
$featured_result = mysqli_query($conn, $featured_query);

// Get stats for home page
$stats = ['companies' => 0, 'internships' => 0, 'students' => 0, 'applications' => 0];
$r = mysqli_query($conn, "SELECT COUNT(*) as c FROM companies");
if ($r) $stats['companies'] = mysqli_fetch_assoc($r)['c'];
$r = mysqli_query($conn, "SELECT COUNT(*) as c FROM internships WHERE is_active = 1");
if ($r) $stats['internships'] = mysqli_fetch_assoc($r)['c'];
$r = mysqli_query($conn, "SELECT COUNT(*) as c FROM students");
if ($r) $stats['students'] = mysqli_fetch_assoc($r)['c'];
$r = mysqli_query($conn, "SELECT COUNT(*) as c FROM applications");
if ($r) $stats['applications'] = mysqli_fetch_assoc($r)['c'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>InternLink - Internship Portal</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<!-- ================= NAVBAR ================= -->

<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
    <div class="container">

        <a class="navbar-brand fw-bold text-primary fs-3" href="index.php">
            InternLink
        </a>

        <button class="navbar-toggler" type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarNav">

            <span class="navbar-toggler-icon"></span>

        </button>

        <div class="collapse navbar-collapse" id="navbarNav">

            <ul class="navbar-nav ms-auto align-items-lg-center">

                <li class="nav-item">
                    <a class="nav-link active" href="index.php">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="internships.php">Internships</a>
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

<!-- ================= HERO SECTION ================= -->

<section class="py-5 bg-light">

<div class="container">

<div class="row align-items-center">

<div class="col-lg-6">

<h1 class="display-4 fw-bold">

Find Your Dream Internship

</h1>

<p class="lead mt-3">

Connect with top companies, build your career,
and apply for internships with just one click.

</p>

<div class="mt-4">

<a href="internships.php" class="btn btn-primary btn-lg me-2">

Explore Internships

</a>

<a href="company/register.php" class="btn btn-outline-primary btn-lg">

Post Internship

</a>

</div>

</div>

<div class="col-lg-6 text-center">

<img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?w=700"
class="img-fluid rounded shadow"
alt="Students">

</div>

</div>

</div>

</section>

<!-- ================= SEARCH SECTION ================= -->

<section class="py-5">

<div class="container">

<div class="card shadow border-0">

<div class="card-body p-4">

<form method="POST" action="">

<div class="row g-3">

<div class="col-md-5">

<input
type="text"
name="search_title"
class="form-control form-control-lg"
placeholder="Job Title"
value="<?php echo htmlspecialchars($search_title); ?>">

</div>

<div class="col-md-4">

<input
type="text"
name="search_location"
class="form-control form-control-lg"
placeholder="Location"
value="<?php echo htmlspecialchars($search_location); ?>">

</div>

<div class="col-md-3">

<button
type="submit"
class="btn btn-primary btn-lg w-100">

Search

</button>

</div>

</div>

</form>

</div>

</div>

</div>

</section>
<!-- ================= CATEGORIES ================= -->

<section class="py-5 bg-light">

<div class="container">

<div class="text-center mb-5">

<h2 class="fw-bold">Popular Categories</h2>

<p class="text-muted">Choose your favourite career path</p>

</div>

<div class="row g-4">

<?php
// Get categories from database
$cat_result = mysqli_query($conn, "SELECT category_name FROM categories LIMIT 6");
$cat_icons = ['code-slash', 'phone', 'palette', 'bar-chart-line', 'megaphone', 'brush'];
$cat_colors = ['primary', 'success', 'secondary', 'danger', 'warning', 'info'];
$i = 0;
while ($cat = mysqli_fetch_assoc($cat_result)) {
    $icon = $cat_icons[$i % count($cat_icons)];
    $color = $cat_colors[$i % count($cat_colors)];
?>
<div class="col-md-4">
<div class="card shadow-sm text-center p-4 h-100">
<i class="bi bi-<?php echo $icon; ?> display-4 text-<?php echo $color; ?>"></i>
<h4 class="mt-3"><?php echo htmlspecialchars($cat['category_name']); ?></h4>
</div>
</div>
<?php $i++; } ?>

</div>

</div>

</section>

<!-- ================= FEATURED INTERNSHIPS ================= -->

<section class="py-5">

<div class="container">

<div class="text-center mb-5">

<h2 class="fw-bold">Featured Internships</h2>

</div>

<div class="row g-4">

<?php if (mysqli_num_rows($featured_result) > 0): ?>
    <?php while($row = mysqli_fetch_assoc($featured_result)): ?>
    <div class="col-lg-4">
    <div class="card shadow h-100">
    <div class="card-body">
    <h4><?php echo htmlspecialchars($row['title']); ?></h4>
    <h6 class="text-primary"><?php echo htmlspecialchars($row['company_name']); ?></h6>
    <p>📍 <?php echo htmlspecialchars($row['location_type']); ?></p>
    <p>💰 <?php echo htmlspecialchars($row['stipend']); ?>/month</p>
    <p>⏳ <?php echo htmlspecialchars($row['duration']); ?></p>
    <a href="student/internship-details.php?id=<?php echo $row['internship_id']; ?>" class="btn btn-primary w-100">View Details</a>
    </div>
    </div>
    </div>
    <?php endwhile; ?>
<?php else: ?>
    <div class="col-12 text-center">
        <p class="text-muted">No internships available.</p>
    </div>
<?php endif; ?>

</div>

<div class="text-center mt-4">
    <a href="internships.php" class="btn btn-outline-primary btn-lg">View All Internships</a>
</div>

</div>

</section>

<!-- ================= STATS SECTION ================= -->

<section class="py-5 bg-light">

<div class="container">

<div class="row text-center">

<div class="col-md-3 mb-4">
    <h3 class="display-5 fw-bold text-primary"><?php echo $stats['companies']; ?></h3>
    <p class="text-muted">Active Companies</p>
</div>
<div class="col-md-3 mb-4">
    <h3 class="display-5 fw-bold text-primary"><?php echo $stats['students']; ?></h3>
    <p class="text-muted">Active Students</p>
</div>
<div class="col-md-3 mb-4">
    <h3 class="display-5 fw-bold text-primary"><?php echo $stats['internships']; ?></h3>
    <p class="text-muted">Internship Positions</p>
</div>
<div class="col-md-3 mb-4">
    <h3 class="display-5 fw-bold text-primary"><?php echo $stats['applications']; ?></h3>
    <p class="text-muted">Total Applications</p>
</div>

</div>

</div>

</section>

<!-- ================= TOP COMPANIES ================= -->

<section class="py-5">

<div class="container">

<div class="text-center mb-5">

<h2 class="fw-bold">Top Hiring Companies</h2>

</div>

<div class="row text-center justify-content-center">
<?php
$company_result = mysqli_query($conn, "SELECT company_name FROM companies ORDER BY is_featured DESC, company_id DESC LIMIT 6");
if ($company_result && mysqli_num_rows($company_result) > 0) {
    while ($company = mysqli_fetch_assoc($company_result)) {
        echo '<div class="col-md-2"><h5>' . htmlspecialchars($company['company_name']) . '</h5></div>';
    }
} else {
    echo '<div class="col-12"><p class="text-muted">No companies available.</p></div>';
}
?>
</div>

</div>

</section>
<!-- ================= WHY CHOOSE US ================= -->

<section class="py-5">

<div class="container">

<div class="text-center mb-5">

<h2 class="fw-bold">Why Choose InternLink?</h2>

<p class="text-muted">
The easiest way to connect students with companies.
</p>

</div>

<div class="row g-4">

<div class="col-md-3">
<div class="card border-0 shadow text-center p-4 h-100">
<i class="bi bi-patch-check-fill text-primary display-4"></i>
<h5 class="mt-3">Verified Companies</h5>
<p>Only trusted companies post internships.</p>
</div>
</div>

<div class="col-md-3">
<div class="card border-0 shadow text-center p-4 h-100">
<i class="bi bi-lightning-charge-fill text-warning display-4"></i>
<h5 class="mt-3">Easy Apply</h5>
<p>Apply for internships in one click.</p>
</div>
</div>

<div class="col-md-3">
<div class="card border-0 shadow text-center p-4 h-100">
<i class="bi bi-graph-up-arrow text-success display-4"></i>
<h5 class="mt-3">Career Growth</h5>
<p>Gain experience with top companies.</p>
</div>
</div>

<div class="col-md-3">
<div class="card border-0 shadow text-center p-4 h-100">
<i class="bi bi-shield-check text-danger display-4"></i>
<h5 class="mt-3">Secure Platform</h5>
<p>Your information is protected and safe.</p>
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
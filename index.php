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

        <a class="navbar-brand fw-bold text-primary fs-3" href="#">
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
                    <a class="nav-link active" href="#">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">Internships</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">Companies</a>
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

<a href="#" class="btn btn-primary btn-lg me-2">

Explore Internships

</a>

<a href="#" class="btn btn-outline-primary btn-lg">

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

<div class="row g-3">

<div class="col-md-5">

<input
type="text"
class="form-control form-control-lg"
placeholder="Job Title">

</div>

<div class="col-md-4">

<input
type="text"
class="form-control form-control-lg"
placeholder="Location">

</div>

<div class="col-md-3">

<button
class="btn btn-primary btn-lg w-100">

Search

</button>

</div>

</div>

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

<div class="col-md-4">
<div class="card shadow-sm text-center p-4 h-100">
<i class="bi bi-code-slash display-4 text-primary"></i>
<h4 class="mt-3">Web Development</h4>
<p>Frontend & Backend Internship</p>
</div>
</div>

<div class="col-md-4">
<div class="card shadow-sm text-center p-4 h-100">
<i class="bi bi-cpu display-4 text-success"></i>
<h4 class="mt-3">AI & Machine Learning</h4>
<p>Build intelligent applications</p>
</div>
</div>

<div class="col-md-4">
<div class="card shadow-sm text-center p-4 h-100">
<i class="bi bi-bar-chart-line display-4 text-danger"></i>
<h4 class="mt-3">Data Science</h4>
<p>Analytics & Visualization</p>
</div>
</div>

<div class="col-md-4">
<div class="card shadow-sm text-center p-4 h-100">
<i class="bi bi-shield-lock display-4 text-warning"></i>
<h4 class="mt-3">Cyber Security</h4>
<p>Security & Ethical Hacking</p>
</div>
</div>

<div class="col-md-4">
<div class="card shadow-sm text-center p-4 h-100">
<i class="bi bi-phone display-4 text-info"></i>
<h4 class="mt-3">App Development</h4>
<p>Android & iOS</p>
</div>
</div>

<div class="col-md-4">
<div class="card shadow-sm text-center p-4 h-100">
<i class="bi bi-palette display-4 text-secondary"></i>
<h4 class="mt-3">UI / UX Design</h4>
<p>Creative Designing</p>
</div>
</div>

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

<div class="col-lg-4">
<div class="card shadow h-100">
<div class="card-body">
<h4>Frontend Developer</h4>
<h6 class="text-primary">Google</h6>
<p>📍 Hyderabad</p>
<p>💰 ₹25,000/month</p>
<p>⏳ 6 Months</p>
<a href="#" class="btn btn-primary w-100">Apply Now</a>
</div>
</div>
</div>

<div class="col-lg-4">
<div class="card shadow h-100">
<div class="card-body">
<h4>Data Analyst</h4>
<h6 class="text-primary">Microsoft</h6>
<p>📍 Bangalore</p>
<p>💰 ₹30,000/month</p>
<p>⏳ 6 Months</p>
<a href="#" class="btn btn-primary w-100">Apply Now</a>
</div>
</div>
</div>

<div class="col-lg-4">
<div class="card shadow h-100">
<div class="card-body">
<h4>Python Developer</h4>
<h6 class="text-primary">Infosys</h6>
<p>📍 Chennai</p>
<p>💰 ₹22,000/month</p>
<p>⏳ 4 Months</p>
<a href="#" class="btn btn-primary w-100">Apply Now</a>
</div>
</div>
</div>

<div class="col-lg-4">
<div class="card shadow h-100">
<div class="card-body">
<h4>UI Designer</h4>
<h6 class="text-primary">Adobe</h6>
<p>📍 Pune</p>
<p>💰 ₹20,000/month</p>
<p>⏳ 3 Months</p>
<a href="#" class="btn btn-primary w-100">Apply Now</a>
</div>
</div>
</div>

<div class="col-lg-4">
<div class="card shadow h-100">
<div class="card-body">
<h4>Java Developer</h4>
<h6 class="text-primary">TCS</h6>
<p>📍 Hyderabad</p>
<p>💰 ₹18,000/month</p>
<p>⏳ 6 Months</p>
<a href="#" class="btn btn-primary w-100">Apply Now</a>
</div>
</div>
</div>

<div class="col-lg-4">
<div class="card shadow h-100">
<div class="card-body">
<h4>Cloud Engineer</h4>
<h6 class="text-primary">Amazon</h6>
<p>📍 Bengaluru</p>
<p>💰 ₹35,000/month</p>
<p>⏳ 6 Months</p>
<a href="#" class="btn btn-primary w-100">Apply Now</a>
</div>
</div>
</div>

</div>

</div>

</section>

<!-- ================= TOP COMPANIES ================= -->

<section class="py-5 bg-light">

<div class="container">

<div class="text-center mb-5">

<h2 class="fw-bold">Top Hiring Companies</h2>

</div>

<div class="row text-center">

<div class="col-md-2"><h5>Google</h5></div>
<div class="col-md-2"><h5>Microsoft</h5></div>
<div class="col-md-2"><h5>Amazon</h5></div>
<div class="col-md-2"><h5>TCS</h5></div>
<div class="col-md-2"><h5>Infosys</h5></div>
<div class="col-md-2"><h5>Deloitte</h5></div>

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

</
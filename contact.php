<?php
include("config/db.php");

$success = false;
$error = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $subject = $_POST['subject'] ?? '';
    $message = $_POST['message'] ?? '';

    if (!empty($name) && !empty($email) && !empty($subject) && !empty($message)) {
        $stmt = mysqli_prepare($conn, "INSERT INTO contact_messages (sender_name, sender_email, subject, message, created_at) VALUES (?, ?, ?, ?, NOW())");
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $subject, $message);
            if (mysqli_stmt_execute($stmt)) {
                $success = true;
            } else {
                $error = true;
            }
            mysqli_stmt_close($stmt);
        } else {
            $error = true;
        }
    } else {
        $error = true;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - InternLink</title>
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
                    <a class="nav-link" href="about.php">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="contact.php">Contact</a>
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
        <h1 class="display-4 fw-bold mb-3">Contact Us</h1>
        <p class="lead text-muted">Have questions? We'd love to hear from you</p>
    </div>
</section>

<!-- ================= CONTACT SECTION ================= -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <!-- Contact Info -->
            <div class="col-lg-4 mb-5">
                <div class="card border-0 shadow p-4 mb-4">
                    <i class="bi bi-telephone-fill text-primary display-4 mb-3"></i>
                    <h5>Phone</h5>
                    <p class="text-muted">+1 (555) 123-4567</p>
                </div>

                <div class="card border-0 shadow p-4 mb-4">
                    <i class="bi bi-envelope-fill text-primary display-4 mb-3"></i>
                    <h5>Email</h5>
                    <p class="text-muted">info@internlink.com</p>
                </div>

                <div class="card border-0 shadow p-4">
                    <i class="bi bi-geo-alt-fill text-primary display-4 mb-3"></i>
                    <h5>Address</h5>
                    <p class="text-muted">123 Tech Street, Silicon Valley, CA 94025, USA</p>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="col-lg-8">
                <div class="card border-0 shadow p-5">
                    <?php if($success) { ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle"></i> <strong>Success!</strong> Your message has been sent. We'll get back to you soon.
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    <?php } ?>

                    <?php if($error) { ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-circle"></i> <strong>Error!</strong> Please fill in all fields and try again.
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    <?php } ?>

                    <form method="POST">
                        <div class="mb-3">
                            <label for="name" class="form-label fw-bold">Full Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label fw-bold">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>

                        <div class="mb-3">
                            <label for="subject" class="form-label fw-bold">Subject</label>
                            <input type="text" class="form-control" id="subject" name="subject" required>
                        </div>

                        <div class="mb-4">
                            <label for="message" class="form-label fw-bold">Message</label>
                            <textarea class="form-control" id="message" name="message" rows="6" required></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary btn-lg w-100">
                            <i class="bi bi-send"></i> Send Message
                        </button>
                    </form>
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

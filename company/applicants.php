<?php
session_start();
include("../config/db.php");

if (!isset($_SESSION['company_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['company_id'];

/* FIXED: Get company ID using prepared statement */
$stmt = mysqli_prepare($conn, "
    SELECT company_id
    FROM companies
    WHERE user_id = ?
");
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$company = mysqli_fetch_assoc($result);
$company_id = $company['company_id'];


/* FIXED: Get applicants for this company's internships using prepared statement */
$stmt = mysqli_prepare($conn, "
    SELECT
        s.full_name,
        u.email,
        i.title,
        s.resume_path,
        a.status,
        a.applied_at
    FROM applications a
    JOIN students s ON a.student_id = s.student_id
    JOIN users u ON s.user_id = u.user_id
    JOIN internships i ON a.internship_id = i.internship_id
    WHERE i.company_id = ?
    ORDER BY a.applied_at DESC
");
mysqli_stmt_bind_param($stmt, "i", $company_id);
mysqli_stmt_execute($stmt);
$applicants_query = mysqli_stmt_get_result($stmt);
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Applicants | InternLink</title>

<link
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet">

<link
rel="stylesheet"
href="../assets/css/style.css">

<link
rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>

<body>


<!-- Navbar -->

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">

<div class="container">

<a
class="navbar-brand fw-bold"
href="../index.php">

InternLink

</a>

<div class="ms-auto">

<a
href="dashboard.php"
class="nav-link d-inline text-white me-3">

Dashboard

</a>

<a
href="post-internship.php"
class="nav-link d-inline text-white me-3">

Post Internship

</a>

<a
href="applicants.php"
class="nav-link d-inline text-white me-3">

Applicants

</a>

<a
href="profile.php"
class="nav-link d-inline text-white me-3">

Profile

</a>

<a
href="logout.php"
class="nav-link d-inline text-warning">

Logout

</a>

</div>

</div>

</nav>


<!-- Applicants -->

<section class="py-5">

<div class="container">

<h2 class="fw-bold mb-4">

Internship Applicants

</h2>


<div class="card shadow border-0">

<div class="card-header bg-primary text-white">

<h5 class="mb-0">

Applicants List

</h5>

</div>


<div class="card-body">

<div class="table-responsive">

<table class="table table-hover align-middle">

<thead class="table-light">

<tr>

<th>Name</th>

<th>Email</th>

<th>Internship</th>

<th>Resume</th>

<th>Status</th>

</tr>

</thead>


<tbody>


<?php

if (mysqli_num_rows($applicants_query) > 0) {

    while ($applicant = mysqli_fetch_assoc($applicants_query)) {

?>

<tr>

<td>

<?php
echo htmlspecialchars($applicant['full_name']);
?>

</td>


<td>

<?php
echo htmlspecialchars($applicant['email']);
?>

</td>


<td>

<?php
echo htmlspecialchars($applicant['title']);
?>

</td>


<td>

<?php if (!empty($applicant['resume_path'])) { ?>

<a
href="../uploads/resumes/<?php echo htmlspecialchars($applicant['resume_path']); ?>"
target="_blank"
class="btn btn-sm btn-outline-primary">

<i class="bi bi-file-earmark-text"></i>

View Resume

</a>

<?php } else { ?>

<span class="text-muted">

No Resume

</span>

<?php } ?>

</td>


<td>

<?php

$status = $applicant['status'];

if ($status == 'shortlisted') {

    echo '<span class="badge bg-success">Shortlisted</span>';

} elseif ($status == 'accepted') {

    echo '<span class="badge bg-primary">Accepted</span>';

} elseif ($status == 'rejected') {

    echo '<span class="badge bg-danger">Rejected</span>';

} else {

    echo '<span class="badge bg-warning text-dark">Applied</span>';

}

?>

</td>

</tr>


<?php

    }

} else {

?>

<tr>

<td
colspan="5"
class="text-center text-muted py-4">

No applicants yet.

</td>

</tr>

<?php

}

?>

</tbody>

</table>

</div>

</div>

</div>

</div>

</section>


<!-- Footer -->

<footer class="bg-dark text-white text-center py-4">

<div class="container">

<p class="mb-0">

© 2026 InternLink | All Rights Reserved

</p>

</div>

</footer>


</body>

</html>
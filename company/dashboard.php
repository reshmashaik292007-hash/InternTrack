<?php
session_start();
include("../config/db.php");

if(!isset($_SESSION['company_id']))
{
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['company_id'];

// Get company_id
$company = mysqli_query($conn,"SELECT company_id, company_name FROM companies WHERE user_id='$user_id'");
$companyData = mysqli_fetch_assoc($company);

$company_id = $companyData['company_id'];
$company_name = $companyData['company_name'];

// Total internships
$totalInternships = mysqli_num_rows(
    mysqli_query($conn,"SELECT * FROM internships WHERE company_id='$company_id'")
);

// Total applications
$totalApplications = mysqli_num_rows(
    mysqli_query($conn,"
        SELECT a.application_id
        FROM applications a
        JOIN internships i
        ON a.internship_id=i.internship_id
        WHERE i.company_id='$company_id'
    ")
);

// Shortlisted candidates
$totalShortlisted = mysqli_num_rows(
    mysqli_query($conn,"
        SELECT a.application_id
        FROM applications a
        JOIN internships i
        ON a.internship_id=i.internship_id
        WHERE i.company_id='$company_id'
        AND a.status='shortlisted'
    ")
);

// Recent internships
$recent = mysqli_query($conn,"
SELECT
i.title,
i.location_type,
COUNT(a.application_id) AS applications,
i.is_active
FROM internships i
LEFT JOIN applications a
ON i.internship_id=a.internship_id
WHERE i.company_id='$company_id'
GROUP BY i.internship_id
ORDER BY i.created_at DESC
LIMIT 5
");
?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Company Dashboard | InternLink</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="../assets/css/style.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>

<body>

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
<a class="nav-link active" href="#">Dashboard</a>
</li>

<li class="nav-item">
<a class="nav-link" href="post-internship.php">Post Internship</a>
</li>

<li class="nav-item">
<a class="nav-link" href="applicants.php">Applicants</a>
</li>

<li class="nav-item">
<a class="nav-link" href="profile.php">Profile</a>
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

<h2 class="fw-bold mb-4">

Welcome, <?php echo $company_name; ?> 👋

</h2>

<div class="row">

<div class="col-md-4 mb-4">

<div class="card shadow border-0 text-center p-4">

<i class="bi bi-briefcase-fill display-4 text-primary"></i>

<h3 class="mt-3"><?php echo $totalInternships; ?></h3>

<p class="mb-0">Internships Posted</p>

</div>

</div>

<div class="col-md-4 mb-4">

<div class="card shadow border-0 text-center p-4">

<i class="bi bi-people-fill display-4 text-success"></i>

<h3 class="mt-3"><?php echo $totalApplications; ?></h3>

<p class="mb-0">Applications Received</p>

</div>

</div>

<div class="col-md-4 mb-4">

<div class="card shadow border-0 text-center p-4">

<i class="bi bi-check-circle-fill display-4 text-warning"></i>

<h3 class="mt-3"><?php echo $totalShortlisted; ?></h3>

<p class="mb-0">Candidates Shortlisted</p>

</div>

</div>

</div>

<div class="card shadow border-0 mt-4">

<div class="card-header bg-primary text-white">

<h5 class="mb-0">

Recent Internship Posts

</h5>

</div>

<div class="card-body">

<table class="table table-hover">

<thead>

<tr>

<th>Internship</th>

<th>Location</th>

<th>Applications</th>

<th>Status</th>

</tr>

</thead>

<tbody>

<?php
if(mysqli_num_rows($recent)>0)
{
    while($row=mysqli_fetch_assoc($recent))
    {
?>
<tr>

<td><?php echo $row['title']; ?></td>

<td><?php echo $row['location_type']; ?></td>

<td><?php echo $row['applications']; ?></td>

<td>
<?php
if($row['is_active']==1)
{
    echo '<span class="badge bg-success">Active</span>';
}
else
{
    echo '<span class="badge bg-danger">Closed</span>';
}
?>
</td>

</tr>

<?php
    }
}
else
{
?>
<tr>
<td colspan="4" class="text-center">
No internships posted yet.
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

</section>

<footer class="bg-dark text-white text-center py-4">

<div class="container">

<p class="mb-0">

© 2026 InternLink | All Rights Reserved

</p>

</div>

</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
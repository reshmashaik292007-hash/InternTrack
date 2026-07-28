<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Post Internship | InternLink</title>

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
<a class="nav-link" href="dashboard.php">Dashboard</a>
</li>

<li class="nav-item">
<a class="nav-link active" href="#">Post Internship</a>
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

<div class="row justify-content-center">

<div class="col-lg-8">

<div class="card shadow border-0">

<div class="card-header bg-primary text-white">

<h3 class="mb-0">

Post New Internship

</h3>

</div>

<div class="card-body">

<form>

<div class="mb-3">

<label class="form-label">

Internship Title

</label>

<input
type="text"
class="form-control"
placeholder="e.g. Frontend Developer">

</div>

<div class="mb-3">

<label class="form-label">

Location

</label>

<input
type="text"
class="form-control"
placeholder="Enter Location">

</div>

<div class="row">

<div class="col-md-6 mb-3">

<label class="form-label">

Duration

</label>

<input
type="text"
class="form-control"
placeholder="e.g. 6 Months">

</div>

<div class="col-md-6 mb-3">

<label class="form-label">

Stipend

</label>

<input
type="text"
class="form-control"
placeholder="e.g. ₹25,000 / Month">

</div>

</div>

<div class="mb-3">

<label class="form-label">

Job Description

</label>

<textarea
class="form-control"
rows="5"
placeholder="Enter internship description"></textarea>

</div>

<div class="mb-3">

<label class="form-label">

Required Skills

</label>

<textarea
class="form-control"
rows="4"
placeholder="HTML, CSS, JavaScript, PHP"></textarea>

</div>
<div class="row">

<div class="col-md-6 mb-3">

<label class="form-label">

Application Deadline

</label>

<input
type="date"
class="form-control">

</div>

<div class="col-md-6 mb-3">

<label class="form-label">

Internship Type

</label>

<select class="form-select">

<option selected>Select Type</option>
<option>Work From Office</option>
<option>Work From Home</option>
<option>Hybrid</option>

</select>

</div>

</div>

<div class="d-grid mt-4">

<button
type="submit"
class="btn btn-primary btn-lg">

Post Internship

</button>

</div>

</form>

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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
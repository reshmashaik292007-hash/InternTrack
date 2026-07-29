<?php
session_start();
include("../config/db.php");
if(!isset($_SESSION['student_id'])){
    header("Location: login.php");
    exit();
}
$result=mysqli_query($conn,"SELECT i.internship_id,i.title,i.stipend,i.duration,i.location_type,c.company_name
FROM internships i
JOIN companies c ON i.company_id=c.company_id
WHERE i.is_active=1
ORDER BY i.internship_id DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Available Internships</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<div class="container py-5">
<h2 class="fw-bold mb-4">Available Internships</h2>
<div class="row">
<?php while($row=mysqli_fetch_assoc($result)){ ?>
<div class="col-lg-4 mb-4">
<div class="card shadow h-100">
<div class="card-body">
<h4><?php echo htmlspecialchars($row['title']); ?></h4>
<h6 class="text-primary"><?php echo htmlspecialchars($row['company_name']); ?></h6>
<p>📍 <?php echo htmlspecialchars($row['location_type']); ?></p>
<p>💰 <?php echo htmlspecialchars($row['stipend']); ?></p>
<p>⏳ <?php echo htmlspecialchars($row['duration']); ?></p>
<a href="apply.php?id=<?php echo $row['internship_id']; ?>" class="btn btn-primary w-100">Apply Now</a>
</div>
</div>
</div>
<?php } ?>
</div>
</div>
</body>
</html>
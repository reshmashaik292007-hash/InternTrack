<?php
session_start();
include("../config/db.php");

if(!isset($_SESSION['student_id'])){
    header("Location: login.php");
    exit();
}

if(!isset($_GET['id'])){
    die("Internship ID Missing");
}

$internship_id = (int)$_GET['id'];
$user_id = $_SESSION['student_id'];

$res = mysqli_query($conn,"SELECT student_id,full_name,phone,college_name FROM students WHERE user_id='$user_id'");
$student = mysqli_fetch_assoc($res);

if(!$student){
    die("Student profile not found.");
}

if(isset($_POST['apply'])){
    $check = mysqli_query($conn,"SELECT * FROM applications WHERE internship_id='$internship_id' AND student_id='".$student['student_id']."'");
    if(mysqli_num_rows($check)>0){
        echo "<script>alert('You have already applied for this internship');</script>";
    }else{
        mysqli_query($conn,"INSERT INTO applications(internship_id,student_id,status) VALUES('$internship_id','".$student['student_id']."','applied')");
        echo "<script>alert('Application Submitted Successfully');window.location='my-applications.php';</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Apply Internship | InternLink</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<div class="container py-5">
<div class="card shadow">
<div class="card-header bg-primary text-white"><h3>Internship Application</h3></div>
<div class="card-body">
<form method="POST">
<div class="mb-3">
<label>Full Name</label>
<input type="text" class="form-control" value="<?php echo htmlspecialchars($student['full_name']); ?>" readonly>
</div>
<div class="mb-3">
<label>Phone</label>
<input type="text" class="form-control" value="<?php echo htmlspecialchars($student['phone']); ?>" readonly>
</div>
<div class="mb-3">
<label>College</label>
<input type="text" class="form-control" value="<?php echo htmlspecialchars($student['college_name']); ?>" readonly>
</div>
<div class="d-grid">
<button type="submit" name="apply" class="btn btn-primary btn-lg">Submit Application</button>
<a href="internships.php" class="btn btn-secondary mt-2">Cancel</a>
</div>
</form>
</div>
</div>
</div>
</body>
</html>

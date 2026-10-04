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

// FIXED: Use prepared statement for student query
$stmt = mysqli_prepare($conn, "SELECT student_id, full_name, phone, college_name FROM students WHERE user_id = ?");
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$student = mysqli_fetch_assoc($result);

if(!$student){
    die("Student profile not found.");
}

if(isset($_POST['apply'])){
    // FIXED: Use prepared statement for checking existing application
    $stmt = mysqli_prepare($conn, "SELECT * FROM applications WHERE internship_id = ? AND student_id = ?");
    mysqli_stmt_bind_param($stmt, "ii", $internship_id, $student['student_id']);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    if(mysqli_stmt_num_rows($stmt) > 0){
        echo "<script>alert('You have already applied for this internship');</script>";
    }else{
        // FIXED: Use prepared statement for INSERT
        $stmt = mysqli_prepare($conn, "INSERT INTO applications (internship_id, student_id, status) VALUES (?, ?, 'applied')");
        mysqli_stmt_bind_param($stmt, "ii", $internship_id, $student['student_id']);

        if(mysqli_stmt_execute($stmt)){
            echo "<script>alert('Application Submitted Successfully');window.location='my-applications.php';</script>";
        }else{
            echo "<script>alert('Error submitting application: " . mysqli_error($conn) . "');</script>";
        }
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

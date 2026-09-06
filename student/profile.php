<?php
session_start();
include("../config/db.php");

if (!isset($_SESSION['student_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['student_id'];

$message = "";
$message_type = "";

/* Get student details */
$query = mysqli_query($conn, "
    SELECT 
        u.email,
        s.full_name,
        s.phone,
        s.college_name,
        s.resume_path
    FROM users u
    JOIN students s ON u.user_id = s.user_id
    WHERE s.user_id = '$user_id'
");

$student = mysqli_fetch_assoc($query);


/* Resume Upload */
if (isset($_POST['upload_resume'])) {

    if (isset($_FILES['resume']) && $_FILES['resume']['error'] === 0) {

        $file_name = $_FILES['resume']['name'];
        $file_tmp = $_FILES['resume']['tmp_name'];
        $file_size = $_FILES['resume']['size'];

        $extension = strtolower(
            pathinfo($file_name, PATHINFO_EXTENSION)
        );

        $allowed = array("pdf", "doc", "docx");

        if (!in_array($extension, $allowed)) {

            $message = "Only PDF, DOC and DOCX files are allowed.";
            $message_type = "danger";

        } elseif ($file_size > 5 * 1024 * 1024) {

            $message = "File size must be less than 5 MB.";
            $message_type = "danger";

        } else {

            $new_name = "resume_" . $user_id . "_" . time() . "." . $extension;

            $upload_path = "../uploads/resumes/" . $new_name;

            if (move_uploaded_file($file_tmp, $upload_path)) {

                $safe_name = mysqli_real_escape_string($conn, $new_name);

                mysqli_query($conn, "
                    UPDATE students
                    SET resume_path = '$safe_name'
                    WHERE user_id = '$user_id'
                ");

                $student['resume_path'] = $new_name;

                $message = "Resume uploaded successfully!";
                $message_type = "success";

            } else {

                $message = "Failed to upload resume.";
                $message_type = "danger";
            }
        }

    } else {

        $message = "Please select a resume.";
        $message_type = "danger";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>My Profile | InternLink</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <link
        rel="stylesheet"
        href="../assets/css/style.css">

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>

        body {
            background: #f5f7fb;
        }

        .profile-card {
            max-width: 750px;
            margin: 40px auto;
            border: none;
            border-radius: 16px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.08);
        }

        .profile-icon {
            width: 75px;
            height: 75px;
            border-radius: 50%;
            background: #eaf2ff;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
        }

        .profile-icon i {
            font-size: 38px;
            color: #0d6efd;
        }

        .profile-info {
            background: #f8f9fa;
            border-radius: 12px;
            padding: 20px;
        }

        .profile-row {
            display: flex;
            padding: 10px 0;
            border-bottom: 1px solid #e5e5e5;
        }

        .profile-row:last-child {
            border-bottom: none;
        }

        .profile-label {
            width: 120px;
            font-weight: 600;
        }

        .resume-box {
            background: #f8f9fa;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 18px;
        }

        .upload-btn {
            white-space: nowrap;
        }

    </style>

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
                class="text-white me-3 text-decoration-none">

                Dashboard

            </a>

            <a
                href="internships.php"
                class="text-white me-3 text-decoration-none">

                Internships

            </a>

            <a
                href="my-applications.php"
                class="text-white me-3 text-decoration-none">

                My Applications

            </a>

            <a
                href="profile.php"
                class="text-warning text-decoration-none">

                Profile

            </a>

        </div>

    </div>

</nav>


<!-- Profile -->

<div class="container">

    <div class="card profile-card">

        <div class="card-body p-4 p-md-5">


            <!-- Profile Header -->

            <div class="text-center mb-4">

                <div class="profile-icon">

                    <i class="bi bi-person"></i>

                </div>

                <h2 class="fw-bold mb-1">

                    My Profile

                </h2>

                <p class="text-muted mb-0">

                    View and manage your profile information

                </p>

            </div>


            <!-- Student Information -->

            <div class="profile-info mb-4">

                <div class="profile-row">

                    <div class="profile-label">
                        Name
                    </div>

                    <div>
                        <?php echo htmlspecialchars($student['full_name']); ?>
                    </div>

                </div>


                <div class="profile-row">

                    <div class="profile-label">
                        Email
                    </div>

                    <div>
                        <?php echo htmlspecialchars($student['email']); ?>
                    </div>

                </div>


                <div class="profile-row">

                    <div class="profile-label">
                        Phone
                    </div>

                    <div>
                        <?php echo htmlspecialchars($student['phone']); ?>
                    </div>

                </div>


                <div class="profile-row">

                    <div class="profile-label">
                        College
                    </div>

                    <div>
                        <?php echo htmlspecialchars($student['college_name']); ?>
                    </div>

                </div>

            </div>


            <!-- Resume -->

            <div class="resume-box">

                <div class="d-flex justify-content-between align-items-center mb-3">

                    <div>

                        <h5 class="fw-bold mb-1">

                            <i class="bi bi-file-earmark-text text-primary me-2"></i>

                            Resume

                        </h5>

                        <small class="text-muted">

                            Upload your latest resume

                        </small>

                    </div>


                    <?php if (!empty($student['resume_path'])) { ?>

                        <a
                            href="../uploads/resumes/<?php echo htmlspecialchars($student['resume_path']); ?>"
                            target="_blank"
                            class="btn btn-outline-primary btn-sm">

                            <i class="bi bi-eye me-1"></i>

                            View

                        </a>

                    <?php } ?>

                </div>


                <!-- Message -->

                <?php if ($message != "") { ?>

                    <div class="alert alert-<?php echo $message_type; ?> py-2 mb-3">

                        <?php echo htmlspecialchars($message); ?>

                    </div>

                <?php } ?>


                <!-- Upload Form -->

                <form
                    method="POST"
                    enctype="multipart/form-data">

                    <div class="row g-2">

                        <div class="col">

                            <input
                                type="file"
                                name="resume"
                                class="form-control"
                                accept=".pdf,.doc,.docx"
                                required>

                        </div>

                        <div class="col-auto">

                            <button
                                type="submit"
                                name="upload_resume"
                                class="btn btn-primary upload-btn">

                                <i class="bi bi-upload me-1"></i>

                                Upload Resume

                            </button>

                        </div>

                    </div>

                    <small class="text-muted d-block mt-2">

                        PDF, DOC or DOCX • Maximum 5 MB

                    </small>

                </form>

            </div>


        </div>

    </div>

</div>


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
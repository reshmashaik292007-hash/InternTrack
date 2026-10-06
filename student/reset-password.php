<?php

include("../config/db.php");

$token = $_GET['token'] ?? "";

$message = "";
$message_type = "";

if ($token == "") {
    die("Invalid reset link.");
}

$stmt = mysqli_prepare(
    $conn,
    "SELECT user_id
     FROM users
     WHERE reset_token=?
     AND reset_expires > NOW()"
);

mysqli_stmt_bind_param($stmt, "s", $token);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) == 0) {
    die("This reset link is invalid or expired.");
}

$user = mysqli_fetch_assoc($result);

if (isset($_POST['reset_password'])) {

    $password = $_POST['password'];
    $confirm = $_POST['confirm_password'];

    if (strlen($password) < 6) {

        $message = "Password must contain at least 6 characters.";
        $message_type = "danger";

    } elseif ($password !== $confirm) {

        $message = "Passwords do not match.";
        $message_type = "danger";

    } else {

        $hashed_password = password_hash(
            $password,
            PASSWORD_DEFAULT
        );

        $update = mysqli_prepare(
            $conn,
            "UPDATE users
             SET password=?,
                 reset_token=NULL,
                 reset_expires=NULL
             WHERE user_id=?"
        );

        mysqli_stmt_bind_param(
            $update,
            "si",
            $hashed_password,
            $user['user_id']
        );

        mysqli_stmt_execute($update);

        $message =
            "Password reset successfully. You can now login.";

        $message_type = "success";
    }
}

?>

<!DOCTYPE html>
<html>

<head>

<title>Reset Password | InternLink</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet">

</head>

<body>

<div class="container py-5">

<div class="row justify-content-center">

<div class="col-md-5">

<div class="card shadow">

<div class="card-body p-4">

<h3 class="fw-bold mb-4">
Reset Password
</h3>

<?php if ($message != "") { ?>

<div class="alert alert-<?php echo $message_type; ?>">

<?php echo $message; ?>

</div>

<?php } ?>

<form method="POST">

<div class="mb-3">

<label class="form-label">
New Password
</label>

<input
type="password"
name="password"
class="form-control"
minlength="6"
required>

</div>

<div class="mb-3">

<label class="form-label">
Confirm Password
</label>

<input
type="password"
name="confirm_password"
class="form-control"
minlength="6"
required>

</div>

<button
type="submit"
name="reset_password"
class="btn btn-primary w-100">

Reset Password

</button>

</form>

</div>

</div>

</div>

</div>

</div>

</body>

</html>
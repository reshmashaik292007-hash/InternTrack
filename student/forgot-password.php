<?php

include("../config/db.php");

$message = "";
$message_type = "";

if (isset($_POST['send_reset'])) {

    $email = trim($_POST['email']);

    $stmt = mysqli_prepare(
        $conn,
        "SELECT user_id FROM users
         WHERE email=? AND role='student'"
    );

    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if ($user = mysqli_fetch_assoc($result)) {

        $token = bin2hex(random_bytes(32));

        $expires = date(
            "Y-m-d H:i:s",
            time() + 3600
        );

        $update = mysqli_prepare(
            $conn,
            "UPDATE users
             SET reset_token=?, reset_expires=?
             WHERE user_id=?"
        );

        mysqli_stmt_bind_param(
            $update,
            "ssi",
            $token,
            $expires,
            $user['user_id']
        );

        mysqli_stmt_execute($update);

        $reset_link =
            "http://localhost/InternTrack/student/reset-password.php?token="
            . $token;

        $message =
            "Reset link generated. For local testing, open this link: "
            . $reset_link;

        $message_type = "success";

    } else {

        $message =
            "If the email exists, a reset link will be generated.";

        $message_type = "info";
    }
}

?>

<!DOCTYPE html>
<html>

<head>

<title>Forgot Password | InternLink</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet">

</head>

<body>

<div class="container py-5">

<div class="row justify-content-center">

<div class="col-md-5">

<div class="card shadow">

<div class="card-body p-4">

<h3 class="fw-bold mb-3">
Forgot Password
</h3>

<p class="text-muted">
Enter your registered email address.
</p>

<?php if ($message != "") { ?>

<div class="alert alert-<?php echo $message_type; ?>">

<?php echo $message; ?>

</div>

<?php } ?>

<form method="POST">

<div class="mb-3">

<label class="form-label">
Email Address
</label>

<input
type="email"
name="email"
class="form-control"
required>

</div>

<button
type="submit"
name="send_reset"
class="btn btn-primary w-100">

Send Reset Link

</button>

</form>

<div class="text-center mt-3">

<a href="login.php">
Back to Login
</a>

</div>

</div>

</div>

</div>

</div>

</div>

</body>

</html>
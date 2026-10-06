<?php

session_start();
include("../config/db.php");

if (!isset($_SESSION['student_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['student_id'];

$query = mysqli_query(
    $conn,
    "SELECT *
     FROM notifications
     WHERE user_id='$user_id'
     ORDER BY created_at DESC"
);

/* Mark notifications as read */
mysqli_query(
    $conn,
    "UPDATE notifications
     SET is_read=1
     WHERE user_id='$user_id'"
);

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
      content="width=device-width, initial-scale=1.0">

<title>Notifications | InternLink</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet">

<link rel="stylesheet"
      href="../assets/css/style.css">

</head>

<body>

<nav class="navbar navbar-dark bg-primary">

<div class="container">

<a class="navbar-brand fw-bold"
   href="dashboard.php">

InternLink

</a>

</div>

</nav>

<section class="py-5">

<div class="container">

<h2 class="fw-bold mb-4">
🔔 Notifications
</h2>

<?php

if (mysqli_num_rows($query) > 0) {

while ($row = mysqli_fetch_assoc($query)) {

?>

<div class="alert alert-info">

<strong>
🔔 Notification
</strong>

<br>

<?php echo htmlspecialchars($row['message']); ?>

<br>

<small class="text-muted">

<?php echo date(
    "d M Y, h:i A",
    strtotime($row['created_at'])
); ?>

</small>

</div>

<?php

}

} else {

?>

<div class="alert alert-secondary">

No notifications yet.

</div>

<?php } ?>

</div>

</section>

</body>

</html>
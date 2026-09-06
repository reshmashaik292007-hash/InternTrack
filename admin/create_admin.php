<?php
// admin/create_admin.php
// SECURITY: This script is CLI-only. It is not reachable via a web browser.
// Usage: php create_admin.php "admin@example.com" "StrongP@ssw0rd" "Admin Full Name"

if (php_sapi_name() !== 'cli') {
    http_response_code(403);
    die("Forbidden. This script must be run from the command line.");
}

if ($argc < 3) {
    die("Usage: php create_admin.php <email> <password> [\"Full Name\"]\n");
}

$email    = trim($argv[1]);
$password = $argv[2];
$fullName = isset($argv[3]) ? trim($argv[3]) : 'Administrator';

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Invalid email address.\n");
}
if (strlen($password) < 8) {
    die("Password must be at least 8 characters.\n");
}

include(__DIR__ . "/../config/db.php");

$stmt = mysqli_prepare($conn, "SELECT user_id FROM users WHERE email = ?");
mysqli_stmt_bind_param($stmt, "s", $email);
mysqli_stmt_execute($stmt);
mysqli_stmt_store_result($stmt);

if (mysqli_stmt_num_rows($stmt) > 0) {
    die("A user with this email already exists.\n");
}
mysqli_stmt_close($stmt);

$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

$stmt = mysqli_prepare($conn, "INSERT INTO users(email, password, role, status) VALUES (?, ?, 'admin', 'active')");
mysqli_stmt_bind_param($stmt, "ss", $email, $hashedPassword);

if (!mysqli_stmt_execute($stmt)) {
    die("Failed to create user: " . mysqli_error($conn) . "\n");
}

$user_id = mysqli_insert_id($conn);
mysqli_stmt_close($stmt);

$stmt = mysqli_prepare($conn, "INSERT INTO admins(user_id, full_name) VALUES (?, ?)");
mysqli_stmt_bind_param($stmt, "is", $user_id, $fullName);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

echo "Admin account created successfully for {$email}.\n";
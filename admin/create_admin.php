<?php
include("../config/db.php");

$password = password_hash("admin123", PASSWORD_DEFAULT);

mysqli_query($conn,"INSERT INTO users(email,password,role,status)
VALUES('admin@gmail.com','$password','admin','active')");

$user_id = mysqli_insert_id($conn);

mysqli_query($conn,"INSERT INTO admins(user_id,full_name)
VALUES('$user_id','Administrator')");

echo "Admin Created Successfully";
?>
<?php
/**
 * InternTrack Database Setup Script - Fixed Version
 * This script creates the database and imports the schema properly
 */

// Connect to MySQL without specifying database
$host = "localhost";
$username = "root";
$password = "";

$conn = mysqli_connect($host, $username, $password);

if (!$conn) {
    die("Database Connection Failed: " . mysqli_connect_error());
}

// Read the SQL file
$sql_file = __DIR__ . '/database/interntrack.sql';

if (!file_exists($sql_file)) {
    die("SQL file not found: " . $sql_file);
}

$sql_content = file_get_contents($sql_file);

// Execute the entire SQL file at once using multi_query
if (mysqli_multi_query($conn, $sql_content)) {
    // Process all results
    do {
        // Store first result set
        if ($result = mysqli_store_result($conn)) {
            mysqli_free_result($result);
        }
    } while (mysqli_next_result($conn));

    $setup_success = true;
    $error_message = "";
} else {
    $setup_success = false;
    $error_message = mysqli_error($conn);
}

mysqli_close($conn);

// Output results
?>
<!DOCTYPE html>
<html>
<head>
    <title>InternTrack Database Setup</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            background: #f5f5f5;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .success {
            color: #155724;
            padding: 15px;
            background: #d4edda;
            margin: 20px 0;
            border: 1px solid #c3e6cb;
            border-radius: 5px;
        }
        .error {
            color: #721c24;
            padding: 15px;
            background: #f8d7da;
            margin: 20px 0;
            border: 1px solid #f5c6cb;
            border-radius: 5px;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 10px;
        }
        .btn:hover {
            background: #0056b3;
        }
        h1 {
            color: #333;
            margin-bottom: 10px;
        }
        pre {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            overflow-x: auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🔧 InternTrack Database Setup</h1>

        <?php if ($setup_success): ?>
            <div class="success">
                <h2>✅ Database Setup Successful!</h2>
                <p>The <strong>interntrack</strong> database has been created with all required tables.</p>
                <ul>
                    <li>✓ Database created</li>
                    <li>✓ Tables created (users, students, companies, internships, applications, etc.)</li>
                    <li>✓ Initial database schema and categories initialized</li>
                    <li>✓ Indexes and relationships configured</li>
                </ul>
                <p><strong>Default Login Credentials:</strong></p>
                <ul>
                    <li><strong>Admin:</strong> admin@interntrack.com / password123</li>
                    <li><strong>Student:</strong> rahul.sharma@gmail.com / password123</li>
                    <li><strong>Company:</strong> Register a new company account via <a href="company/register.php">Company Register</a></li>
                </ul>
                <a href="index.php" class="btn">Go to Application →</a>
            </div>
        <?php else: ?>
            <div class="error">
                <h2>❌ Database Setup Failed</h2>
                <p>There was an error setting up the database:</p>
                <pre><?php echo htmlspecialchars($error_message); ?></pre>
                <p><strong>Please ensure:</strong></p>
                <ul>
                    <li>XAMPP is running</li>
                    <li>MySQL service is started</li>
                    <li>No syntax errors in database/interntrack.sql</li>
                </ul>
                <a href="setup_database.php" class="btn">Try Again</a>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>

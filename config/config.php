<?php
/**
 * InternTrack Global Configuration
 * Application-wide constants and settings
 */

// Database Configuration (imported from db.php)
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'interntrack');

// Application Settings
define('APP_NAME', 'InternTrack');
define('APP_URL', 'http://localhost/InternTrack');

// File Upload Settings
define('UPLOAD_DIR', __DIR__ . '/../uploads/');
define('RESUME_DIR', UPLOAD_DIR . 'resumes/');
define('LOGO_DIR', UPLOAD_DIR . 'logos/');
define('PROFILE_PIC_DIR', UPLOAD_DIR . 'profile_pics/');

// Max file sizes (in bytes)
define('MAX_RESUME_SIZE', 5 * 1024 * 1024); // 5MB
define('MAX_IMAGE_SIZE', 2 * 1024 * 1024); // 2MB

// Allowed file types
define('ALLOWED_RESUME_TYPES', ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document']);
define('ALLOWED_IMAGE_TYPES', ['image/jpeg', 'image/png', 'image/jpg']);

// Session Settings
define('SESSION_TIMEOUT', 3600); // 1 hour in seconds

// Pagination
define('ITEMS_PER_PAGE', 10);
define('INTERNSHIPS_PER_PAGE', 12);

// Date Format
define('DATE_FORMAT', 'Y-m-d');
define('DATETIME_FORMAT', 'Y-m-d H:i:s');
define('DISPLAY_DATE_FORMAT', 'd M Y');

// Application Status
define('STATUS_APPLIED', 'applied');
define('STATUS_SHORTLISTED', 'shortlisted');
define('STATUS_ACCEPTED', 'accepted');
define('STATUS_REJECTED', 'rejected');

// User Roles
define('ROLE_ADMIN', 'admin');
define('ROLE_STUDENT', 'student');
define('ROLE_COMPANY', 'company');

// Error Reporting (set to 0 in production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Timezone
date_default_timezone_set('Asia/Kolkata');
?>

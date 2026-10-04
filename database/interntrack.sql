-- InternTrack: Internship Portal & Application Tracking System
-- Senior Database Architect Design
-- Target: MySQL 8.0+ / XAMPP / phpMyAdmin

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- ---------------------------------------------------------
-- 1. DATABASE INITIALIZATION
-- ---------------------------------------------------------
DROP DATABASE IF EXISTS interntrack;
CREATE DATABASE interntrack CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE interntrack;

-- ---------------------------------------------------------
-- 2. TABLE STRUCTURES
-- ---------------------------------------------------------

-- Users Table (Authentication Hub)
CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(191) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'student', 'company') NOT NULL,
    status ENUM('active', 'inactive', 'pending') DEFAULT 'active',
    last_login TIMESTAMP NULL DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Admins Table
CREATE TABLE admins (
    admin_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL UNIQUE,
    full_name VARCHAR(100) NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;

-- Students Table
CREATE TABLE students (
    student_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL UNIQUE,
    full_name VARCHAR(100) NOT NULL,
    phone VARCHAR(20) UNIQUE,
    resume_path VARCHAR(500),
    profile_pic VARCHAR(500) DEFAULT 'default_student.png',
    bio TEXT,
    college_name VARCHAR(150),
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;

-- Companies Table
CREATE TABLE companies (
    company_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL UNIQUE,
    company_name VARCHAR(150) NOT NULL,
    website VARCHAR(255),
    description TEXT,
    location VARCHAR(255),
    logo VARCHAR(500) DEFAULT 'default_logo.png',
    is_featured BOOLEAN DEFAULT FALSE,
    is_verified BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE ON UPDATE CASCADE,
    FULLTEXT INDEX idx_company_search (company_name)
) ENGINE=InnoDB;

-- Internship Categories Table
CREATE TABLE categories (
    category_id INT AUTO_INCREMENT PRIMARY KEY,
    category_name VARCHAR(100) NOT NULL UNIQUE
) ENGINE=InnoDB;

-- Internships Table
CREATE TABLE internships (
    internship_id INT AUTO_INCREMENT PRIMARY KEY,
    company_id INT NOT NULL,
    category_id INT NOT NULL,
    title VARCHAR(150) NOT NULL,
    description TEXT NOT NULL,
    requirements TEXT,
    location_type ENUM('Remote', 'On-site', 'Hybrid') DEFAULT 'On-site',
    duration VARCHAR(50),
    stipend VARCHAR(50) DEFAULT 'Unpaid',
    min_stipend_value INT DEFAULT 0,
    deadline DATE NOT NULL,
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (company_id) REFERENCES companies(company_id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (category_id) REFERENCES categories(category_id) ON DELETE RESTRICT ON UPDATE CASCADE,
    INDEX idx_intern_filters (is_active, deadline, min_stipend_value),
    FULLTEXT INDEX idx_intern_search (title, description, requirements)
) ENGINE=InnoDB;

-- Applications Table (Application Tracking System Core)
CREATE TABLE applications (
    application_id INT AUTO_INCREMENT PRIMARY KEY,
    internship_id INT NOT NULL,
    student_id INT NOT NULL,
    status ENUM('applied', 'shortlisted', 'accepted', 'rejected') DEFAULT 'applied',
    admin_remarks TEXT,
    applied_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    UNIQUE KEY unique_application (internship_id, student_id),
    FOREIGN KEY (internship_id) REFERENCES internships(internship_id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (student_id) REFERENCES students(student_id) ON DELETE CASCADE ON UPDATE CASCADE,
    INDEX idx_app_status (status)
) ENGINE=InnoDB;

-- Saved Internships (Wishlist)
CREATE TABLE saved_internships (
    save_id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT NOT NULL,
    internship_id INT NOT NULL,
    saved_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE KEY unique_save (student_id, internship_id),
    FOREIGN KEY (student_id) REFERENCES students(student_id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (internship_id) REFERENCES internships(internship_id) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;

-- Notifications Table
CREATE TABLE notifications (
    notification_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    message TEXT NOT NULL,
    is_read BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE ON UPDATE CASCADE,
    INDEX idx_notif_user_read (user_id, is_read)
) ENGINE=InnoDB;

-- Public Contact Messages Table
CREATE TABLE contact_messages (
    message_id INT AUTO_INCREMENT PRIMARY KEY,
    sender_name VARCHAR(100) NOT NULL,
    sender_email VARCHAR(191) NOT NULL,
    subject VARCHAR(255),
    message TEXT NOT NULL,
    is_resolved BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_resolved (is_resolved)
) ENGINE=InnoDB;

-- ---------------------------------------------------------
-- 3. SEED DATA (Realistic Samples)
-- ---------------------------------------------------------

-- Categories
INSERT INTO categories (category_name) VALUES 
('Web Development'), ('Mobile App Development'), ('UI/UX Design'), 
('Data Science'), ('Digital Marketing'), ('Content Writing'), ('Graphics Design');

-- Users (Password is 'password123' hashed)
INSERT INTO users (email, password, role, status) VALUES
('admin@interntrack.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin', 'active'),
('rahul.sharma@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'student', 'active'),
('priya.verma@yahoo.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'student', 'active'),
('amit.patel@outlook.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'student', 'active'),
('sneha.reddy@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'student', 'active'),
('aniket.singh@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'student', 'active'),
('pooja.nair@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'student', 'active'),
('vikram.rao@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'student', 'active'),
('ishita.gupta@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'student', 'active'),
('rohan.mehta@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'student', 'active'),
('kavya.iyer@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'student', 'active');

-- Profiles
INSERT INTO admins (user_id, full_name) VALUES (1, 'System Administrator');

INSERT INTO students (user_id, full_name, phone, college_name, bio) VALUES
(2, 'Rahul Sharma', '9876543210', 'IIT Delhi', 'Full Stack Developer.'),
(3, 'Priya Verma', '9876543211', 'NIT Trichy', 'UI/UX Designer.'),
(4, 'Amit Patel', '9876543212', 'BITS Pilani', 'Data Scientist.'),
(5, 'Sneha Reddy', '9876543213', 'VIT Vellore', 'Mobile Developer.'),
(6, 'Aniket Singh', '9876543214', 'DTU Delhi', 'Backend Engineer.'),
(7, 'Pooja Nair', '9876543215', 'SRM University', 'Digital Marketer.'),
(8, 'Vikram Rao', '9876543216', 'RV College', 'Graphic Designer.'),
(9, 'Ishita Gupta', '9876543217', 'Amity University', 'Content Writer.'),
(10, 'Rohan Mehta', '9876543218', 'COEP Pune', 'QA Engineer.'),
(11, 'Kavya Iyer', '9876543219', 'Anna University', 'DevOps Enthusiast.');

-- No seed companies - allow users to register companies
-- No seed internships - allow companies to post internships
-- No seed applications - generated only by user submissions
-- No seed saved internships - generated only by user actions
-- No seed notifications - generated only by system events
-- No seed contact messages - submitted only by users

-- ---------------------------------------------------------
-- 4. VERIFICATION
-- ---------------------------------------------------------
SELECT 'Database Setup Complete' AS Status;
SELECT COUNT(*) AS UserCount FROM users;
SELECT COUNT(*) AS InternshipCount FROM internships;

COMMIT;

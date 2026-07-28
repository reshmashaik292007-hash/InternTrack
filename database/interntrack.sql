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
('kavya.iyer@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'student', 'active'),
('hr@tcs.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'company', 'active'),
('careers@zomato.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'company', 'active'),
('hiring@razorpay.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'company', 'active'),
('jobs@infosys.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'company', 'active'),
('talent@swiggy.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'company', 'active');

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

INSERT INTO companies (user_id, company_name, website, location, is_featured) VALUES
(12, 'Tata Consultancy Services', 'https://www.tcs.com', 'Mumbai', TRUE),
(13, 'Zomato', 'https://www.zomato.com', 'Gurugram', TRUE),
(14, 'Razorpay', 'https://www.razorpay.com', 'Bengaluru', TRUE),
(15, 'Infosys', 'https://www.infosys.com', 'Bengaluru', FALSE),
(16, 'Swiggy', 'https://www.swiggy.com', 'Bengaluru', TRUE);

-- Internships
INSERT INTO internships (company_id, category_id, title, description, requirements, location_type, duration, stipend, min_stipend_value, deadline) VALUES
(1, 1, 'Web Dev Intern', 'PHP work.', 'PHP, MySQL.', 'Hybrid', '6 Months', '₹15,000', 15000, '2025-12-31'),
(1, 4, 'Data Analyst', 'SQL work.', 'Python, SQL.', 'On-site', '3 Months', '₹12,000', 12000, '2025-12-31'),
(2, 3, 'Product Design', 'Figma work.', 'Figma.', 'Remote', '4 Months', '₹25,000', 25000, '2025-12-31'),
(2, 5, 'Marketing Intern', 'SEO work.', 'SEO.', 'On-site', '3 Months', '₹20,000', 20000, '2025-12-31'),
(3, 1, 'Backend Intern', 'API work.', 'Node.js.', 'Hybrid', '6 Months', '₹40,000', 40000, '2025-12-31'),
(3, 1, 'Frontend Intern', 'React work.', 'React.', 'Remote', '6 Months', '₹35,000', 35000, '2025-12-31'),
(4, 1, 'Full Stack Intern', 'MERN work.', 'MERN.', 'On-site', '6 Months', '₹10,000', 10000, '2025-12-31'),
(4, 4, 'ML Intern', 'AI work.', 'Python.', 'On-site', '6 Months', '₹18,000', 18000, '2025-12-31'),
(5, 2, 'Android Intern', 'App work.', 'Kotlin.', 'Hybrid', '4 Months', '₹30,000', 30000, '2025-12-31'),
(5, 7, 'Creative Visualizer', 'Design work.', 'Photoshop.', 'Remote', '2 Months', '₹15,000', 15000, '2025-12-31'),
(1, 1, 'Java Intern', 'Java work.', 'Java.', 'On-site', '6 Months', '₹15,000', 15000, '2025-12-31'),
(2, 6, 'Tech Writer', 'Docs work.', 'English.', 'Remote', '3 Months', '₹10,000', 10000, '2025-12-31'),
(3, 4, 'Data Eng Intern', 'ETL work.', 'Spark.', 'Hybrid', '6 Months', '₹45,000', 45000, '2025-12-31'),
(4, 5, 'SEO Intern', 'Search work.', 'Analytics.', 'Remote', '3 Months', 'Unpaid', 0, '2025-12-31'),
(5, 1, 'Vue.js Intern', 'JS work.', 'Vue.', 'On-site', '6 Months', '₹28,000', 28000, '2025-12-31'),
(1, 2, 'iOS Intern', 'Swift work.', 'Swift.', 'On-site', '6 Months', '₹15,000', 15000, '2025-12-31'),
(2, 3, 'User Research', 'UX work.', 'Empathy.', 'Remote', '2 Months', '₹20,000', 20000, '2025-12-31'),
(3, 1, 'Security Intern', 'Pen-test.', 'Security.', 'Hybrid', '6 Months', '₹50,000', 50000, '2025-12-31'),
(4, 7, 'Motion Graphics', 'Video work.', 'AE.', 'Remote', '3 Months', '₹12,500', 12500, '2025-12-31'),
(5, 4, 'Python Intern', 'Scraping.', 'Python.', 'Hybrid', '4 Months', '₹22,000', 22000, '2025-12-31');

-- Applications
INSERT INTO applications (internship_id, student_id, status) VALUES
(1, 1, 'applied'), (5, 1, 'shortlisted'), (3, 2, 'accepted'), (10, 2, 'applied'),
(7, 3, 'applied'), (8, 3, 'rejected'), (13, 4, 'applied'), (5, 4, 'applied'),
(9, 5, 'shortlisted'), (15, 5, 'applied'), (2, 6, 'applied'), (11, 6, 'applied'),
(4, 7, 'applied'), (14, 7, 'applied'), (19, 8, 'shortlisted'), (20, 8, 'applied'),
(12, 9, 'applied'), (6, 9, 'accepted'), (18, 10, 'applied'), (1, 10, 'rejected');

-- Saved
INSERT INTO saved_internships (student_id, internship_id) VALUES
(1, 3), (1, 6), (2, 5), (3, 13), (4, 1), (5, 8), (6, 9), (7, 10), (8, 4), (9, 18);

-- Notifications
INSERT INTO notifications (user_id, message) VALUES
(2, 'Application received.'), (2, 'Shortlisted for Razorpay!'), (3, 'Accepted at Zomato!'),
(4, 'TCS viewed profile.'), (5, 'Application rejected.'), (6, 'New job: Infosys.'),
(12, '5 new applicants.'), (13, 'New applicant for Design.'), (7, 'Swiggy viewed profile.'),
(8, 'Shortlisted at Infosys.'), (9, 'Accepted at Razorpay.'), (10, 'Rejected at TCS.'),
(2, 'Interview tomorrow.'), (4, 'Deadline extended.'), (14, 'Applicant withdrawn.');

-- Public Messages
INSERT INTO contact_messages (sender_name, sender_email, subject, message) VALUES
('Rajesh', 'rajesh@gmail.com', 'Login Issue', 'Cannot access my dashboard.'),
('Anita', 'anita@outlook.com', 'Verification', 'How long for company approval?'),
('Suresh', 'suresh@tcs.com', 'Post Update', 'Need to change deadline.'),
('Megha', 'megha@gmail.com', 'Resume', 'PDF upload not working.'),
('Vijay', 'vijay@m.com', 'Fake Job', 'Found a suspicious listing.'),
('Kiran', 'kiran@b.com', 'Hiring', 'Bulk hiring inquiry.'),
('Arjun', 'arjun@gmail.com', 'Account', 'Delete my account.'),
('Divya', 'divya@yahoo.com', 'Feature', 'Love the tracking feature.'),
('Manish', 'manish@gmail.com', 'UI Bug', 'Search is broken on Safari.'),
('Shikha', 'shikha@s.com', 'Pricing', 'Is premium listing free?');

-- ---------------------------------------------------------
-- 4. VERIFICATION
-- ---------------------------------------------------------
SELECT 'Database Setup Complete' AS Status;
SELECT COUNT(*) AS UserCount FROM users;
SELECT COUNT(*) AS InternshipCount FROM internships;

COMMIT;

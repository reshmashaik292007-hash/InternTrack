<?php
/**
 * InternTrack — Shared Validation Functions
 * Used by student/register.php and company/register.php (and later, profile-update forms).
 * Each function returns an empty string "" if valid, or an error message string if invalid.
 */

function validateName($name)
{
    $name = trim($name);

    if ($name === '') {
        return "Name is required.";
    }
    if (strlen($name) < 3) {
        return "Name must be at least 3 characters.";
    }
    if (strlen($name) > 50) {
        return "Name must not exceed 50 characters.";
    }
    if (!preg_match('/^[A-Za-z ]+$/', $name)) {
        return "Name can only contain alphabets and spaces.";
    }
    return "";
}

function validateEmail($email)
{
    $email = trim($email);

    if ($email === '') {
        return "Email is required.";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return "Please enter a valid email address.";
    }
    return "";
}

function validatePassword($password)
{
    if ($password === '') {
        return "Password is required.";
    }
    if (strlen($password) < 8) {
        return "Password must be at least 8 characters.";
    }
    if (strlen($password) > 64) {
        return "Password must not exceed 64 characters.";
    }
    if (strpos($password, ' ') !== false) {
        return "Password must not contain spaces.";
    }
    if (!preg_match('/[A-Z]/', $password)) {
        return "Password must contain at least 1 uppercase letter.";
    }
    if (!preg_match('/[a-z]/', $password)) {
        return "Password must contain at least 1 lowercase letter.";
    }
    if (!preg_match('/[0-9]/', $password)) {
        return "Password must contain at least 1 number.";
    }
    if (!preg_match('/[^A-Za-z0-9]/', $password)) {
        return "Password must contain at least 1 special character.";
    }
    return "";
}

/**
 * Normalizes an email for storage: trims whitespace and lowercases it.
 * Call this right before inserting/querying by email.
 */
function normalizeEmail($email)
{
    return strtolower(trim($email));
}
<?php
/**
 * Email Configuration
 * 
 * Configure your SMTP settings here for sending emails.
 * Common providers:
 * 
 * Gmail:
 *   SMTP_HOST = 'smtp.gmail.com'
 *   SMTP_PORT = 587
 *   SMTP_USERNAME = 'your-email@gmail.com'
 *   SMTP_PASSWORD = 'your-app-password' (use App Password, not regular password)
 * 
 * Outlook/Hotmail:
 *   SMTP_HOST = 'smtp-mail.outlook.com'
 *   SMTP_PORT = 587
 * 
 * Yahoo:
 *   SMTP_HOST = 'smtp.mail.yahoo.com'
 *   SMTP_PORT = 587
 * 
 * Custom SMTP (from your hosting provider):
 *   Use the SMTP details provided by your hosting company
 */

// SMTP Configuration
define('SMTP_ENABLED', true); // Set to false to disable email sending (will still save to file)
define('SMTP_HOST', 'smtp.gmail.com');
define('SMTP_PORT', 587);
define('SMTP_SECURE', 'tls'); // 'tls' or 'ssl'
define('SMTP_AUTH', true);
define('SMTP_USERNAME', 'katupaosakaria@gmail.com'); // Your email address - UPDATE THIS with your actual Gmail
define('SMTP_PASSWORD', 'wvxfpecegpljygwu'); // App password (spaces removed - Gmail app passwords should not have spaces)

// Email Settings
define('EMAIL_FROM_ADDRESS', 'katupaosakaria@gmail.com'); // Email address to send from
define('EMAIL_FROM_NAME', 'Yvonne Hangara Website'); // Display name
define('EMAIL_TO_ADDRESS', 'katupaosakaria@gmail.com'); // Where to send contact form messages
define('EMAIL_TO_NAME', 'Yvonne Hangara'); // Recipient display name

// Enable debug mode (set to false in production)
define('SMTP_DEBUG', false); // 0 = off, 1 = client messages, 2 = client and server messages

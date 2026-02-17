<?php
/**
 * Email Configuration Template
 * 
 * Copy this file to config-email.php and update with your actual email settings
 * 
 * IMPORTANT: config-email.php is in .gitignore to protect your credentials
 */

// SMTP Configuration
define('SMTP_ENABLED', true);
define('SMTP_HOST', 'smtp.gmail.com');
define('SMTP_PORT', 587);
define('SMTP_SECURE', 'tls'); // 'tls' or 'ssl'
define('SMTP_AUTH', true);
define('SMTP_USERNAME', 'your-email@gmail.com'); // UPDATE THIS
define('SMTP_PASSWORD', 'your-app-password'); // UPDATE THIS

// Email Settings
define('EMAIL_FROM_ADDRESS', 'your-email@gmail.com'); // UPDATE THIS
define('EMAIL_FROM_NAME', 'Yvonne Hangara Website');
define('EMAIL_TO_ADDRESS', 'katupaosakaria@gmail.com'); // Where contact form messages go
define('EMAIL_TO_NAME', 'Yvonne Hangara');

// Enable debug mode (set to false in production)
define('SMTP_DEBUG', false); // 0 = off, 1 = client messages, 2 = client and server messages

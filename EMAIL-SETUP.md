# Email Setup Instructions

This guide will help you configure email sending for the contact form on your website.

## Step 1: Install PHPMailer

You have two options:

### Option A: Using Composer (Recommended)

1. **Install Composer** (if not already installed):
   - Download from: https://getcomposer.org/download/
   - Or if you have PHP installed, run: `php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"`
   - Then run: `php composer-setup.php`

2. **Install PHPMailer**:
   ```bash
   composer install
   ```

### Option B: Manual Installation

1. Download PHPMailer from: https://github.com/PHPMailer/PHPMailer/releases
2. Extract the ZIP file
3. Copy the `PHPMailer` folder to your project root directory (`c:\xampp\htdocs\Yvonne\`)

## Step 2: Configure Email Settings

1. Open `config-email.php` in your project
2. Update the following settings:

```php
// Your SMTP settings (examples below)
define('SMTP_HOST', 'smtp.gmail.com');        // Your email provider's SMTP server
define('SMTP_PORT', 587);                      // Usually 587 for TLS or 465 for SSL
define('SMTP_SECURE', 'tls');                  // 'tls' or 'ssl'
define('SMTP_USERNAME', 'your-email@gmail.com'); // Your email address
define('SMTP_PASSWORD', 'your-app-password');    // Your email password or app password
define('EMAIL_FROM_ADDRESS', 'your-email@gmail.com'); // Email to send from
define('EMAIL_FROM_NAME', 'Yvonne Hangara Website');   // Display name
define('EMAIL_TO_ADDRESS', 'katupaosakaria@gmail.com'); // Where contact form messages go
```

## Step 3: Email Provider Setup

### For Gmail:

1. **Enable 2-Step Verification** on your Google account
2. **Create an App Password**:
   - Go to: https://myaccount.google.com/apppasswords
   - Select "Mail" and "Other (Custom name)"
   - Enter "Website Contact Form"
   - Copy the 16-character password
   - Use this password in `SMTP_PASSWORD` (not your regular Gmail password)

3. **Settings**:
   ```
   SMTP_HOST = 'smtp.gmail.com'
   SMTP_PORT = 587
   SMTP_SECURE = 'tls'
   ```

### For Outlook/Hotmail:

1. **Settings**:
   ```
   SMTP_HOST = 'smtp-mail.outlook.com'
   SMTP_PORT = 587
   SMTP_SECURE = 'tls'
   ```

2. Use your regular email and password

### For Yahoo:

1. **Settings**:
   ```
   SMTP_HOST = 'smtp.mail.yahoo.com'
   SMTP_PORT = 587
   SMTP_SECURE = 'tls'
   ```

2. You may need to generate an app password in Yahoo account settings

### For Custom Hosting Provider:

Contact your hosting provider for SMTP settings. Common settings:
- SMTP_HOST: Usually something like `mail.yourdomain.com` or `smtp.yourdomain.com`
- SMTP_PORT: Usually 587 (TLS) or 465 (SSL)
- SMTP_USERNAME: Your email address or cPanel username
- SMTP_PASSWORD: Your email password

## Step 4: Test the Contact Form

1. Make sure `SMTP_ENABLED` is set to `true` in `config-email.php`
2. Fill out and submit the contact form on your website
3. Check the recipient email inbox
4. Check the `messages/` folder for backup copies

## Troubleshooting

### Email not sending?

1. **Check PHP error logs** - Look in XAMPP's `apache/logs/error.log`
2. **Enable debug mode** - Set `SMTP_DEBUG` to `2` in `config-email.php` temporarily
3. **Verify credentials** - Double-check username and password
4. **Check firewall** - Make sure port 587 or 465 is not blocked
5. **Test SMTP connection** - Use an SMTP testing tool online

### Common Errors:

- **"SMTP connect() failed"**: Check SMTP_HOST and SMTP_PORT
- **"Authentication failed"**: Check SMTP_USERNAME and SMTP_PASSWORD
- **"Could not instantiate mail function"**: PHPMailer not installed correctly

## Security Notes

- **Never commit `config-email.php` to git** - It contains sensitive credentials
- The file is already in `.gitignore` for your protection
- On production, consider using environment variables instead of a config file
- Keep your email passwords secure and use app passwords when possible

## Production Deployment

When deploying to your hosting:

1. Upload all files including `vendor/` folder (if using Composer)
2. Update `config-email.php` with production SMTP settings
3. Set `SMTP_DEBUG` to `false`
4. Test the contact form after deployment
5. Consider setting up email forwarding or using a dedicated email service

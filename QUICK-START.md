# Quick Start Guide - Email Setup

## Option 1: Install PHPMailer via Composer (Recommended)

### Step 1: Install Composer
1. Download Composer from: https://getcomposer.org/download/
2. Run the Windows installer (Composer-Setup.exe)
3. Follow the installation wizard
4. Restart your terminal/command prompt

### Step 2: Install PHPMailer
Open PowerShell or Command Prompt in your project folder and run:
```bash
cd c:\xampp\htdocs\Yvonne
composer install
```

This will create a `vendor/` folder with PHPMailer.

---

## Option 2: Manual PHPMailer Installation

If you prefer not to use Composer:

1. **Download PHPMailer**:
   - Go to: https://github.com/PHPMailer/PHPMailer/releases
   - Download the latest release ZIP file (e.g., `PHPMailer-6.x.x.zip`)

2. **Extract and Copy**:
   - Extract the ZIP file
   - Copy the `PHPMailer` folder to: `c:\xampp\htdocs\Yvonne\PHPMailer\`
   - The structure should be: `Yvonne/PHPMailer/src/PHPMailer.php`

---

## Step 3: Configure Email Settings

1. **Copy the example config**:
   - Copy `config-email.example.php` to `config-email.php`
   - Or edit the existing `config-email.php` file

2. **Update with your email settings**:
   ```php
   define('SMTP_USERNAME', 'your-email@gmail.com');
   define('SMTP_PASSWORD', 'your-app-password'); // For Gmail, use App Password
   define('EMAIL_FROM_ADDRESS', 'your-email@gmail.com');
   define('EMAIL_TO_ADDRESS', 'katupaosakaria@gmail.com');
   ```

### For Gmail Users:
- Enable 2-Step Verification
- Create an App Password: https://myaccount.google.com/apppasswords
- Use the 16-character app password (not your regular password)

---

## Step 4: Test

1. Make sure Apache is running in XAMPP
2. Open: `http://localhost/Yvonne/`
3. Fill out the contact form
4. Submit and check your email inbox
5. Check `messages/` folder for backup copies

---

## Need Help?

See `EMAIL-SETUP.md` for detailed instructions and troubleshooting.

<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$activePage = 'contact';
$pageTitle = 'Yvonne Hangara | Contact';
$pageDescription = 'Get in touch — send a message to Yvonne Hangara.';

// Load email configuration
require_once __DIR__ . '/config-email.php';

// Load PHPMailer (Composer or manual install)
if (file_exists(__DIR__ . '/vendor/autoload.php')) {
    require_once __DIR__ . '/vendor/autoload.php';
} else {
    $phpmailerPath = null;
    if (file_exists(__DIR__ . '/PHPMailer-7.0.2/src/Exception.php')) {
        $phpmailerPath = __DIR__ . '/PHPMailer-7.0.2/src';
    } elseif (file_exists(__DIR__ . '/PHPMailer/src/Exception.php')) {
        $phpmailerPath = __DIR__ . '/PHPMailer/src';
    }
    if ($phpmailerPath) {
        require_once $phpmailerPath . '/Exception.php';
        require_once $phpmailerPath . '/PHPMailer.php';
        require_once $phpmailerPath . '/SMTP.php';
    }
}

// Contact Form Processing
$formSuccess = false;
$formError = false;

$name = '';
$email = '';
$subject = '';
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['contact_submit'])) {
    $name = isset($_POST['name']) ? trim($_POST['name']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $subject = isset($_POST['subject']) ? trim($_POST['subject']) : '';
    $message = isset($_POST['message']) ? trim($_POST['message']) : '';

    $safeName = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
    $safeEmail = filter_var($email, FILTER_SANITIZE_EMAIL);
    $safeSubject = htmlspecialchars($subject, ENT_QUOTES, 'UTF-8');
    $safeMessage = htmlspecialchars($message, ENT_QUOTES, 'UTF-8');

    if (empty($safeName) || empty($safeEmail) || empty($safeSubject) || empty($safeMessage)) {
        $formError = 'All fields are required.';
    } elseif (!filter_var($safeEmail, FILTER_VALIDATE_EMAIL)) {
        $formError = 'Please provide a valid email address.';
    } else {
        // Save message to file (backup/archive)
        $messagesDir = __DIR__ . '/messages';
        if (!is_dir($messagesDir)) {
            mkdir($messagesDir, 0755, true);
        }

        $messageFile = $messagesDir . '/message_' . date('Y-m-d_H-i-s') . '_' . uniqid() . '.txt';
        $fileContent = 'Date: ' . date('Y-m-d H:i:s') . "\n";
        $fileContent .= "From: {$safeName} <{$safeEmail}>\n";
        $fileContent .= "Subject: {$safeSubject}\n";
        $fileContent .= 'To: ' . EMAIL_TO_ADDRESS . "\n";
        $fileContent .= str_repeat('=', 50) . "\n\n";
        $fileContent .= $safeMessage . "\n";

        $fileSaved = file_put_contents($messageFile, $fileContent);

        // Send email using PHPMailer
        $emailSent = false;
        $emailError = '';

        if (SMTP_ENABLED && class_exists('PHPMailer\\PHPMailer\\PHPMailer')) {
            try {
                $mail = new PHPMailer(true);
                $mail->isSMTP();
                $mail->Host = SMTP_HOST;
                $mail->SMTPAuth = SMTP_AUTH;
                $mail->Username = SMTP_USERNAME;
                $mail->Password = SMTP_PASSWORD;
                $mail->SMTPSecure = SMTP_SECURE;
                $mail->Port = SMTP_PORT;
                $mail->CharSet = 'UTF-8';

                // Local Windows/XAMPP SSL certificate verification can fail without a CA bundle.
                // Relax checks ONLY on localhost.
                $serverName = $_SERVER['SERVER_NAME'] ?? '';
                $isLocal = in_array($serverName, ['localhost', '127.0.0.1', '::1'], true);
                if ($isLocal) {
                    $mail->SMTPOptions = [
                        'ssl' => [
                            'verify_peer' => false,
                            'verify_peer_name' => false,
                            'allow_self_signed' => true,
                        ],
                    ];
                }

                if (SMTP_DEBUG) {
                    $mail->SMTPDebug = SMTP_DEBUG;
                    $mail->Debugoutput = function ($str, $level) {
                        error_log("PHPMailer: $str");
                    };
                }

                $mail->setFrom(EMAIL_FROM_ADDRESS, EMAIL_FROM_NAME);
                $mail->addAddress(EMAIL_TO_ADDRESS, EMAIL_TO_NAME);
                $mail->addReplyTo($safeEmail, $safeName);

                $mail->isHTML(true);
                $mail->Subject = 'Contact Form: ' . $safeSubject;

                $emailBodyHTML = "
                <html>
                <head>
                  <meta charset='UTF-8' />
                  <style>
                    body{font-family:Arial, sans-serif; line-height:1.6; color:#333;}
                    .container{max-width:600px; margin:0 auto; padding:20px;}
                    .header{background:#1a365d; color:#fff; padding:18px 20px; text-align:center;}
                    .content{background:#f9f9f9; padding:18px 20px;}
                    .label{font-weight:bold; color:#1a365d;}
                    .box{background:#fff; padding:12px 14px; border-left:4px solid #1a365d; margin-top:10px;}
                  </style>
                </head>
                <body>
                  <div class='container'>
                    <div class='header'><h2 style='margin:0;'>New Contact Form Message</h2></div>
                    <div class='content'>
                      <div><span class='label'>Name:</span> {$safeName}</div>
                      <div><span class='label'>Email:</span> {$safeEmail}</div>
                      <div><span class='label'>Subject:</span> {$safeSubject}</div>
                      <div class='box'>
                        <div class='label'>Message:</div>
                        <div>" . nl2br($safeMessage) . "</div>
                      </div>
                    </div>
                  </div>
                </body>
                </html>";

                $mail->Body = $emailBodyHTML;
                $mail->AltBody = "Name: {$safeName}\nEmail: {$safeEmail}\nSubject: {$safeSubject}\n\nMessage:\n{$safeMessage}";

                $mail->send();
                $emailSent = true;
            } catch (Exception $e) {
                $emailError = 'Email sending failed: ' . ($mail->ErrorInfo ?? $e->getMessage());
                error_log('PHPMailer Error: ' . $emailError);
            }
        } elseif (SMTP_ENABLED) {
            $emailError = 'PHPMailer is not installed. Please install it (Composer or manual).';
        }

        if ($fileSaved !== false && $emailSent) {
            $formSuccess = true;
        } elseif ($fileSaved !== false && SMTP_ENABLED && !empty($emailError)) {
            $formError = 'Your message was saved, but the email could not be sent. Please try again later.';
            error_log('Contact form: Message saved but email failed - ' . $emailError);
        } elseif ($fileSaved !== false) {
            $formError = 'Your message was saved, but email sending is not configured.';
        } else {
            $formError = 'Failed to save message. Please try again later.';
        }
    }
}

require __DIR__ . '/includes/header.php';
?>

<header class="page-header">
  <h1 class="page-title">Contact</h1>
  <p class="page-lead">Send a message and we’ll respond as soon as possible.</p>
</header>

<section class="card section">
  <?php if ($formSuccess): ?>
    <div class="alert alert--success">Thank you for your message! We will respond as soon as possible.</div>
  <?php endif; ?>

  <?php if ($formError): ?>
    <div class="alert alert--error"><?php echo htmlspecialchars((string)$formError); ?></div>
  <?php endif; ?>

  <form class="form" method="POST" action="contact.php" data-contact-form novalidate>
    <div class="field">
      <label for="name">Full Name *</label>
      <input type="text" id="name" name="name" required value="<?php echo htmlspecialchars($name); ?>" />
      <div class="hint" id="name-error">Please enter your full name</div>
    </div>

    <div class="field">
      <label for="email">Email Address *</label>
      <input type="email" id="email" name="email" required value="<?php echo htmlspecialchars($email); ?>" />
      <div class="hint" id="email-error">Please enter a valid email address</div>
    </div>

    <div class="field">
      <label for="subject">Subject *</label>
      <input type="text" id="subject" name="subject" required value="<?php echo htmlspecialchars($subject); ?>" />
      <div class="hint" id="subject-error">Please enter a subject</div>
    </div>

    <div class="field">
      <label for="message">Message *</label>
      <textarea id="message" name="message" required><?php echo htmlspecialchars($message); ?></textarea>
      <div class="hint" id="message-error">Please enter your message</div>
    </div>

    <button class="btn btn--primary" type="submit" name="contact_submit">Send Message</button>
  </form>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>


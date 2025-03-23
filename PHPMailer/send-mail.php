<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// Create instance of PHPMailer
$mail = new PHPMailer(true);

$message = ""; // Store success or error message

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST["name"]);
    $email = htmlspecialchars($_POST["email"]);
    $mobile = htmlspecialchars($_POST["mobile"]);
    $messageContent = nl2br(htmlspecialchars($_POST["message"]));

    $mail = new PHPMailer(true);

    try {
        // SMTP Configuration
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Your SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = 'your-email@gmail.com'; // Your email
        $mail->Password = 'your-email-password'; // Your email password or App Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Email Details
        $mail->setFrom($email, $name);
        $mail->addAddress('your-email@gmail.com'); // Your receiving email
        $mail->addReplyTo($email, $name);

        // Email Content
        $mail->isHTML(true);
        $mail->Subject = "New Contact Form Submission";
        $mail->Body = "<h3>New message from the website</h3>
                        <p><strong>Name:</strong> $name</p>
                        <p><strong>Email:</strong> $email</p>
                        <p><strong>Mobile:</strong> $mobile</p>
                        <p><strong>Message:</strong> $messageContent</p>";

        // Send email
        if ($mail->send()) {
            $message = "<p class='success'>Message Sent Successfully! Reloading...</p>";
        } else {
            $message = "<p class='error'>Failed to send message. Try again.</p>";
        }
    } catch (Exception $e) {
        $message = "<p class='error'>Mailer Error: {$mail->ErrorInfo}</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form</title>
    <style>
        .success { color: green; font-weight: bold; }
        .error { color: red; font-weight: bold; }
    </style>
    <script>
        // Reload the page after 3 seconds if form was submitted
        setTimeout(function(){
            if(document.getElementById('message-box')) {
                window.location.href = "index.php"; 
            }
        }, 3000);
    </script>
</head>
<body>

<!-- Show Success or Error Message -->
<div id="message-box">
    <?php echo $message; ?>
</div>

</body>
</html>

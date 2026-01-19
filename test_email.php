<?php
require __DIR__.'/vendor/autoload.php';
require __DIR__.'/bootstrap/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use PHPMailer\PHPMailer\PHPMailer;

$mail = new PHPMailer;
$mail->SMTPDebug = 2;
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = Config::get('systemsetting.WelcomeEmail');
$mail->Password = Config::get('systemsetting.WelcomeEmailPassword');
$mail->SMTPSecure = 'tls';
$mail->Port = 587;
$mail->setFrom('welcome@admissionx.info', 'Welcome to AdmissionX');
$mail->addAddress('rajsharma74411@outlook.com', 'Test');
$mail->isHTML(true);
$mail->Subject = 'Test Email';
$mail->Body = 'This is a test email';

if(!$mail->send()) {
    echo 'Email Error: ' . $mail->ErrorInfo;
} else {
    echo 'Email sent successfully!';
}

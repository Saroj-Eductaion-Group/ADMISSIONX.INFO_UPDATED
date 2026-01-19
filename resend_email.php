<?php
require __DIR__.'/vendor/autoload.php';
require __DIR__.'/bootstrap/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use PHPMailer\PHPMailer\PHPMailer;

$email = 'rajsharma74411@outlook.com';
$user = DB::table('users')->where('email', $email)->first();

if (!$user) {
    die("User not found\n");
}

$token = $user->token;
$verifyUrl = env('APP_URL') . '/verify-student-email-address/' . $token;

$mail = new PHPMailer;
$mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);

$mail->SMTPDebug = 2;
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = env('MAIL_USERNAME');
$mail->Password = env('MAIL_PASSWORD');
$mail->SMTPSecure = env('MAIL_ENCRYPTION');
$mail->Port = env('MAIL_PORT');
$mail->setFrom(env('MAIL_USERNAME'), 'Welcome to AdmissionX');
$mail->addAddress($email, 'AdmissionX');
$mail->isHTML(true);
$mail->Subject = 'Thank you for registering with AdmissionX';
$mail->Body = '<h2>Welcome to AdmissionX!</h2><p>Please verify your email by clicking the link below:</p><p><a href="'.$verifyUrl.'">'.$verifyUrl.'</a></p>';

if(!$mail->send()) {
    echo 'Email Error: ' . $mail->ErrorInfo . "\n";
} else {
    echo "Email sent successfully to: $email\n";
    echo "Verification link: $verifyUrl\n";
}

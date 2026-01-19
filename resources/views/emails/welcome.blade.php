<!DOCTYPE html>
<html>
<head>
    <title>Welcome to AdmissionX</title>
</head>
<body>
    <h2>Welcome to AdmissionX!</h2>
    <p>Hi {{ $user->name }},</p>
    <p>{{ env('SIGNUPMSG') }} {{ $user->email }}</p>
    <p>Thank you for joining us!</p>
    <br>
    <p>Best regards,<br>AdmissionX Team</p>
</body>
</html>

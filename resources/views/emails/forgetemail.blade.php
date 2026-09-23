<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
</head>

<body style="margin:0; padding:0; font-family:Arial, sans-serif; background:#f5f5f5;">

    <div style="max-width:600px; margin:40px auto; background:#ffffff; padding:30px; border-radius:10px;">

        <h2 style="color:#011810; margin-top:0;">
            Reset Your Password
        </h2>

        <p style="color:#555; font-size:15px;">
            Click the button below to reset your password.
        </p>

        <a href="{{ $data->link }}"
           style="
                display:inline-block;
                padding:12px 24px;
                background:#011810;
                color:#ffffff;
                text-decoration:none;
                border-radius:6px;
                font-weight:bold;
           ">
            Reset Password
        </a>

        <p style="color:#777; font-size:13px; margin-top:25px;">
            If you did not request a password reset, you can safely ignore this email.
        </p>

    </div>

</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <style>
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .container {
            background-color: #ffffff;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .logo {
            font-size: 24px;
            font-weight: bold;
            color: #2563eb;
            margin-bottom: 10px;
        }
        .title {
            font-size: 20px;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 20px;
        }
        .content {
            color: #4b5563;
            margin-bottom: 30px;
        }
        .button {
            display: inline-block;
            padding: 12px 30px;
            background: linear-gradient(to right, #2563eb, #9333ea);
            color: #ffffff;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 500;
            text-align: center;
            margin: 20px 0;
        }
        .button:hover {
            background: linear-gradient(to right, #1d4ed8, #7e22ce);
        }
        .link {
            color: #2563eb;
            word-break: break-all;
        }
        .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
            text-align: center;
            font-size: 12px;
            color: #6b7280;
        }
        .warning {
            background-color: #fef3c7;
            border-left: 4px solid #f59e0b;
            padding: 12px;
            margin: 20px 0;
            border-radius: 4px;
            font-size: 14px;
            color: #92400e;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">PT Wiraswasta Gemilang Indonesia</div>
        </div>
        
        <div class="title">Reset Password Request</div>
        
        <div class="content">
            <p>Hello {{ $user->name }},</p>
            
            <p>We received a request to reset your password for your account. Click the button below to reset your password:</p>
            
            <div style="text-align: center;">
                <a href="{{ url('/reset-password?token=' . $token . '&email=' . urlencode($user->email)) }}" class="button">
                    Reset Password
                </a>
            </div>
            
            <p>Or copy and paste this link into your browser:</p>
            <p class="link">{{ url('/reset-password?token=' . $token . '&email=' . urlencode($user->email)) }}</p>
            
            <div class="warning">
                <strong>⚠️ Security Notice:</strong> This link will expire in 60 minutes. If you did not request a password reset, please ignore this email.
            </div>
            
            <p>If you're having trouble clicking the button, copy and paste the URL above into your web browser.</p>
        </div>
        
        <div class="footer">
            <p>© {{ date('Y') }} PT Wiraswasta Gemilang Indonesia. All rights reserved.</p>
            <p>This is an automated message, please do not reply to this email.</p>
        </div>
    </div>
</body>
</html>


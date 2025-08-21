<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Contact Form Submission</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            line-height: 1.6;
            color: #374151;
            background-color: #f9fafb;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
        }
        .header {
            border-bottom: 1px solid #e5e7eb;
            padding-bottom: 20px;
            margin-bottom: 20px;
        }
        .logo {
            color: #FF2D20;
            font-weight: bold;
            font-size: 24px;
        }
        .content {
            margin-bottom: 20px;
        }
        .footer {
            border-top: 1px solid #e5e7eb;
            padding-top: 20px;
            font-size: 14px;
            color: #6b7280;
        }
        .message-box {
            background-color: #f3f4f6;
            padding: 15px;
            border-radius: 6px;
            margin-top: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">Laravel Sweden</div>
        </div>
        
        <div class="content">
            <h2>New Contact Form Submission</h2>
            <p>You have received a new message from the contact form on the Laravel Sweden website.</p>
            
            <h3>Contact Details:</h3>
            <p><strong>Name:</strong> {{ $name }}</p>
            <p><strong>Email:</strong> {{ $email }}</p>
            
            <h3>Message:</h3>
            <div class="message-box">
                {{ $messageContent }}
            </div>
        </div>
        
        <div class="footer">
            <p>This email was sent from the contact form on the Laravel Sweden website.</p>
            <p>&copy; {{ date('Y') }} Swedish Laravel Association</p>
        </div>
    </div>
</body>
</html>

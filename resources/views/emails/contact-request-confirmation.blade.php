<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>We received your message</title>
</head>
<body style="font-family: sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px;">
    <h1 style="font-size: 1.25rem; margin-bottom: 1rem;">Thank you for getting in touch</h1>
    <p>Hi {{ $contactRequest->name }},</p>
    <p>We have received your message and will get back to you as soon as we can, usually within one business day.</p>
    <p style="font-weight: 600;">Your message ({{ $contactRequest->subject_label }}):</p>
    <p style="white-space: pre-wrap; background: #f5f5f5; padding: 1rem; border-radius: 4px;">{{ $contactRequest->message }}</p>
    <p>If you have any urgent questions in the meantime, please don’t hesitate to contact us again.</p>
    <p>Thanks,<br>{{ config('app.name') }}</p>
</body>
</html>

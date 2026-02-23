<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New contact request</title>
</head>
<body style="font-family: sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px;">
    <h1 style="font-size: 1.25rem; margin-bottom: 1rem;">New contact request</h1>
    <p>You have received a new message from the contact form.</p>
    <table style="width: 100%; border-collapse: collapse; margin: 1rem 0;">
        <tr><td style="padding: 0.25rem 0; font-weight: 600;">Name:</td><td>{{ $contactRequest->name }}</td></tr>
        <tr><td style="padding: 0.25rem 0; font-weight: 600;">Email:</td><td>{{ $contactRequest->email }}</td></tr>
        @if($contactRequest->company)
        <tr><td style="padding: 0.25rem 0; font-weight: 600;">Company:</td><td>{{ $contactRequest->company }}</td></tr>
        @endif
        <tr><td style="padding: 0.25rem 0; font-weight: 600;">Subject:</td><td>{{ $contactRequest->subject_label }}</td></tr>
    </table>
    <p style="font-weight: 600;">Message:</p>
    <p style="white-space: pre-wrap; background: #f5f5f5; padding: 1rem; border-radius: 4px;">{{ $contactRequest->message }}</p>
    <p style="margin-top: 1.5rem; font-size: 0.875rem; color: #666;">You can reply directly to this email to respond to {{ $contactRequest->name }}.</p>
</body>
</html>

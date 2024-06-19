<!-- resources/views/emails/registration.blade.php -->

<p>Hello {{ $details['username'] }},</p>

<p>Thank you for registering. Please click the following link to confirm your email address:</p>

<p><a href="{{ $details['confirmation_url'] }}">{{ $details['confirmation_url'] }}</a></p>

<p>If you did not request this, you can safely ignore this email.</p>

<p>Regards,<br> Your Application Team</p>

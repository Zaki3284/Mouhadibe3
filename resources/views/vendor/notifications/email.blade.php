<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .navbar-logo {
            max-width: 150px;
        }
    </style>
</head>
<body>
    <table class="header" width="100%" cellpadding="0" cellspacing="0" role="presentation">
        <tr>
            <td class="header">
                <a href="{{ config('app.url') }}">
                    <img src="{{ asset('images/logo.jpeg') }}" alt="Company Logo" class="navbar-logo">
                </a>
            </td>
        </tr>
    </table>

    @component('mail::message')
    {{-- Greeting --}}
    # Reset Password Notification

    You are receiving this email because we received a password reset request for your account.

    {{-- Reset Button --}}
    @component('mail::button', ['url' => $url, 'color' => 'primary'])
    Reset Password
    @endcomponent

    If you did not request a password reset, no further action is required.

    Thanks,<br>
    {{ config('app.name') }}
    @endcomponent
</body>
</html>

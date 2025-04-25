<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Forgot Password Mail</title>
</head>

<body>
    <table style="background-color: #ebebeb; font-family: Arial, Helvetica, sans-serif;" border="0" width="650"
        cellspacing="0" cellpadding="0" align="center">
        <tbody>
            <tr>
                <td>
                    <table border="0" width="100%" cellspacing="0" cellpadding="0">
                        <tbody>
                            <tr>
                                <td style="width: 25%; background: #ffffff; padding: 10px;">
                                    <img style="width: 100%;" src="{{ public_path('frontend/images/midhas_logo.png') }}"
                                        width="120" height="113" />
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td style="padding: 15px 15px;" valign="top">
                    <h3>Reset Password</h3>
                    <hr>
                    <h5 class="">Dear {{ $customer->name }}</h5>
                    <h5 class="">You are receiving this email because we received a password reset request for
                        your
                        account</h5>
                    <a href="{{ route('customer.reset.view', $token) }}?email={{ $customer->email }}"
                        style="padding: 10px  15px; background:#2d3748;text-decoration:none;color:#ffffff; text-align:center;">Reset
                        Password</a>
                    <h5>If you did not request a password reset, no further action is required</h5>
                    <h5>Thanks</h5>
                </td>
            </tr>
        </tbody>
    </table>
</body>
</html>

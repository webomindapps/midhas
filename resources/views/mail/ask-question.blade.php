<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Your Query Has Been Received</title>
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
                                    <img style="width: 100%;" src="{{ asset('frontend/images/midhas_logo.png') }}"
                                        width="120" height="113" alt="Company Logo" />
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>

            <tr>
                <td style="padding: 15px 15px;" valign="top" bgcolor="#ffffff">
                    <h3 style="margin-bottom: 0;">Thank You for Your Query</h3>
                    <hr style="margin: 10px 0;">
                    <p>Dear <strong>{{ $ask_question->name }}</strong>,</p>
                    <p>Thank you for reaching out to us. We have received your query regarding the product:</p>


                    <p><strong>Your Question:</strong></p>
                    <p style="background-color: #f9f9f9; padding: 10px; border-left: 3px solid #ccc;">
                        {{ $ask_question->question }}
                    </p>

                    <p>Our team will review your message and get back to you as soon as possible. We appreciate your
                        interest!</p>

                    <p style="margin-top: 30px;">Best regards,<br>
                        <strong>The Midhas Team</strong>
                    </p>
                </td>
            </tr>
        </tbody>
    </table>
</body>

</html>

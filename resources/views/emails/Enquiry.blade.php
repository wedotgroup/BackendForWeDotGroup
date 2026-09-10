<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Enquiry</title>
</head>

<body style="margin:0; padding:0; background-color:#f3f4f6; font-family:Arial, Helvetica, sans-serif;">

<table width="100%" cellpadding="0" cellspacing="0" border="0" style="background:#f3f4f6; padding:35px 15px;">
    <tr>
        <td align="center">
        <table width="650" cellpadding="0" cellspacing="0" border="0"
               style="max-width:650px; width:100%; background:#ffffff; border-radius:8px; overflow:hidden;">

            <!-- Header -->
            <tr>
                <td style="background:#111827; padding:28px 30px;">

                    <div style="font-size:13px; color:#9ca3af; margin-bottom:6px;">
                        WEBSITE ENQUIRY
                    </div>

                    <div style="font-size:24px; font-weight:bold; color:#ffffff;">
                        New Enquiry Received
                    </div>

                    <div style="font-size:14px; color:#d1d5db; margin-top:7px;">
                        A new enquiry has been submitted through your website.
                    </div>

                </td>
            </tr>

            <!-- Customer Details -->
            <tr>
                <td style="padding:30px 30px 10px;">

                    <div style="font-size:17px; font-weight:bold; color:#111827; margin-bottom:15px;">
                        Contact Details
                    </div>

                    <table width="100%" cellpadding="0" cellspacing="0">

                        <tr>
                            <td style="padding:8px 0; color:#6b7280; width:40%;">
                                First Name
                            </td>
                            <td style="padding:8px 0; color:#111827; font-weight:600;">
                                {{ $data['firstname'] }}
                            </td>
                        </tr>

                        <tr>
                            <td style="padding:8px 0; color:#6b7280;">
                                Last Name
                            </td>
                            <td style="padding:8px 0; color:#111827; font-weight:600;">
                                {{ $data['lastname'] }}
                            </td>
                        </tr>

                        <tr>
                            <td style="padding:8px 0; color:#6b7280;">
                                Email
                            </td>
                            <td style="padding:8px 0;">
                                <a href="mailto:{{ $data['email'] }}"
                                   style="color:#2563eb; text-decoration:none;">
                                    {{ $data['email'] }}
                                </a>
                            </td>
                        </tr>

                        <tr>
                            <td style="padding:8px 0; color:#6b7280;">
                                Phone
                            </td>
                            <td style="padding:8px 0; color:#111827;">
                                {{ $data['phone'] }}
                            </td>
                        </tr>

                    </table>

                </td>
            </tr>

            <!-- Divider -->
            <tr>
                <td style="padding:10px 30px;">
                    <div style="height:1px; background:#e5e7eb;"></div>
                </td>
            </tr>

            <!-- Enquiry Details -->
            <tr>
                <td style="padding:10px 30px 20px;">

                    <div style="font-size:17px; font-weight:bold; color:#111827; margin-bottom:15px;">
                        Enquiry Details
                    </div>

                    <table width="100%" cellpadding="0" cellspacing="0">

                        <tr>
                            <td style="padding:8px 0; color:#6b7280; width:40%;">
                                Category
                            </td>
                            <td style="padding:8px 0; color:#111827; font-weight:600;">
                                {{ $data['category'] }}
                            </td>
                        </tr>

                        <tr>
                            <td style="padding:8px 0; color:#6b7280;">
                                Service
                            </td>
                            <td style="padding:8px 0; color:#111827; font-weight:600;">
                                {{ $data['service'] }}
                            </td>
                        </tr>

                    </table>

                </td>
            </tr>

            <!-- Message -->
            <tr>
                <td style="padding:10px 30px 30px;">

                    <div style="font-size:17px; font-weight:bold; color:#111827; margin-bottom:12px;">
                        Message
                    </div>

                    <div style="background:#f9fafb; border-left:4px solid #111827; padding:15px; color:#4b5563; font-size:14px; line-height:1.6;">
                        {{ $data['message'] }}
                    </div>

                </td>
            </tr>

            <!-- Reply Button -->
            <tr>
                <td style="padding:0 30px 30px;">

                    <a href="mailto:{{ $data['email'] }}"
                       style="display:inline-block; background:#111827; color:#ffffff; text-decoration:none; padding:12px 22px; border-radius:6px; font-size:14px; font-weight:bold;">
                        Reply to Enquiry
                    </a>

                </td>
            </tr>

            <!-- Footer -->
            <tr>
                <td style="background:#f9fafb; border-top:1px solid #e5e7eb; padding:20px 30px; text-align:center;">

                    <div style="font-size:13px; color:#6b7280;">
                        New enquiry received from your website.
                    </div>

                    <div style="font-size:12px; color:#9ca3af; margin-top:6px;">
                        © {{ date('Y') }} All Rights Reserved.
                    </div>

                </td>
            </tr>

        </table>

    </td>
</tr>
</table>

</body>
</html>

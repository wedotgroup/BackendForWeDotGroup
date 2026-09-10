<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New HR Consultation</title>
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

                    <table width="100%" cellpadding="0" cellspacing="0">
                        <tr>
                            <td>
                                <div style="font-size:13px; color:#9ca3af; margin-bottom:6px;">
                                    HR CONSULTATION
                                </div>

                                <div style="font-size:24px; font-weight:bold; color:#ffffff;">
                                    New Job Requirement
                                </div>

                                <div style="font-size:14px; color:#d1d5db; margin-top:7px;">
                                    A new HR consultation request has been received.
                                </div>
                            </td>
                        </tr>
                    </table>

                </td>
            </tr>

            <!-- Company -->
            <tr>
                <td style="padding:30px 30px 10px;">

                    <div style="font-size:17px; font-weight:bold; color:#111827; margin-bottom:15px;">
                        Company Details
                    </div>

                    <table width="100%" cellpadding="0" cellspacing="0">

                        <tr>
                            <td style="padding:8px 0; color:#6b7280; width:40%;">
                                Company Name
                            </td>
                            <td style="padding:8px 0; color:#111827; font-weight:600;">
                                {{ $hrdata['companyName'] }}
                            </td>
                        </tr>

                        <tr>
                            <td style="padding:8px 0; color:#6b7280;">
                                Contact Person
                            </td>
                            <td style="padding:8px 0; color:#111827; font-weight:600;">
                                {{ $hrdata['contactPerson'] }}
                            </td>
                        </tr>

                        <tr>
                            <td style="padding:8px 0; color:#6b7280;">
                                Email
                            </td>
                            <td style="padding:8px 0; color:#111827;">
                                <a href="mailto:{{ $hrdata['email'] }}"
                                   style="color:#2563eb; text-decoration:none;">
                                    {{ $hrdata['email'] }}
                                </a>
                            </td>
                        </tr>

                        <tr>
                            <td style="padding:8px 0; color:#6b7280;">
                                Phone
                            </td>
                            <td style="padding:8px 0; color:#111827;">
                                {{ $hrdata['phone'] }}
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

            <!-- Job -->
            <tr>
                <td style="padding:10px 30px;">

                    <div style="font-size:17px; font-weight:bold; color:#111827; margin-bottom:15px;">
                        Job Requirement
                    </div>

                    <table width="100%" cellpadding="0" cellspacing="0">

                        <tr>
                            <td style="padding:8px 0; color:#6b7280; width:40%;">
                                Job Title
                            </td>
                            <td style="padding:8px 0; color:#111827; font-weight:600;">
                                {{ $hrdata['jobTitle'] }}
                            </td>
                        </tr>

                        <tr>
                            <td style="padding:8px 0; color:#6b7280;">
                                Job Location
                            </td>
                            <td style="padding:8px 0; color:#111827;">
                                {{ $hrdata['jobLocation'] }}
                            </td>
                        </tr>

                        <tr>
                            <td style="padding:8px 0; color:#6b7280;">
                                Employment Type
                            </td>
                            <td style="padding:8px 0; color:#111827;">
                                {{ $hrdata['employmentType'] }}
                            </td>
                        </tr>

                        <tr>
                            <td style="padding:8px 0; color:#6b7280;">
                                Experience
                            </td>
                            <td style="padding:8px 0; color:#111827;">
                                {{ $hrdata['experience'] }}
                            </td>
                        </tr>

                        <tr>
                            <td style="padding:8px 0; color:#6b7280;">
                                Salary Range
                            </td>
                            <td style="padding:8px 0; color:#111827;">
                                {{ $hrdata['salaryRange'] }}
                            </td>
                        </tr>

                        <tr>
                            <td style="padding:8px 0; color:#6b7280;">
                                Department
                            </td>
                            <td style="padding:8px 0; color:#111827;">
                                {{ $hrdata['department'] }}
                            </td>
                        </tr>

                    </table>

                </td>
            </tr>

            <!-- Description -->
            <tr>
                <td style="padding:20px 30px 10px;">

                    <div style="font-size:17px; font-weight:bold; color:#111827; margin-bottom:12px;">
                        Job Description
                    </div>

                    <div style="background:#f9fafb; border-left:4px solid #111827; padding:15px; color:#4b5563; font-size:14px; line-height:1.6;">
                        {{ $hrdata['jobDescription'] }}
                    </div>

                </td>
            </tr>

            <!-- Skills -->
            <tr>
                <td style="padding:20px 30px 10px;">

                    <div style="font-size:17px; font-weight:bold; color:#111827; margin-bottom:12px;">
                        Required Skills
                    </div>

                    <div style="background:#f9fafb; padding:15px; color:#4b5563; font-size:14px; line-height:1.6;">
                        {{ $hrdata['skills'] }}
                    </div>

                </td>
            </tr>

            <!-- Qualifications -->
            <tr>
                <td style="padding:20px 30px 30px;">

                    <div style="font-size:17px; font-weight:bold; color:#111827; margin-bottom:12px;">
                        Qualifications
                    </div>

                    <div style="background:#f9fafb; padding:15px; color:#4b5563; font-size:14px; line-height:1.6;">
                        {{ $hrdata['qualifications'] }}
                    </div>

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

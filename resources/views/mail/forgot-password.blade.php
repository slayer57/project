<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leideu</title>
</head>

<body>
    <main>
        <table width="624" style="max-width:624px" cellpadding="0" cellspacing="0" border="0">
            <tbody>
                <tr>
                    <td>
                        <table width="624" cellpadding="0" cellspacing="0" border="0"
                            style="border-collapse:collapse">
                            <tbody>
                                <tr>
                                    <td width="312px" height="90"
                                        style="padding-left:0px;padding-right:28px;padding-top:0px;padding-bottom:0px;background:#007c00;border-top-right-radius:10px"
                                        align="right"><img src="{{ asset('frontend/assets/images/logo1.png') }}"
                                            width="188" height="50" alt=""></td>
                                </tr>
                                <tr style="background:#f5f5f5">
                                    <td colspan="2"
                                        style="padding-left:15px;padding-right:15px;padding-top:25px;padding-bottom:25px;font-size:14px;line-height:24px;color:#4d4d4d">

                                        <br><br> We received a request to reset your existing
                                        Password.
                                        <h4>To reset your password <a style="color:#007c00;text-decoration:none"
                                                href="{{ route('resetpwdform', $randomString) }}" target="_blank">
                                                click here :
                                            </a></h4>
                                    </td>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
    </main>
</body>

</html>

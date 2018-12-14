<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Demystifying Email Design</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>

    <body style="margin: 0; padding: 0;">
        <table align="center" cellpadding="0" cellspacing="0" width="600">
            <tr>
                <td bgcolor="#1d1e20">
                    <h2 style="color: #34bbff; float: left; padding-left: 30px;">𝔹𝕠𝕩 ℙ𝕣𝕚𝕫𝕖</h2>
                </td>
            </tr>
            <tr style="text-align: center">
                <td>
                    <table cellpadding="0" cellspacing="0" width="100%" align="center" style="background-image: url({{ env('APP_URL') }}/img/bg-light2.png); background-size: cover; height: 200px;">
                        <tr>
                            <td>
                                <h3><span style="color: #34bbff;">Box Prize </span> Спасибо за регистрацию</h3>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding: 5px 0 5px 0;">
                                Чтобы завершить регистрацию пожалуйста пройдите по ссылке <a href="{{ url('/confirm/'.$userID.'/'.$verifyToken) }}">подтвердить регистрацию</a>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td bgcolor="#1d1e20"></td>
            </tr>
        </table>
    </body>
</html>

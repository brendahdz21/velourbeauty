<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Alerta de Inicio de Sesión</title>
</head>
<body style="
    margin:0;
    padding:0;
    background:#fdf7f8;
    font-family: Arial, Helvetica, sans-serif;
">

    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="padding:40px 20px;">
        <tr>
            <td align="center">

                <table width="600" cellpadding="0" cellspacing="0" border="0" style="
                    background:#ffffff;
                    border-radius:20px;
                    padding:40px;
                    box-shadow:0 10px 30px rgba(0,0,0,0.08);
                ">

                    <!-- LOGO / TITULO -->
                    <tr>
                        <td align="center">
                            <h1 style="
                                color:#b65a67;
                                margin-bottom:10px;
                                font-size:32px;
                            ">
                                Velour Beauty 💄
                            </h1>

                            <p style="
                                color:#999;
                                margin-top:0;
                                font-size:14px;
                            ">
                                Sistema de notificaciones automáticas
                            </p>
                        </td>
                    </tr>

                    <!-- ICON -->
                    <tr>
                        <td align="center" style="padding-top:20px;">
                            <div style="
                                width:80px;
                                height:80px;
                                line-height:80px;
                                background:#fdf0f3;
                                border-radius:50%;
                                font-size:35px;
                                text-align:center;
                            ">
                                🔐
                            </div>
                        </td>
                    </tr>

                    <!-- TITULO -->
                    <tr>
                        <td align="center">
                            <h2 style="
                                color:#333;
                                margin-top:25px;
                                margin-bottom:10px;
                                font-size:28px;
                            ">
                                Nuevo inicio de sesión detectado
                            </h2>
                        </td>
                    </tr>

                    <!-- TEXTO -->
                    <tr>
                        <td align="center">
                            <p style="
                                color:#666;
                                font-size:16px;
                                line-height:1.8;
                                margin-bottom:30px;
                            ">
                                Hemos detectado actividad reciente en tu cuenta.
                                <br>
                                Si fuiste tú, puedes ignorar este mensaje.
                            </p>
                        </td>
                    </tr>

                    <!-- BOTON -->
                    <tr>
                        <td align="center">
                            <a href="{{ route('login') }}" style="
                                background:#b65a67;
                                color:white;
                                padding:15px 35px;
                                border-radius:10px;
                                text-decoration:none;
                                font-size:16px;
                                font-weight:bold;
                                display:inline-block;
                            ">
                                Verificar actividad
                            </a>
                        </td>
                    </tr>

                    <!-- WARNING -->
                    <tr>
                        <td align="center">
                            <p style="
                                margin-top:35px;
                                color:#777;
                                font-size:15px;
                                line-height:1.8;
                            ">
                                Si no reconoces este acceso,
                                <strong style="color:#b65a67;">
                                    solicita un cambio de contraseña al administrador.
                                </strong>
                            </p>
                        </td>
                    </tr>

                    <!-- FOOTER -->
                    <tr>
                        <td align="center">
                            <hr style="
                                margin:35px 0 20px 0;
                                border:none;
                                border-top:1px solid #eee;
                            ">

                            <small style="
                                color:#aaa;
                                font-size:12px;
                            ">
                                Este correo fue enviado automáticamente por Velour Beauty.
                            </small>
                        </td>
                    </tr>

                </table>

            </td>
        </tr>
    </table>

</body>
</html>
<table style="border-top:3px solid #EA5E24;border-bottom:3px solid #EA5E24;" width="600" align="center">
    <tbody>
        <tr>
            <td style="padding-left:20px;padding-right: 20px;">
                <table width="100%" cellspacing="0" cellpadding="0">
                    <tbody><tr>
                        <td>
                            <p style="color:#EA5E24;margin: 0;padding-top: 10px;padding-bottom: 10px;font-size: 16px;"><b>¡Hola, {{$name}}!</b></p>
                            <p style="color:#808080;margin: 0;font-size: 16px;"><b>Te ha llegado este correo porque hemos recibido una solicitud de restablecimiento de contraseña para tu cuenta en el sistema <span style="color:#EA5E24">Matrícula<sup>®</sup> online</span>.</b></p>
                        </td>
                        <td>
                            <img src="https://preciso.online/intranet/public/images/logo-matricula.png" width="180">
                        </td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        <tr>
            <td style="padding-right: 20px;padding-left: 20px;padding-top: 10px;">
                <p style="margin: 0;padding-bottom: 15px;font-size: 16px;color: #808080;">De no haber solicitado restablecer tu contraseña, haz caso omiso al correo. De lo contrario, ingresa <a href="{{url('/password/reset/'.$code)}}" style="color: #EA5E24;">aquí</a>.</p>
                <p style="margin: 0;padding-bottom: 15px;font-size: 16px;color: #808080;">Este enlace de restablecimiento caducará en sesenta (60) minutos.</p>
            </td>
        </tr>
        <tr>
            <td style="padding-right: 20px;padding-left: 20px;"><p style="margin: 0;padding-bottom: 15px;font-size: 16px;color: #808080;">Atentamente,</p>
                <p style="color:#EA5E24;margin: 0;padding-bottom: 20px;font-size: 16px;"><b>El equipo de Matrícula<sup>®</sup> online</b></p>
            </td>
        </tr>
        <tr>
            <td style="padding-right: 20px;padding-left: 20px;padding-top: 10px;">
                <p style="margin: 0;padding-bottom: 15px;font-size: 16px;color: #808080;">Si estás teniendo problemas para hacer clic en el enlace, copia y pega la siguiente dirección en tu buscador web: <a href="{{url('/password/reset/'.$code)}}" style="color: #EA5E24;">{{url('/password/reset/'.$code)}}</a></p>
            </td>
        </tr>
    </tbody>
</table>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="./admin.js" type="text/javascript"></script>
    <title>REGISTRO</title>
</head>
<body>
<table>
        <tr><td>Nombre</td><td><input type="text" id="txtNombre"></td></tr>
        <tr><td>Apellido</td><td><input type="text" id="txtApellido"></td></tr>
        <tr><td>Correo</td><td><input type="text" id="txtCorreo"></td></tr>
        <tr><td>Clave</td><td><input type="password" id="txtClave"></td></tr>
        <tr><td>Perfil</td><td><input type="text" id="txtPerfil"></td></tr>
        <tr><td>Foto</td><td><input type="file" id="foto"></td></tr>
        <tr><td colspan="2" style="text-align: right"><input type="button" id="btnAceptar" value="Registrarse" onclick="Registrarse()">
        <input type="button" id="btnCancelar" value="Cancelar"></td></tr>
    </table>
</body>
</html>
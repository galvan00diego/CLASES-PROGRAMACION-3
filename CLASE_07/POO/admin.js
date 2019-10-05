function Login() {
    var xhttp = new XMLHttpRequest();
    var correo = document.getElementById("txtCorreo").value;
    var clave = document.getElementById("txtClave").value;
    xhttp.open("POST", "./backend/test_usuario.php", true);
    xhttp.setRequestHeader("content-type", "application/x-www-form-urlencoded");
    var parametro = "{\"correo\":\"" + correo + "\",\"clave\":\"" + clave + "\"}";
    xhttp.send("param=" + parametro);
    xhttp.onreadystatechange = function () {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            var obj = (JSON.parse(xhttp.responseText));
            if (obj.existe == true) {
                window.location.href = ("Principal.php");
            }
            else if (obj.existe == false) {
                alert("El usuario ingresado no existe");
                window.location.href = "index.html";
            }
        }
    };
}
function Registrarse() {
    var xhttp = new XMLHttpRequest();
    var form = new FormData();
    form.append("nombre", document.getElementById("txtNombre").value);
    form.append("apellido", document.getElementById("txtApellido").value);
    form.append("correo", document.getElementById("txtCorreo").value);
    form.append("clave", document.getElementById("txtClave").value);
    form.append("perfil", document.getElementById("txtPerfil").value);
    var foto = document.getElementById("foto");
    form.append("foto", foto.files[0]);
    xhttp.open("POST", "./backend/adm_registro.php", true);
    xhttp.setRequestHeader("enctype", "multipart/form-data");
    //  let parametro:string=`{"nombre":"${nombre}","apellido":"${apellido}",
    //                          "correo":"${correo}","clave":"${clave}","perfil":"${perfil}"}`;   
    // xhttp.send(form+"&param="+parametro);
    xhttp.send(form);
    xhttp.onreadystatechange = function () {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            //console.log(JSON.parse(xhttp.responseText));
            console.log(xhttp.responseText);
        }
    };
}

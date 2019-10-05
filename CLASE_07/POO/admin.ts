function Login():void
{
    var xhttp:XMLHttpRequest=new XMLHttpRequest();
    let correo:string=(<HTMLInputElement>document.getElementById("txtCorreo")).value;
    let clave:string=(<HTMLInputElement>document.getElementById("txtClave")).value;
    xhttp.open("POST","./backend/test_usuario.php",true);
    xhttp.setRequestHeader("content-type","application/x-www-form-urlencoded");
    let parametro:string=`{"correo":"${correo}","clave":"${clave}"}`;   
    xhttp.send("param="+parametro);

    xhttp.onreadystatechange=function(){
        if(xhttp.readyState==4 && xhttp.status==200 )
        {
            
            let obj:any=(JSON.parse(xhttp.responseText));
            if(obj.existe==true)
            {
                window.location.href=("Principal.php");
            }
            else if(obj.existe==false)
            {
                alert("El usuario ingresado no existe");
                window.location.href="index.html";
            }
        }
    }
}

function Registrarse():void
{
    var xhttp:XMLHttpRequest=new XMLHttpRequest();
    let form : FormData = new FormData();

    form.append("nombre",(<HTMLInputElement>document.getElementById("txtNombre")).value);
    form.append("apellido",(<HTMLInputElement>document.getElementById("txtApellido")).value);
    form.append("correo",(<HTMLInputElement>document.getElementById("txtCorreo")).value);
    form.append("clave",(<HTMLInputElement>document.getElementById("txtClave")).value);
    form.append("perfil",(<HTMLInputElement>document.getElementById("txtPerfil")).value);

    let foto : any = (<HTMLInputElement> document.getElementById("foto"));
    form.append("foto", foto.files[0]);
    xhttp.open("POST","./backend/adm_registro.php",true);
    xhttp.setRequestHeader("enctype", "multipart/form-data");
    //  let parametro:string=`{"nombre":"${nombre}","apellido":"${apellido}",
    //                          "correo":"${correo}","clave":"${clave}","perfil":"${perfil}"}`;   
    // xhttp.send(form+"&param="+parametro);
    xhttp.send(form);

    xhttp.onreadystatechange=function(){
        if(xhttp.readyState==4 && xhttp.status==200 )
        {
            //console.log(JSON.parse(xhttp.responseText));
            console.log(xhttp.responseText);
        }
    }
}
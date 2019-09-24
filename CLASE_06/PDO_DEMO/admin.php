<?php

$queHago = isset($_POST['queHago']) ? $_POST['queHago'] : NULL;
$nombre = isset($_POST["nombre"]) ? $_POST["nombre"] : NULL;
$apellido = isset($_POST["apellido"]);
$clave = isset($_POST["clave"]);
$perfil = isset($_POST["perfil"]);
$estado = isset($_POST["estado"]);
$codigo_barra=isset($_POST["codigo_barra"]) ? $_POST["codigo_barra"] : NULL;
$path_foto=isset($_POST["path_foto"]) ? $_POST["path_foto"] : NULL;
$id = isset($_POST["id"]) ? $_POST["id"] : NULL;

$user="root";
$pass="";

try {
    $pdo=new PDO("mysql:host=localhost;dbname=mercado;charset=utf8",$user,$pass);

switch ($queHago) {
    case 'Traer_TodosUsuarios':
        try {
            $pdo=new PDO("mysql:host=localhost;dbname=mercado;charset=utf8",$user,$pass);
            echo "Conexion exitosa!";

            $consulta_prepare=$pdo->prepare("SELECT * FROM usuarios");
            $consulta_prepare->execute();

            $obj=new StdClass();
            echo "<table border=4><tr><td>ID</td><td>NOMBRE</td><td>APELLIDO</td><td>PERFIL</td><td>ESTADO</td></tr>";
            while ($obj=$consulta_prepare->fetch(PDO::FETCH_LAZY)) {

                echo "<tr><td>".$obj->id."</td><td>".$obj->nombre."</td><td>".$obj->apellido."</td>";
                echo "<td>".$obj->perfil."</td><td>".$obj->estado."</td></tr>";
            }
            echo "</table>";
    
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        break;

    case 'TraerPorId_Usuario':
        try {
            $pdo=new PDO("mysql:host=localhost;dbname=mercado;charset=utf8",$user,$pass);
            //echo "Conexion exitosa!";

            $consulta_prepare=$pdo->prepare("SELECT * FROM usuarios WHERE id=:id");
            $consulta_prepare->execute(array(":id"=>$id));

            //$obj=new StdClass();
            while($obj=$consulta_prepare->fetch(PDO::FETCH_LAZY))
            {
                echo '{"id":'.$obj->id.',"nombre":"'.$obj->nombre.'","apellido":"'.$obj->apellido.'","perfil":'.$obj->perfil.',"estado":'.$obj->estado.'}';
            }

        } catch (Exception $e) {
            echo $e->getMessage();
        }
        
        break;

    case 'Agregar_Usuarios':
    $sql = "INSERT INTO usuarios(nombre, apellido, clave, perfil, estado) 
                VALUES (:nombre,:apellido,:clave,:perfil,:estado)";
        $consulta_prepare=$pdo->prepare($sql);
        $consulta_prepare->execute(array(":nombre"=>$nombre,":apellido"=>$apellido,
                                        ":clave"=>$clave,":perfil"=>$perfil,":estado"=>$estado));
        if($consulta_prepare->rowCount())
        {
            echo "El usuario ".$nombre." ha sido agregado a la base de datos";
        }

        break;
    
    default:
        echo "No eligio caso";
        break;
}

} catch (Exception $e) {
    echo $e->getMessage();
}
<?php



try {

    $pdo=new PDO("mysql:host=localhost;dbname=cdcol;charset=utf8","root","");
    echo "Conexion exitosa!";

} catch (Exception $e) {
    echo $e->getMessage();
}

$sql_query="SELECT * FROM cds";

$pdo_query=$pdo->query($sql_query);


//$respuesta=$pdo_query->fetchall();

//var_dump($respuesta);

echo "<table border=4><tr><td>ID</td><td>TITULO</td><td>AÑO</td><td>INTERPRETE</td></tr>";
while($respuesta=$pdo_query->fetch(PDO::FETCH_ASSOC))
{
    echo "<tr><td>".$respuesta["id"]."</td>";
    echo "<td>".$respuesta["titel"]."</td>";
    echo "<td>".$respuesta["jahr"]."</td>";
    echo "<td>".$respuesta["interpret"]."</td></tr>";
}
echo "</table>";


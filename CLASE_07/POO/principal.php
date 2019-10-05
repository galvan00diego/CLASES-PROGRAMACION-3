<?php if(!isset($_SESSION["perfil"]))
{
    header("location:index.html");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Principal</title>
</head>
<body>
  <?php session_start();
    if($_SESSION["perfil"]==1)
    echo '<a href="./backend/list_users.php">Listado Usuarios</a><br>';

    echo '<a href="./backend/list_products.php">Listado Productos</a>';

    ?>
</body>
</html>
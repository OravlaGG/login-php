<?php
  include "establecer-sesion.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>
    <h2>CRUD de la Pagina</h2>
    <p>Bienvenido, <?php echo $_SESSION['nombre'] . " " . $_SESSION['apellidos'];?></p>
    <a class="btn btn-secondary" href="./logout.php">Log Out</button>
</body>
</html>
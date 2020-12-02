<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    include 'conexion.php';

    $id = $_GET['id'];
    $sql = "select * from personas where id='" . $id . "'";
    $resultado = mysqli_query($con, $sql);

    while ($fila = mysqli_fetch_assoc($resultado)) {
    ?>

        <h1>REGISTRO DE UN NUEVO PRODUCTO</h1>

        <div class="container-fluid">
            <div class="container py-5">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="text">ID </label>
                        <input type="text" class="form-control" name="id" value="<?php echo $fila['id'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="text">Apellido Paterno: </label>
                        <input type="text" name="ap_paterno" class="form-control" value="<?php echo $fila['paterno'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="text">Apellido Materno: </label>
                        <input type="text" class="form-control" name="ap_materno" value="<?php echo $fila['materno'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="text">Nombre: </label>
                        <input type="text" class="form-control" name="nombre" value="<?php echo $fila['nombre'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="text">Fecha de Nacimiento: </label>
                        <input type="date" class="form-control" name="fec_nacimiento" class="form-group" value="<?php echo $fila['cumple'] ?>">
                    </div>
                    <input type="submit" class="btn btn-primary" value="Agregar">
                    <a href="index.php">Retroceder</a>
                </form>
            <?php } ?>
            </div>
        </div>
</body>

</html>
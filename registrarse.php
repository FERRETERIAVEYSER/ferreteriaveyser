<?php
include 'conexion.php';
    
if (isset($_POST['nombre']) || isset($_POST['apellido']) || 
isset($_POST['usuario']) || isset($_POST['contraseña']) || 
isset($_POST['rol']) || isset($_POST['email']) || isset($_POST['celular'])
|| isset($_POST['direccion'])) {

    $nom=$_POST['nombre'];
    $ape=$_POST['apellido'];
    $user=$_POST['usuario'];
    $passwoard = password_hash($_POST['contraseña'], PASSWORD_BCRYPT);
    $cargo = $_POST['rol'];
    $correo = $_POST['email'];
    $telefono = $_POST['celular'];
    $dir = $_POST['direccion'];
    $sql = mysqli_query($con,"insert into usuarios (NOMBRE, APELLIDO, USUARIO, CONTRASEÑA, ROL, EMAIL, CELULAR, DIRECCION)
    values('".$nom."','".$ape."','".$user."','".$passwoard."','".$cargo."','".$correo."','".$telefono."','".$dir."')");
    if ($nombre = 1) {
        header("location:ventana.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <title>Registrar Usuario</title>
</head>

<body>

    <h1>Registrar Usuario</h1>

    <div class="container-fluid">
        <div class="container py-5">
            <form id="login-form" action="registrarse.php" method="post">

                <div class="row">
                    <div class="col">
                        <label for="exampleInputEmail1">Nombre</label>
                        <input type="text" name="nombre" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                    </div>
                    <div class="col">
                        <label for="exampleInputEmail1">Apellidos</label>
                        <input type="text" name="apellido" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label for="exampleInputEmail1">Usuario</label>
                        <input type="text" name="usuario" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                    </div>
                    <div class="col">
                        <label for="exampleInputPassword1">E-mail</label>
                        <input type="email" name="email" class="form-control" id="exampleInputPassword1" placeholder="user@example" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label for="exampleInputEmail1">Dirección</label>
                        <input type="text" name="direccion" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                    </div>
                    <div class="col">
                        <label for="exampleFormControlFile1">Subir Foto</label>
                        <div class="custom-file">
                            <input type="file" name="foto" class="custom-file-input" id="validatedCustomFile" required>
                            <label class="custom-file-label" for="validatedCustomFile">Subir archivo...</label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label for="exampleFormControlFile1">Contraseña</label>
                        <input type="password" name="contraseña" class="form-control" id="inlineFormInputName" required>
                    </div>
                    <div class="col">
                        <label for="exampleFormControlFile1">Confirmar Contraseña</label>
                        <input type="password" name="confirmarcontraseña" class="form-control" id="inlineFormInputGroupUsername" required>
                    </div>
                </div>

                <div class="form-row align-items-center">
                    <div class="col-sm-6 my-1">
                        <label for="exampleFormControlSelect1">Rol</label>
                        <select name="rol" class="form-control" id="exampleFormControlSelect1">
                            <option>Admin</option>
                            <option>Cliente</option>
                            <option>Vendedor</option>
                        </select>
                    </div>
                    <div class="col-sm-6 my-1">
                        <label for="exampleFormControlSelect1">Celular</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">+51</div>
                            </div>
                            <input type="text" name="celular" class="form-control" id="inlineFormInputGroupUsername" placeholder="Perú" required>
                        </div>
                    </div>
                </div>

                <!-- <div class="form-group">
                    <label for="exampleFormControlFile1">Subir Foto</label>
                    <input type="file" class="form-control-file" id="exampleFormControlFile1">
                </div> -->
                
                <div class="row">
                    <div class="col-sm-4 my-2">
                        <div class="form-check">
                            <input name="termino" class="form-check-input" type="checkbox" value="" id="defaultCheck1" required>
                            <label class="form-check-label" for="defaultCheck1">
                                Acepto los términos y condiciones
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-8 my-2">
                        <button class="btn btn-info" type="submit">Regsitrarme</button>
                    </div>
                </div>
                
            </form>
        </div>
    </div>
</body>

</html>
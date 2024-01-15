<?php
    include("../../bd.php");
    
    if($_POST){ // Mejorable las areas
        // print_r($_POST);
        $newNombre = (isset($_POST["nombreUsuario"])?$_POST["nombreUsuario"]:"");
        $newPassword = (isset($_POST["passwordUsuario"])?$_POST["passwordUsuario"]:"");
        $newCorreo = (isset($_POST["correo"])?$_POST["correo"]:"");

        $query_insert = $conexion -> prepare("INSERT INTO user (id, user_name, user_password, user_correo ) VALUES(NULL, :nombreUsuario, :passwordUsuario, :correo)");
        $query_insert -> bindParam(":nombreUsuario", $newNombre);
        $query_insert -> bindParam(":passwordUsuario", $newPassword);
        $query_insert -> bindParam(":correo", $newCorreo);
        $query_insert -> execute();
        $mensaje="Registro agregado";
        header("Location:index.php?mensaje=".$mensaje);
        //header("Location:index.php");
     }
?>

<?php include("../../templates/header.php"); ?>
<br/>

<div class="card">
    <div class="card-header">
        Datos del usuario
    </div>
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">

        <div class="mb-3">
          <label for="nombreUsuario" class="form-label">Nombre de usuario</label>
          <input type="text"
            class="form-control" name="nombreUsuario" id="nombreUsuario" aria-describedby="helpId" placeholder="Nombre de usuario">          
        </div>
        <div class="mb-3">
          <label for="passwordUsuario" class="form-label">Contraseña</label>
          <input type="password"
            class="form-control" name="passwordUsuario" id="passwordUsuario" aria-describedby="helpId" placeholder="contraseña">          
        </div>
        <div class="mb-3">
          <label for="correo" class="form-label">Correo</label>
          <input type="email"
            class="form-control" name="correo" id="correo" aria-describedby="helpId" placeholder="yon@gmail.com">          
        </div>
        
        <button type="submit" class="btn btn-success">Agregar</button>
        <a name="" id="" class="btn btn-danger" href="index.php" role="button">Cancelar</a>


        </form>

    </div>
    <div class="card-footer text-muted">
        Footer
    </div>
</div> 

<?php include("../../templates/footer.php"); ?>
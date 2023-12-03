<?php
include("../../bd.php");

if (isset($_GET['valueID'])) {  //  MEJORAR ESTA AREA
    $valueID = isset($_GET['valueID'])?$_GET['valueID']:"";

    $querySelect = $conexion->prepare("SELECT * FROM user WHERE id=:id");
    $querySelect -> bindParam(":id", $valueID);
    $querySelect -> execute();
    //Cargamos un solo registro
    $imprimirConsulta = $querySelect->fetch(PDO::FETCH_LAZY);
    $showName = $imprimirConsulta["user_name"];
    $showPassword = $imprimirConsulta["user_password"];
    $showCorreo = $imprimirConsulta["user_correo"];
}   

if ($_POST) { // si existe un envio- recepcionar esos datos
     print_r($_POST); //imprimir en pantalla // datos locales
    $newValueID = isset($_GET['valueID'])?$_GET['valueID']:"";
    $newValueUser = (isset($_POST["nombreUsuario"])?$_POST["nombreUsuario"]:"");
    $newValuePassword = (isset($_POST["passwordUsuario"])?$_POST["passwordUsuario"]:"");
    $newValueCorreo = (isset($_POST["correo"])?$_POST["correo"]:"");

    $queryUpdate = $conexion->prepare("UPDATE user SET user_name=:nombreUser, user_password=:pswUser, user_correo=:emailUser WHERE id=:valueID");
    $queryUpdate -> bindParam(":nombreUser",$newValueUser);
    $queryUpdate -> bindParam(":pswUser",$newValuePassword);
    $queryUpdate -> bindParam(":emailUser",$newValueCorreo);
    $queryUpdate -> bindParam(":valueID",$newValueID);
    $queryUpdate -> execute();
    header("Location:index.php");
}

?>


<?php include("../../templates/header.php"); ?>
<br/>

<div class="card">
    <div class="card-header">
        Actualizar del usuario
    </div>
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">
        <div class="mb-3">
          <label for="idUser" class="form-label">ID</label>
          <input type="text" value="<?php echo $valueID  ?>" readonly
            class="form-control" name="idUser" id="idUser" aria-describedby="helpId" placeholder="idUser">          
        </div>
        <div class="mb-3">
          <label for="nombreUsuario" class="form-label">Nombre de usuario</label>
          <input type="text" value="<?php echo $showName  ?>"
            class="form-control" name="nombreUsuario" id="nombreUsuario" aria-describedby="helpId" placeholder="Nombre de usuario">          
        </div>
        <div class="mb-3"> 
          <label for="passwordUsuario" class="form-label">Contraseña</label>
          <input type="password" value="<?php echo $showPassword  ?>"
            class="form-control" name="passwordUsuario" id="passwordUsuario" aria-describedby="helpId" placeholder="contraseña">          
        </div>
        <div class="mb-3">
          <label for="correo" class="form-label">Correo</label>
          <input type="email" value="<?php echo $showCorreo  ?>"
            class="form-control" name="correo" id="correo" aria-describedby="helpId" placeholder="yon@gmail.com">          
        </div>

       <button type="submit" class="btn btn-success">Actualizar</button>
        <a name="" id="" class="btn btn-danger" href="index.php" role="button">Cancelar</a>


        </form>

    </div>
    <div class="card-footer text-muted">
        Footer
    </div>
</div> 


<?php include("../../templates/footer.php"); ?>
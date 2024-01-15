<?php
include("../../bd.php");

if (isset($_GET['valueID'])) {  //  MEJORAR ESTA AREA
    $valueID = isset($_GET['valueID'])?$_GET['valueID']:"";

    $querySelect = $conexion->prepare("SELECT * FROM job_position WHERE id=:id");
    $querySelect -> bindParam(":id", $valueID);
    $querySelect -> execute();
    //Cargamos un solo registro
    $imprimirConsulta = $querySelect->fetch(PDO::FETCH_LAZY);
    $nombreDelPuesto = $imprimirConsulta["name_job_position"];
}   
if ($_POST) { // si existe un envio- recepcionar esos datos
    // print_r($_POST); //imprimir en pantalla
    $newValueID = isset($_GET['valueID'])?$_GET['valueID']:"";
    $newValueName = (isset($_POST["nombreDelPuesto"])?$_POST["nombreDelPuesto"]:"");

    $queryUpdate = $conexion->prepare("UPDATE job_position SET name_job_position=:nombreDelPuesto WHERE id=:valueID");
    $queryUpdate -> bindParam(":nombreDelPuesto",$newValueName);
    $queryUpdate -> bindParam(":valueID",$newValueID);
    $queryUpdate -> execute();

    $mensaje="Registro actualizado";
    header("Location:index.php?mensaje=".$mensaje);

}

?>

<?php include("../../templates/header.php"); ?>
Actualizar puesto de trabajo
<br/>
<div class="card">
    <div class="card-header">
        Puestos
    </div>
    <div class="card-body">

        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
              <label for="valueID" class="form-label">ID: </label>
              <input type="text" value="<?php echo $valueID; ?>"
                class="form-control" readonly name="valueID" id="valueID" aria-describedby="helpId" placeholder="">
            </div>

            <div class="mb-3">
              <label for="nombreDelPuesto" class="form-label">Nombre del puesto</label>
              <input type="text" value="<?php echo $nombreDelPuesto; ?>"
                  class="form-control" name="nombreDelPuesto" id="nombreDelPuesto" aria-describedby="helpId" placeholder="Nombre del puesto">
             
            </div>
            <button type="submit" class="btn btn-success">Actualizar</button>
            <a name="" id="" class="btn btn-danger" href="index.php" role="button">Cancelar</a>
        </form>
        
        
    </div>
</div>

<?php include("../../templates/footer.php"); ?>
<?php
    include("../../bd.php");

    if($_POST){ // Mejorable las areas
        print_r($_POST);
        $nombreDelPuesto = (isset($_POST["nombreDelPuesto"])?$_POST["nombreDelPuesto"]:"");
        // echo gettype($nombreDelPuesto);
        // echo strlen($nombreDelPuesto);  // 0 
        $query_insert = $conexion -> prepare("INSERT INTO job_position(id, name_job_position) VALUES(null, :nombreDelPuesto)");
        $query_insert -> bindParam(":nombreDelPuesto",$nombreDelPuesto);
        $query_insert -> execute();

        header("Location:index.php");
    }
?>

<?php include("../../templates/header.php"); ?>

Crear puesto de trabajo
<div class="card">
    <div class="card-header">
        Puestos
    </div>
    <div class="card-body">

        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
              <label for="nombreDelPuesto" class="form-label">Nombre del puesto</label>
              <input type="text"
                  class="form-control" name="nombreDelPuesto" id="nombreDelPuesto" aria-describedby="helpId" placeholder="Nombre del puesto">
             
            </div>
            <button type="submit" class="btn btn-success">Agregar</button>
            <a name="" id="" class="btn btn-danger" href="index.php" role="button">Cancelar</a>
        </form>
        
        
    </div>
</div>

<?php include("../../templates/footer.php"); ?>
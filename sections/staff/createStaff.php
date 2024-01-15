<?php
    include("../../bd.php");

    if($_POST){ // Mejorable las areas
        // print_r($_POST);
        // print_r($_FILES); 
        $getPrimerNombre = (isset($_POST["primerNombre"])?$_POST["primerNombre"]:"");
        $getSegunfoNombre = (isset($_POST["segundoNombre"])?$_POST["segundoNombre"]:"");
        $getPrimerApellido = (isset($_POST["primerApellido"])?$_POST["primerApellido"]:"");
        $getSegundoApellido = (isset($_POST["segundoApellido"])?$_POST["segundoApellido"]:"");

        $getFoto = (isset($_FILES["foto"]["name"])?$_FILES["foto"]["name"]:"");
        $getCV = (isset($_FILES["cv"]["name"])?$_FILES["cv"]["name"]:"");

        $getPuesto = (isset($_POST["puesto"])?$_POST["puesto"]:"");
        $getFecha = (isset($_POST["fechaIngreso"])?$_POST["fechaIngreso"]:"");
       
        $query_insert = $conexion -> prepare("INSERT INTO staff(id, first_name, second_name, first_surname, second_surname, photo, cv, id_job_position, admission_date) VALUES(null, :new_first_name, :new_second_name, :new_first_surname, :new_second_surname, :new_photo, :new_cv, :new_id_job_position, :new_admission_date)");
        $query_insert -> bindParam(":new_first_name", $getPrimerNombre);
        $query_insert -> bindParam(":new_second_name", $getSegunfoNombre);
        $query_insert -> bindParam(":new_first_surname", $getPrimerApellido);
        $query_insert -> bindParam(":new_second_surname", $getSegundoApellido);
        
        //de damos un identificador unico para la foto por mas que sea la misma foto subida
        $fecha_new = new DateTime(); // pra cambiar nombre
        $nameFilePhoto = ($getFoto!="")?$fecha_new->getTimestamp()."_".$_FILES["foto"]["name"]:"";
        $tmpPhoto = $_FILES["foto"]["tmp_name"];
        if ($tmpPhoto!="") {
          move_uploaded_file($tmpPhoto,"./".$nameFilePhoto);
        }
        $query_insert -> bindParam(":new_photo", $nameFilePhoto); // ahora le pasamos el nueva ruta completa

        //para cv
        $nameFileCV = ($getCV!="")?$fecha_new->getTimestamp()."_".$_FILES["cv"]["name"]:"";
        $tmpCV = $_FILES["cv"]["tmp_name"];
        if ($tmpCV!="") {
          move_uploaded_file($tmpCV,"./".$nameFileCV);
        }
        $query_insert -> bindParam(":new_cv", $nameFileCV);
                
        $query_insert -> bindParam(":new_id_job_position", $getPuesto);
        $query_insert -> bindParam(":new_admission_date", $getFecha);
        $query_insert -> execute();

        $mensaje="Registro agregado";
        header("Location:index.php?mensaje=".$mensaje);
        // header("Location:index.php");
    }

    // para la lista puesto de trabajo 
    $queryNew = $conexion -> prepare("SELECT * FROM `job_position`");
    $queryNew -> execute();
    $response_all_job_position = $queryNew->fetchAll(PDO::FETCH_ASSOC); // para su uso en html
?>


<?php include("../../templates/header.php"); ?>

Crear empreado
<div class="card">
    <div class="card-header">
        Datos del empleado
    </div>
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">

        <div class="mb-3">
          <label for="primerNombre" class="form-label">Primer nombre</label>
          <input type="text" 
            class="form-control" name="primerNombre" id="primerNombre" aria-describedby="helpId" placeholder="Primer nombre">          
        </div>
        <div class="mb-3">
          <label for="segundoNombre" class="form-label">Segundo Nombre</label>
          <input type="text"
            class="form-control" name="segundoNombre" id="segundoNombre" aria-describedby="helpId" placeholder="Segundo Nombre">          
        </div>
        <div class="mb-3">
          <label for="primerApellido" class="form-label">Primer aperllido</label>
          <input type="text"
            class="form-control" name="primerApellido" id="primerApellido" aria-describedby="helpId" placeholder="Primer apellido">          
        </div>
        <div class="mb-3">
          <label for="segundoApellido" class="form-label">Segundo Apellido</label>
          <input type="text"
            class="form-control" name="segundoApellido" id="segundoApellido" aria-describedby="helpId" placeholder="Segundo Apellido">          
        </div>
        <div class="mb-3">
          <label for="foto" class="form-label">Foto:</label>
          <input type="file"
            class="form-control" name="foto" id="foto" aria-describedby="helpId" placeholder="Foto">
        </div>
        <div class="mb-3">
          <label for="cv" class="form-label">CV .pdf</label>
          <input type="file"
            class="form-control" name="cv" id="cv" aria-describedby="fileHelpId" placeholder="CV">
        </div>
        <div class="mb-3">
            <label for="puesto" class="form-label">Puesto:</label>
            <select class="form-select form-select-lg" name="puesto" id="puesto">
              <?php foreach ($response_all_job_position as $valueJobPosition) { ?>
                <option value="<?php echo $valueJobPosition["id"]; ?>"> <?php echo $valueJobPosition["name_job_position"];  ?></option>
              <?php } ?>
                
            </select>
        </div>
        <div class="mb-3">
          <label for="fechaIngreso" class="form-label">Fecha ingreso</label>
          <input type="date"
            class="form-control" name="fechaIngreso" id="fechaIngreso" aria-describedby="dateHelpId" placeholder="Fecha de ingreso">          
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
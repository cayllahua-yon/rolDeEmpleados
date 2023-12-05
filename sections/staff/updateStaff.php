<?php
include("../../bd.php");

if (isset($_GET['valueID'])) {  //  MEJORAR ESTA AREA
    $valueID = isset($_GET['valueID'])?$_GET['valueID']:"";

    $querySelect = $conexion->prepare("SELECT * FROM staff WHERE id=:id");
    $querySelect -> bindParam(":id", $valueID);
    $querySelect -> execute();
    //Cargamos un solo registro
    $imprimirConsulta = $querySelect->fetch(PDO::FETCH_LAZY);

    $showId = $imprimirConsulta["id"];
    $showFirstName = $imprimirConsulta["first_name"];
    $showSecondName = $imprimirConsulta["second_name"];
    $showFirstSurname = $imprimirConsulta["first_surname"];
    $showSecondSurname = $imprimirConsulta["second_surname"];
    $showPhoto = $imprimirConsulta["photo"];
    $showCV = $imprimirConsulta["cv"];
    $showJobPosition = $imprimirConsulta["id_job_position"];

    $showAdmissionDate = $imprimirConsulta["admission_date"];
}  


if ($_POST) { // si existe un envio- recepcionar esos datos
     print_r($_POST); //imprimir en pantalla // datos locales
     print_r($_FILES); 

    $newValueID = isset($_GET['valueID'])?$_GET['valueID']:"";

    $getPrimerNombre = (isset($_POST["primerNombre"])?$_POST["primerNombre"]:"");
    $getSegunfoNombre = (isset($_POST["segundoNombre"])?$_POST["segundoNombre"]:"");
    $getPrimerApellido = (isset($_POST["primerApellido"])?$_POST["primerApellido"]:"");
    $getSegundoApellido = (isset($_POST["segundoApellido"])?$_POST["segundoApellido"]:"");

    $getFoto = (isset($_FILES["foto"]["name"])?$_FILES["foto"]["name"]:"");
    $getCV = (isset($_FILES["cv"]["name"])?$_FILES["cv"]["name"]:"");

    $getPuesto = (isset($_POST["puesto"])?$_POST["puesto"]:"");
    $getFecha = (isset($_POST["fechaIngreso"])?$_POST["fechaIngreso"]:"");
   
    $query_insert = $conexion -> prepare("UPDATE staff SET first_name=:new_first_name, second_name=:new_second_name, first_surname=:new_first_surname, second_surname=:new_second_surname, id_job_position=:new_id_job_position, admission_date=:new_admission_date WHERE id=:id");
    // , photo=:new_photo, cv=:new_cv
    $query_insert -> bindParam(":id", $newValueID);
    $query_insert -> bindParam(":new_first_name", $getPrimerNombre);
    $query_insert -> bindParam(":new_second_name", $getSegunfoNombre);
    $query_insert -> bindParam(":new_first_surname", $getPrimerApellido);
    $query_insert -> bindParam(":new_second_surname", $getSegundoApellido);

    $query_insert -> bindParam(":new_id_job_position", $getPuesto);
    $query_insert -> bindParam(":new_admission_date", $getFecha);
    $query_insert -> execute();  
   
    

    // identificador unico para la foto por mas que sea la misma foto subida
    $fecha_new = new DateTime(); // pra cambiar nombre
    
    $nameFilePhoto = ($getFoto!="")?$fecha_new->getTimestamp()."_".$_FILES["foto"]["name"]:"";
    $tmpPhoto = $_FILES["foto"]["tmp_name"];
    
    if ($tmpPhoto!="") {
        move_uploaded_file($tmpPhoto,"./".$nameFilePhoto); // hacemos una copia en el disco la ubicacion

        //buscamos la foto vieja 
        $querySelect = $conexion -> prepare("SELECT photo  FROM `staff` WHERE id=:id");
        $querySelect -> bindParam(":id", $valueID);
        $querySelect -> execute();
        $response_photo = $querySelect->fetch(PDO::FETCH_LAZY); 
        //si se encuentra y existe 
        if(isset($response_photo['photo']) && $response_photo['photo']!=""){ 
            if (file_exists("./".$response_photo["photo"])) {       
                unlink("./".$response_photo["photo"]);      //  lo borramos
            }
        }

        $query_insert = $conexion->prepare("UPDATE staff SET photo=:new_photo WHERE id=:id");
        $query_insert -> bindParam(":new_photo", $nameFilePhoto);
        $query_insert -> bindParam(":id", $newValueID);
        $query_insert -> execute();  
    }
    // $query_insert -> bindParam(":new_photo", $nameFilePhoto); // ahora le pasamos el nueva ruta completa

    //para cv
    $nameFileCV = ($getCV!="")?$fecha_new->getTimestamp()."_".$_FILES["cv"]["name"]:"";
    $tmpCV = $_FILES["cv"]["tmp_name"];
    
    if ($tmpCV!="") {
      move_uploaded_file($tmpCV,"./".$nameFileCV);
        //buscamos la foto vieja 
        $querySelect = $conexion -> prepare("SELECT cv  FROM `staff` WHERE id=:id");
        $querySelect -> bindParam(":id", $valueID);
        $querySelect -> execute();
        $response_cv = $querySelect->fetch(PDO::FETCH_LAZY); 
        //si se encuentra y existe 
        if(isset($response_cv['cv']) && $response_cv['cv']!=""){ 
            if (file_exists("./".$response_cv["cv"])) {       
                unlink("./".$response_cv["cv"]);      //  lo borramos
            }
        }

        $query_insert = $conexion->prepare("UPDATE staff SET cv=:new_cv WHERE id=:id");
        $query_insert -> bindParam(":new_cv", $nameFileCV);
        $query_insert -> bindParam(":id", $newValueID);
        $query_insert -> execute();  

    }
    // $query_insert -> bindParam(":new_cv", $nameFileCV);
    
    // $query_insert -> bindParam(":new_photo", $getFoto);
    // $query_insert -> bindParam(":new_cv", $getCV);
    // $queryUpdate -> execute();
    header("Location:index.php");
}

    $queryNew = $conexion -> prepare("SELECT * FROM `job_position`");
    $queryNew -> execute();
    $response_all_job_position = $queryNew->fetchAll(PDO::FETCH_ASSOC); // para su uso en html

?>

<?php include("../../templates/header.php"); ?>
actualizar Empleados
<div class="card">
    <div class="card-header">
        Datos del empleado
    </div>
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">
        <div class="mb-3">
          <label for="idUser" class="form-label">ID</label>
          <input type="text" value="<?php echo $showId  ?>" readonly
            class="form-control" name="idUser" id="idUser" aria-describedby="helpId" placeholder="idUser">          
        </div>
        <div class="mb-3">
          <label for="primerNombre" class="form-label">Primer nombre</label>
          <input type="text" value="<?php echo $showFirstName?>"
            class="form-control" name="primerNombre" id="primerNombre" aria-describedby="helpId" placeholder="Primer nombre">          
        </div>
        <div class="mb-3">
          <label for="segundoNombre" class="form-label">Segundo Nombre</label>
          <input type="text" value="<?php echo $showSecondName?>"
            class="form-control" name="segundoNombre" id="segundoNombre" aria-describedby="helpId" placeholder="Segundo Nombre">          
        </div>
        <div class="mb-3">
          <label for="primerApellido" class="form-label">Primer aperllido</label>
          <input type="text" value="<?php echo $showFirstSurname?>"
            class="form-control" name="primerApellido" id="primerApellido" aria-describedby="helpId" placeholder="Primer apellido">          
        </div>
        <div class="mb-3">
          <label for="segundoApellido" class="form-label">Segundo Apellido</label>
          <input type="text" value="<?php echo $showSecondSurname?>"
            class="form-control" name="segundoApellido" id="segundoApellido" aria-describedby="helpId" placeholder="Segundo Apellido">          
        </div>
        <div class="mb-3">
          <label for="foto" class="form-label">Foto: </label>
          <br/>
          <a name="cv" id="cv" href="<?php echo $showPhoto; ?>" role="button" target="_blank" > 
            <img width="50" height="50" class="rounded" src="<?php echo $showPhoto; ?>" alt="">
          </a>
          
          <input type="file"
            class="form-control" name="foto" id="foto" aria-describedby="helpId" placeholder="Foto">
        </div>
        <div class="mb-3">
          <label for="cv" class="form-label">CV:</label>
          <a name="cv" id="cv" href="<?php echo $showCV; ?>" role="button" target="_blank"> <?php echo $showCV?></a>

          <input type="file" 
            class="form-control" name="cv" id="cv" aria-describedby="fileHelpId" placeholder="CV">
        </div>
        <div class="mb-3">
            <label for="puesto" class="form-label">Puesto: </label>
            <select class="form-select form-select-lg" name="puesto" id="puesto">
              <?php foreach ($response_all_job_position as $valueJobPosition) { ?>
                <option <?php echo ($showJobPosition==$valueJobPosition["id"])?"selected":"" ?>    value="<?php echo $valueJobPosition["id"]; ?>"> <?php echo $valueJobPosition["name_job_position"];  ?></option>
              <?php } ?>
                
            </select>
        </div>
        <div class="mb-3">
          <label for="fechaIngreso" class="form-label">Fecha ingreso</label>
          <input type="date" value="<?php echo $showAdmissionDate?>"
            class="form-control" name="fechaIngreso" id="fechaIngreso" aria-describedby="dateHelpId" placeholder="Fecha de ingreso">          
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
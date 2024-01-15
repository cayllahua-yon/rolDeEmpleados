<?php
    include("../../bd.php");

    if (isset($_GET['valueID'])) {  //  MEJORAR ESTA AREA --ELIMINAR
        $valueID = isset($_GET['valueID'])?$_GET['valueID']:"";
        //buscamos el archivo relacionado con el empleado
        $querySelect = $conexion -> prepare("SELECT photo,cv  FROM `staff` WHERE id=:id");
        $querySelect -> bindParam(":id", $valueID);
        $querySelect -> execute();
        $response_photo_cv = $querySelect->fetch(PDO::FETCH_LAZY); 

        if(isset($response_photo_cv['photo']) && $response_photo_cv['photo']!=""){
            if (file_exists("./".$response_photo_cv["photo"])) {
                unlink("./".$response_photo_cv["photo"]);
            }
        }
        if(isset($response_photo_cv['cv']) && $response_photo_cv['cv']!=""){
            if (file_exists("./".$response_photo_cv["cv"])) {
                unlink("./".$response_photo_cv["cv"]);
            }
        }

        $queryDelete = $conexion->prepare("DELETE FROM staff WHERE id=:id");
        $queryDelete -> bindParam(":id", $valueID);
        $queryDelete -> execute();
        
        $mensaje="Registro eliminado";
        header("Location:index.php?mensaje=".$mensaje);
        // header("Location:index.php");
    }

    $queryNew = $conexion -> prepare("SELECT *, (SELECT name_job_position FROM job_position WHERE job_position.id = staff.id_job_position) as position FROM `staff`");
    $queryNew -> execute();
    $response_all_staffs = $queryNew->fetchAll(PDO::FETCH_ASSOC); // para su uso en html
    // print_r($response_all_staff);

    
?>

<?php include("../../templates/header.php"); ?>

<br/>
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between">
            <h4 class="">Empleados</h4>
            <a name="" id="" class="btn btn-primary" href="createStaff.php" role="button">Crear Empleado</a>
        </div>
    </div>
    <div class="card-body">

        <div class="table-responsive-sm">
            <table class="table" id="tabla_id">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Foto</th>
                        <th scope="col">CV</th>
                        <th scope="col">Puesto</th>
                        <th scope="col">Fecha Ingreso</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($response_all_staffs as $valueStaff) { ?>
                        
                    <tr class="">
                        <td><?php echo $valueStaff["id"]; ?></td>
                        <td scope="row"><?php echo $valueStaff["first_name"]." ".$valueStaff["second_name"]." ".$valueStaff["first_surname"]." ".$valueStaff["second_surname"];  ?></td>
                        <td>
                            <img width="50" height="50" src=" <?php echo $valueStaff["photo"]; ?>" alt="" class="object-fit-cover border rounded">    
                        </td>
                        <td> <a href=" <?php echo $valueStaff["cv"]; ?>"  target="_blank">  <?php echo $valueStaff["cv"]; ?>  </a> </td>
                        <td><?php echo $valueStaff["position"]; ?></td>
                        <td><?php echo $valueStaff["admission_date"]; ?></td>
                        <td>
                            <a name="btnCertificado" id="btnCertificado" class="btn btn-primary" href="cartaRecomendacion.php?valueID=<?php echo $valueStaff["id"]; ?>" role="button" target="_blank">Certificado</a>
                            <a name="btnEditar" id="btnEditar" class="btn btn-success" href="updateStaff.php?valueID=<?php echo $valueStaff["id"]; ?>" role="button">Editar</a>
                            <!-- <a name="btnEliminar" id="btnEliminar" class="btn btn-danger" href="index.php?valueID=<?php echo $valueStaff["id"]; ?>" role="button">Eliminar</a> -->
                            <a name="btnEliminar" id="btnEliminar" class="btn btn-danger" href="javascript:borrar( <?php echo $valueStaff["id"]; ?> )" role="button">Eliminar</a>
                        </td>
                    </tr>
                    <?php } ?> 
                    
                </tbody>
            </table>
        </div>
            
    </div>
</div>

<?php include("../../templates/footer.php"); ?>
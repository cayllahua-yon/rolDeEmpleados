<?php
    include("../../bd.php");

    if (isset($_GET['valueID'])) {  //  MEJORAR ESTA AREA
        $valueID = isset($_GET['valueID'])?$_GET['valueID']:"";
        $queryDelete = $conexion->prepare("DELETE FROM job_position WHERE id=:id");
        $queryDelete -> bindParam(":id", $valueID);
        $queryDelete -> execute();
        header("Location:index.php");
    }

    $queryNew = $conexion -> prepare("SELECT * FROM `job_position`");
    $queryNew -> execute();
    $response_all_job_position = $queryNew->fetchAll(PDO::FETCH_ASSOC); // para su uso en html
    // print_r($response_all_job_position);

    
?>

<?php include("../../templates/header.php"); ?>

Listar puesto de trabajo
<br/ >

<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between">
            <h4>Puesto de trabajo</h4>    
            <a name="" id="" class="btn btn-primary" href="createJobPosition.php" role="button">Crear</a>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive-sm">
            <table class="table table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre del puesto</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php  foreach ($response_all_job_position as $valorMostrar) {?>
                        <tr class="">
                        <td scope="row"><?php echo $valorMostrar["id"]; ?></td>
                        <td><?php echo $valorMostrar["name_job_position"]; ?></td>
                        <td>
                            
                            <a name="btnEditar" id="btnEditar" class="btn btn-primary" href="updateJobPosition.php?valueID=<?php echo $valorMostrar["id"]; ?>" role="button">Editar</a>
                            
                            <a name="btnEliminar" id="btnEliminar" class="btn btn-danger" href="index.php?valueID=<?php echo $valorMostrar["id"]; ?>" role="button">Eliminar</a>
                        </td>
                         </tr>
                    <?php } ?>
                    
                    <!-- <tr class="">
                        <td scope="row">2</td>
                        <td>Item</td>
                        <td>Item</td>
                    </tr> -->
                </tbody>
            </table>
        </div>
        

    </div>
</div>


<?php include("../../templates/footer.php"); ?>
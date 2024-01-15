<?php
    include("../../bd.php");
    
    if (isset($_GET['valueID'])) {  //  MEJORAR ESTA AREA
        $valueID = isset($_GET['valueID'])?$_GET['valueID']:"";
        $queryDelete = $conexion->prepare("DELETE FROM user WHERE id=:id");
        $queryDelete -> bindParam(":id", $valueID);
        $queryDelete -> execute();
        //header("Location:index.php");
        $mensaje="Registro eliminado";
        header("Location:index.php?mensaje=".$mensaje);
    }

    $queryNew = $conexion -> prepare("SELECT * FROM `user`");
    $queryNew -> execute();
    $response_all_users = $queryNew->fetchAll(PDO::FETCH_ASSOC); // para su uso en html
    // print_r($response_all_users);

    
?>

<?php include("../../templates/header.php"); ?>
Listar Usuarios
<br/ >

<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between">
            <h4>Usuarios</h4>    
            <a name="" id="" class="btn btn-primary" href="createUser.php"button">Crear</a>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive-sm">
            <table class="table table"  id="tabla_id">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre de usuario</th>
                        <th scope="col">Contraseña</th>
                        <th scope="col">Correo</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody> 
                    <?php foreach ($response_all_users as $user) {?>
                    <tr class="">
                        <td scope="row"><?php echo $user["id"]?></td>
                        <td><?php echo $user["user_name"]?></td>
                        <td>*********</td>
                        <td><?php echo $user["user_correo"]?></td>
                        <td>
                            <a name="btnEditar" id="btnEditar" class="btn btn-primary" href="updateUser.php?valueID=<?php echo $user["id"]; ?>" role="button">Editar</a>
                            
                            <a name="btnEliminar" id="btnEliminar" class="btn btn-danger" href="javascript:borrar( <?php echo $user["id"]; ?> )" role="button">Eliminar</a>

                        </td>
                    </tr>
                    <?php  } ?>
                </tbody>
            </table>
        </div>
        

    </div>
</div>


<?php include("../../templates/footer.php"); ?>
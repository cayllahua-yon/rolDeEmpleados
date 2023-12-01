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
            <table class="table table">
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
                    <tr class="">
                        <td scope="row">1</td>
                        <td>Yon cayllahua</td>
                        <td>********</td>
                        <td>yon@gmail.com</td>
                        <td>
                            <input name="btnEditar" id="btnEditar" class="btn btn-primary" type="button" value="Editar">
                            <input name="btnEliminar" id="btnEliminar" class="btn btn-danger " type="button" value="Elimnar">
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        

    </div>
</div>


<?php include("../../templates/footer.php"); ?>
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
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Foto</th>
                        <th scope="col">CV</th>
                        <th scope="col">Puesto</th>
                        <th scope="col">Fecha Ingreso</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="">
                        <td scope="row">Yon</td>
                        <td>imagen.png</td>
                        <td>cv.pdf</td>
                        <td>Programador Junior</td>
                        <td>12/12/2023</td>
                        <td>
                            <a name="" id="" class="btn btn-primary" href="#" role="button">Certificado</a>
                            <a name="" id="" class="btn btn-success" href="#" role="button">Editar</a>
                            <a name="" id="" class="btn btn-danger" href="#" role="button">Eliminar</a>
                        </td>
                    </tr>
                    <tr class="">
                    <td scope="row">Yon</td>
                        <td>imagen.png</td>
                        <td>cv.pdf</td>
                        <td>Programador Junior</td>
                        <td>12/12/2023</td>
                        <td>Carta|Editar|Eliminar</td>
                    </tr>
                </tbody>
            </table>
        </div>
            
    </div>
</div>

<?php include("../../templates/footer.php"); ?>
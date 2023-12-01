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
                <option selected>Select one</option>
                <option value="">New Delhi</option>
                <option value="">Istanbul</option>
                <option value="">Jakarta</option>
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
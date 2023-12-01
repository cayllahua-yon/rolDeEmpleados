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
        </form>
        <button type="submit" class="btn btn-success">Agregar</button>
        <a name="" id="" class="btn btn-danger" href="index.php" role="button">Cancelar</a>
        
    </div>
</div>

<?php include("../../templates/footer.php"); ?>
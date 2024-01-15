<?php 
session_start();
    // print_r($_POST);
    if($_POST){
        include("./bd.php");

        $queryNew = $conexion -> prepare("SELECT *, count(*) as n_user FROM `user` WHERE user_name=:usuario AND user_password=:contrasena");
        
        $usuario = $_POST["usuario"];
        $contrasena = $_POST["contrasena"];

        $queryNew->bindParam(":usuario", $usuario);
        $queryNew->bindParam(":contrasena", $contrasena);

        $queryNew -> execute();
        
        $response_one_user = $queryNew->fetch(PDO::FETCH_LAZY); 
        if($response_one_user["n_user"]>0){
            $_SESSION['usuario']=$response_one_user["user_name"];
            $_SESSION['logueado']= true;
            header("Location:index.php");
        } else{
            $mensaje= "Error. El usuario o contraseña son incorrecto";
        }
        print_r( $response_one_user);
    }    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</head>
<body>
    <header>

    </header>
    <main class="container">
    <div class="row">
        <div class="col-md-4">

        </div>
        <div class="col-md-4">
        <br/>
        <br/>
            <div class="card">
                
                <div class="card-header">Login</div>
                <div class="card-body">
                    <?php if(isset($mensaje)){ ?>
                        <div class="alert alert-danger" role="alert" >
                            <strong><?php echo $mensaje;?></strong> 
                        </div>
                    <?php }?>
                    
                    <form action="" method="POST">
                        <div class="mb-3">
                            <label for="" class="form-label">Usuario</label>
                            <input type="text" class="form-control" name="usuario" id="usuario" placeholder="Usuario"  />
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" name="contrasena" id="contrasena" placeholder="contraseña"  />
                        </div>
                        <button type="submit" class="btn btn-primary">Ingresé al sistema</button>
                    </form>

                </div>
            </div>
            

        </div>
    </div>
    </main>
    <footer>

    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>
</html>
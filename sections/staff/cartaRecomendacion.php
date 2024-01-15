<?php
include("../../bd.php");

if (isset($_GET['valueID'])) {  //  MAJORA ESTA AREA
    $valueID = isset($_GET['valueID'])?$_GET['valueID']:"";

    $querySelect = $conexion->prepare("SELECT *, 
    (SELECT name_job_position FROM job_position WHERE job_position.id=staff.id_job_position limit 1) as puesto FROM staff WHERE id=:id");

    $querySelect -> bindParam(":id", $valueID);
    $querySelect -> execute();
    //Cargamos un solo registro
    $imprimirConsulta = $querySelect->fetch(PDO::FETCH_LAZY);

    print_r($imprimirConsulta);

    $showId = $imprimirConsulta["id"];
    $showFirstName = $imprimirConsulta["first_name"];
    $showSecondName = $imprimirConsulta["second_name"];
    $showFirstSurname = $imprimirConsulta["first_surname"];
    $showSecondSurname = $imprimirConsulta["second_surname"];

    $nombreCompleto =  $showFirstName." ".$showSecondName." ".$showFirstSurname." ".$showSecondSurname;

    $showPhoto = $imprimirConsulta["photo"];
    $showCV = $imprimirConsulta["cv"];
    
    $showJobPosition = $imprimirConsulta["id_job_position"];
    $puesto = $imprimirConsulta["puesto"]; 

    $showAdmissionDate = $imprimirConsulta["admission_date"];

    $fechaInicio = new DateTime($showAdmissionDate);
    $fechaFin= new DateTime(date('Y-m-d'));
    $diferencia = date_diff($fechaInicio,$fechaFin);
} 

ob_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carta de recomendación</title>
</head>
<body>
    <h1>Carta de Recomendación Laboral</h1>
    <br/>
    <br/>
    Yon Cayllahua, Perú <strong> <?php echo date("d M Y") ?> </strong>
    A quien puede interesar:
    <br/>
    <br/>
    Reciba un cordial y respetuoso saludo.
    <br/>
    <br/>
    A través de estas líneas deseo hacer conocimiento que Sr(a) <strong><?php echo  $nombreCompleto; ?> </strong>,
    quien laboró en mi organización durante <strong> <?php echo $diferencia -> y ; ?> años </strong>
    es un ciudadano con una conducta inntachable. ha demostrado ser un gran trabajador,
    comprometido, responsable y fiel cumplimiento de sus tareas.
    Siempre ha manifestado preocupación por mejorar, capcacitarse y actualizar sus conocimientos.
    <br/>
    <br/>
    Durante estos años se ha desempeñado como: <strong> <?php echo $puesto; ?> </strong>.
    Es por ello le suiero considere esta recomendación, con la confianza de que estará siempre a la altura de sus compromisos y responsabilidades.
    <br/>
    <br/>
    Sin más nada a que referirme y, esperando que esta misiva sea tomada en cuenta, dejo mi número de contato para cualquier información de interés.
    <br/>
    <br/>
    Atentamente,
    <br/>
    Ing. Yon Cayllahua
    

</body>
</html>

<?php
    $contenido= ob_get_clean();
    require_once("../../libs/autoload.inc.php");
    use Dompdf\Dompdf;
    $dompdf = new Dompdf();

    $opciones = $dompdf -> getOptions();
    $opciones -> set(array("isRemoteEnabled"=> true));
    
    $dompdf->setOptions($opciones);
    $dompdf-> loadHtml($contenido);

    $dompdf-> setPaper('letter');
    $dompdf->render();
    header("Content-type: application/pdf");
    header("Content-Disposition: inline; filename=cartaDeRecomendacion.pdf");
    //$dompdf->stream("archivo.pdf", array("Attachment"=>false));
    echo $dompdf->output();
    
?>
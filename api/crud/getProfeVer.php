<?php 
include '../conexion.php';

$temporal = array();
$resultado = array();

 $sel = $con->query("SELECT DISTINCT p.id as id, pa.id_profe as id_profe, p.nombres as nombre_profe, p.apellidos as apellido_profe FROM profe_asig pa LEFT JOIN profesor p ON pa.id_profe=p.id ORDER BY nombre_profe ASC");


while ($f = $sel->fetch_assoc()) {
    $temporal = $f;
    array_push($resultado, $temporal);
}

echo json_encode($resultado);

$sel->close();
$con->close();

?>
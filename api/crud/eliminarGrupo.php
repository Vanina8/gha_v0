<?php 
include '../conexion.php';
$id = htmlentities($_GET['id']);
$res1=true;
$res2=true;
$res3=true;

$res1=eliminarDTablaGru($con, $id);
$res2=eliminarDTablaGruAsig($con, $id);
$res3=eliminarDTablaSesiones($con, $id);

if($res1 && $res2 && $res3){
    echo "success";
}else{
    echo "fail";
}
$con->close();

function eliminarDTablaGru($con, $idGru){

        $del = $con->prepare("DELETE FROM grupo WHERE id = ? ");
        $del->bind_param("i", $idGru);

        if ($del->execute()) {
            return true;
        } else {
            return false;
        }
}
function eliminarDTablaGruAsig($con, $idGru){
        $del = $con->prepare("DELETE FROM grupo_asig WHERE id_grupo = ? ");
        $del->bind_param("i", $idGru);

        if ($del->execute()) {
            return true;
        } else {
            return false;
        }
}
function eliminarDTablaSesiones($con, $idGru){
    $del = $con->prepare("DELETE FROM sesion WHERE id_grupo = ? ");
    $del->bind_param("i", $idGru);

    if ($del->execute()) {
        return true;
    } else {
        return false;
    }
}

?>
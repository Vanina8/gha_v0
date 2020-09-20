<?php
 
require_once("../conexion.php");


if($_SERVER['REQUEST_METHOD'] == 'POST'){
    
       
    $nombre= mysqli_real_escape_string($con, $_POST['nombre']);
    $apellido= mysqli_real_escape_string($con, $_POST['apellido']);
    $email= mysqli_real_escape_string($con, htmlentities($_POST['email']));
    $pass= mysqli_real_escape_string($con, htmlentities($_POST['pass']));
    $dni= mysqli_real_escape_string($con, htmlentities($_POST['dni']));
    $telefono= mysqli_real_escape_string($con, htmlentities($_POST['telefono']));
    $rol= $_POST['rol'];
    $estado= array_key_exists('estado', $_POST) ? 1 : 0 ;

    $passEncriptada= password_hash($pass, PASSWORD_BCRYPT);
    $id='';

    $extension='';
    $ruta='../api/login/foto_perfil';
    $archivo= $_FILES['foto']['tmp_name'];
    $nombrearchivo=$_FILES['foto']['name'];
    $info= pathinfo($nombrearchivo);
    if($archivo!=''){
        $extension= $info['extension'];

        if($extension=='png' || $extension=='PNG' || $extension=='jpg' || $extension== 'JPG'){
            $nombreFile=$dni.'.'.$extension;
            move_uploaded_file($archivo, '../login/foto_perfil/'.$nombreFile);
            $ruta=$ruta.'/'.$nombreFile;
        }else{
            echo "fail";
            exit;
        }
    }else{
        $ruta='../api/login/foto_perfil/perfil.jpg';
    }


    $ins = $con -> prepare("INSERT INTO profesor VALUES (?,?,?,?,?,?,?,?,?,?)");
    $ins->bind_param("isssssiiss",$id,$nombre, $apellido, $dni, $email, $passEncriptada, $estado, $rol, $telefono, $ruta);


    if ($ins->execute()) {
        echo "success";
    } else {
        echo "fail";
    }
    $ins->close();
    
}else{
    header("location:../../index.php");
}

$con->close();
?>
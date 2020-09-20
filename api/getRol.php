<?php
 @session_start();

if(strtoupper($_SESSION['rol'])=="ADMINISTRADOR"){
    echo '1';
}
if(strtoupper($_SESSION['rol'])=="COORDINADOR"){
    echo '2';
}
if(strtoupper($_SESSION['rol'])=="PROFESOR"){
    echo '3';
}


?>
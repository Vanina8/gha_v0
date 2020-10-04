<?php
    @session_start();
    if(isset($_SESSION['user'])){
        header("location:../principal");
    }
    include "../includes/headerLogin.php";
?> 
<div class="row col-12 w-100 justify-content-center  h-100 align-middle"> 

    <div class='col-4 mt-5 mb-5 p-0 shadow rounded align-baseline h-75 fondo-login' >
            <div class='container-fluid col-12 p-0 m-0 h-100 w-100 text-center align-middle'>
              <img src="../css/agha.png" alt="gestion de horarios" width="100%" height="100%">
            </div>
    </div>

    <div class='col-4  mt-5 mb-5 shadow rounded align-baseline h-75 fondo-login'>

        <div class="container-fluid col-12 pt-4 pb-4">
        
            <h5 class="card-header info-color white-text text-center py-4 w-100 ">
            <strong>Inicio sesión</strong>
            </h5>

            <!--Card content-->
            <div class="card-body px-lg-5 pl-5 pr-5 pt-5 col-8 container-fluid ">

            <!-- Form -->
            <form class="text-center" style="color: #757575;" id="inicioSesion"  @submit.prevent="login">
                    <div class="form-row">
                        <div class="col pt-4">
                            <!-- E-mail -->
                            <div class="md-form">
                                <input type="email" name="email" id="materialRegisterFormEmail" class="form-control" required  pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$">
                                <label for="materialRegisterFormEmail">Correo electronico</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col">
                            <!-- Password -->
                            <div class="md-form">
                                <input type="password" name="pass" id="materialRegisterFormPassword" class="form-control" aria-describedby="materialRegisterFormPasswordHelpBlock" required pattern="[A-Za-z0-9]{8,15}">
                                <label for="materialRegisterFormPassword">Password</label>
                                <small id="materialRegisterFormPasswordHelpBlock" class="form-text text-muted mb-4">
                                    mínimo 6 caracteres y máximo 8
                                </small>
                            </div>
                        </div>
                    </div>
                <!-- Enviar  -->
                <button class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect" type="submit">Enviar</button>
                <hr>
            </form>
            <!-- Form -->
            </div>
        </div>
    </div>
</div>

<?php
    include "../includes/footerLogin.php";
?>

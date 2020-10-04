<?php   include '../includes/header.php';
@session_start();
include "../includes/menucompleto.php";
?>

<!--Navbar-->
    <nav class="navbar navbar-light">
        <div class="form-inline active-cyan-3 active-cyan-4 px-2 pt-4">                              
            <label for="" class="pr-2">Buscando Usuarios</label>
            <input class="form-control" type="text" placeholder="Search" aria-label="Search" v-model="buscar">
            <!-- <button class="btn  blue-gradient btn-md my-2 my-sm-0 ml-3" type="submit">Search</button> -->
        </div>
    </nav>
<!--/.Navbar-->

<div class="container" >
    <div class="row justify-content-center">
        <div class="col-8 pb-5 ">
            <div class="row"  v-for="item in datosFiltradosUsu">
                <div class="col-12 pt-5">
                    <!-- Card Wider -->
                    <div class="card card-cascade wider row"  >

                            <!-- Card content -->
                                <div class="row d-flex">

                                    <div class='col-3'>
                                        <img :src="item.p_foto" :alt="item.p_foto" width="200" height='200' class='circle'>
                                    </div>

                                    <div class='col-9'>
                                        <div class="card-body card-body-cascade text-center pb-0"  >
                                            <!-- Title -->
                                            <h4 class="card-title"><strong>{{item.p_nombre}} {{item.p_apellido}}</strong></h4>
                                        </div>
                                        <!-- Subtitle -->
                                        <h5 class="blue-text pb-2 text-center"><strong>{{item.p_dni}} - {{item.p_estado}}</strong></h5>

                                        <!-- Text -->
                                        <p class="card-text text-center">{{item.r_nombre}}</p>
                                         <!-- Card footer -->
                                        <div class="card-footer text-muted text-center mt-0">
                                            <div> <i class="far fa-envelope pr-1"> </i>{{item.p_email}} </div>
                                            <div><i class="fas fa-mobile-alt pr-1"> </i>{{item.p_telefono}}</div>    
                                            <a class='btn btn-danger btn-sm' href="#" @click="eliminarProfe(item.p_id)"><i class="fas fa-trash"></i></a>
                                    
                                        </div>
                                    </div>
                                </div>                                   
                    </div>     
                    <!-- Card Wider -->        
                </div>
            </div>
        </div>     
    </div>
</div>
<?php
    include "../includes/footer.php";
?>

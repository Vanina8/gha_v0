<?php   include '../includes/header.php';
@session_start();
include "../includes/menucompleto.php";
?>
<div class="row container-fluid">
    <div class=" col-5 pt-5 pl-5"  data-background-color="green-dark">

        <div class="card">
                <h5 class=" info-color white-text text-center py-4">
                    <strong>Registro de Asignaturas</strong>
                </h5>

                <!--Card content-->
                <div class="card-body px-lg-5 pt-0">

                    <!-- Form -->
                    <form class="text-center" style="color: #757575;"  id="formAsignatura" autocomplete="off" @submit.prevent="registroAsignatura">

                        <div class="form-row">                
                                <!-- Codigo -->
                            <div class="md-form text-center container-fluid col-5">
                                <input type="text" id="materialRegisterFormCodigo" class="form-control" required  name="cod_asignatura" v-model="codigo_asig"  autofocus>
                                <label for="materialRegisterFormEmail">Código de asignatura</label>
                            </div>
                        </div>

                        <div class="form-row">
                                <!-- Nombre -->
                                <div class="md-form text-center container-fluid col-5">
                                    <input type="text" id="materialRegisterFormFirstName" class="form-control" required  name="nombre" value="" pattern=".{6,}]" >
                                    <label for="materialRegisterFormFirstName">Nombre</label>
                                </div>
                        </div>

                        <div class="form-row justify-content-center col-12 ">
                                <!-- Titulo -->
                                <div class="row  col-7 md-form">
                                    <div class='col-4 ' >
                                        <label for="materialRegisterFormLastName">Código título</label>
                                    </div>
                                    <div class='col-8 pl-0'>
                                        <select v-model="selected" name="cod_titulo">
                                            <option v-for="option in titulos" v-bind:value="option.id">
                                                {{ option.nombre }}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                        </div>

                        <div class="form-row container-fluid justify-content-center">
                        <!-- Estado  -->
                            <div class="row d-flex col-7 ">      
                                <div class="md-form  pb-1 mb-0 col-4 justify-content-center col-6">
                                        <label for="defaultInline1" class="pl-2 ml-0 justify-content-center ">Estado</label>  
                                        <input type="checkbox" id="defaultInline1" v-model="estadoEtiAsig" class="form-control pl-1 bg-primary " name='estado'  style="margin-left: 50px; width: 50px; height: 30px; background-color: rgba(0,0,255,0.1);"  >
                                </div>        
                                <div class="text-left pt-4 pl-2 ml-0 col-6">
                                    <small id="materialRegisterFormPhoneHelpBlock" class="form-text text-muted mb-5 mt-0 pt-0" v-if="estadoEtiAsig == true">
                                    {{etiquetaEstadoA}}
                                    </small>
                                    <small id="materialRegisterFormPhoneHelpBlock" class="form-text text-muted mb-5  mt-0 pt-0" v-if="estadoEtiAsig == false">
                                    {{etiquetaEstadoB}}
                                    </small>
                                </div>       
                            </div>
                         </div>
                        <!-- Enviar -->
                        <button class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect " type="submit">Guardar</button>
                        <hr>
                    </form>
                    <!-- Form -->
                </div>
        </div>
    </div>
    <div class="col-2">
    </div>
    <!-- Gestio de Títulos -->
    <div class="col-5 pt-5 pr-5"  data-background-color="green-dark">
        <!--Navbar-->
        <div  class="card info-color white-text">

            <form class="form-inline text-center my-2 my-lg-0 ml-auto">
                <div class="text-left">
                    <h5 class="info-color white-text text-center py-4">
                            <strong>Registro Títulos</strong>
                    </h5>
                </div>
              <button class="btn btn-outline-white btn-md my-2 my-sm-0 ml-3" type="button" data-toggle="modal" data-target="#modalNuevoTitulo">Nuevo</button>
            </form>
        </div>
        <!--/.Navbar-->

        <table class='table pt-5'>
                <tr>
                    <th>#</th><th>Nombre</th><th>Curso</th><th><i class="fas fa-wrench"></i></th>
                </tr>			
                <tr  v-for="item in titulos">
                    <td>{{item.id}}</td><td>{{item.nombre}}</td><td>{{item.curso}}</td>
                    <td>						
                        <a class='btn btn-danger btn-sm' href="#" @click="eliminarTitulo(item.id)"><i class="fas fa-trash"></i></a>
                    </td>
                </tr>
        </table>
    </div>
 </div>

<!-- Modal nuevo Titulo -->
<div class="modal fade" id="modalNuevoTitulo" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
  aria-hidden="true">

  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">

    <!-- Form -->
    <form class="text-center" style="color: #757575;"  id="formTitulo" autocomplete="off" @submit.prevent="registroTitulo">                              

            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Nueva titulación</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
            
                        <div class="form-row">                
                            <div class="md-form col-8 container-fluid">
                                <input type="text" id="materialRegisterFormEmail" required class="form-control" name="nombre" value="">
                                <label for="materialRegisterFormEmail">Nombre</label>
                            </div>
                        </div>                    
                        <div class="form-row">                
                            <div class="md-form col-6 container-fluid">
                                <label for="materialRegisterFormEmail">Curso</label>
                                <select v-model="selectedYear" name="curso" >
                                        <option v-for="optionyear in years" v-bind:value="optionyear">
                                            {{ optionyear }} - {{optionyear+1}}
                                        </option>
                                </select>
                                <span> {{ selectedYear }}</span>
                            </div>
                        </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
                <button type="submit" class="btn btn-primary" >Guardar cambios</button>
            </div>
    </from>
    </div>
  </div>
</div>

<!-- Fin modal nuevo titulo -->
<?php
        include "../includes/footer.php";
?>

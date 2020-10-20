<?php   include '../includes/header.php';
        @session_start();
        include "../includes/menucompleto.php";
?>

<div class="row container-fluid">
    <div class="col-2">
    </div>

    <div class=" col-4 ml-5 pt-5 pl-5"  data-background-color="green-dark">

        <div class="card">
                <h5 class=" info-color white-text text-center py-4">
                    <strong>Registro de Aulas</strong>
                </h5>
      
                <div class="card-body px-lg-5 pt-0 text-center">

                       
                    <!-- Form -->
                    <form class="text-center" style="color: #757575;"  id="formAula" autocomplete="off" @submit.prevent="registroAula">
                        <!-- Nombre -->
                        <div class="form-row">
                           
                        <div class="md-form text-center container-fluid col-5"> 
                                    <input type="text" id="materialRegisterFormFirstName"  v-model="nombreAula"  required  name="nombre" autofocus 
                                    class="form-control" >                                  
                                    <label for="materialRegisterFormFirstName">Nombre</label>                                                                  
                        </div>
                        </div>                                              
                        <!-- Estado name -->
                        <div class="form-row d-flex justify-content-center">                         
                                <div class="row d-flex col-5">      
                                    <div class="md-form  pb-1 mb-0 justify-content-center col-12">
                                            <label for="defaultInline1" class="pl-2 ml-0 justify-content-center ">Estado</label>  
                                            <input type="checkbox" id="defaultInline1" v-model="estadoEtiAula" class="form-control pl-1 bg-primary " name='estado' value='{{estadoEtiAsig}' style="margin-left: 50px; width: 50px; height: 30px; background-color: rgba(0,0,255,0.1);" >
                                    </div>        
                                    <div class="text-left pt-1 pl-3 ml-5 col-12">
                                        <small id="materialRegisterFormPhoneHelpBlock" class="form-text text-muted mb-5 mt-0 pt-0" v-if="estadoEtiAsig == true">
                                        {{etiquetaEstadoA}}
                                        </small>
                                        <small id="materialRegisterFormPhoneHelpBlock" class="form-text text-muted mb-5  mt-0 pt-0" v-if="estadoEtiAsig == false">
                                        {{etiquetaEstadoB}}
                                        </small>
                                    </div>       
                                </div>
                        </div>
                         <!-- Categoria de aula -->
                        <div class="form-row">                
                            <div class="md-form container-fluid col-6 d-flex justify-content-center mt-0">
                                    <div>
                                        <label for="materialRegisterFormLastName">Categoria</label>
                                    </div>   
                                    <select v-model="selectedCatAula" name="id_cate" >
                                        <option v-for="option in categoriasaulas" v-bind:value="option.id">
                                            {{ option.nombre }}
                                        </option>
                                    </select>
                            </div>
                        </div>
                        <!-- Boton Guardar -->
                        <button class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect " type="submit">Guardar</button>
                        <hr>
                    </form>
                    <!-- Form -->
                </div>
        </div>
    </div>

    <div class="col-2">
    </div>

    <div class="col-3" >    
            <!-- Listado Categoria de aulas -->
             <div class="col-12 pt-5 pr-5"  data-background-color="green-dark">
                    <!--Navbar-->
                    <div  class="card info-color white-text">
                        <form class="form-inline text-center my-2 my-lg-0 ml-auto">
                            <div class="text-left">
                                <h5 class="info-color white-text text-center py-4">
                                    <strong>Categoria de Aulas</strong>
                                </h5>
                            </div>
                            <button class="btn btn-outline-white btn-md my-2 my-sm-0 ml-3" type="button" data-toggle="modal" data-target="#modalCatAula">Nuevo</button>
                        </form>
                    </div>
                    <!--/.Navbar-->
                    <table class='table pt-5'>
                            <tr>
                                <th>#</th><th>Nombre</th><th><i class="fas fa-wrench"></i></th>
                            </tr>			
                            <tr v-for="item in categoriasaulas">
                                <td>{{item.id}}</td><td>{{item.nombre}}</td><td>						
                                <a class='btn btn-danger btn-sm' href="#" @click="eliminarCateAula(item.id)"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>            
                    </table>            
            </div>
            <!-- Listado de aulas -->
            <div class="col-12 pt-5 pr-5"  data-background-color="green-dark">
                    <!--Navbar-->
                    <div  class="card info-color white-text">
                            <div class="text-left">
                                <h5 class="info-color white-text text-center py-4">
                                       <strong>Listado de Aulas</strong>
                                </h5>
                            </div>
                    </div>
                    <!--/.Navbar-->
                    <table class='table pt-5'>
                            <tr>
                                <th>#</th><th>Nombre</th><th>Categoria</th><th>Estado</th><th><i class="fas fa-wrench"></i></th>
                            </tr>			
                            <tr v-for="item in aulas">
                                <td>{{item.id}}</td>
                                <td>{{item.nombre}}</td>
                                <td>{{item.categoria}}</td>
                                <td class="blue-text pb-2 text-center" v-if="item.estado==0"><strong>{{etiquetaEstadoA}}</strong></td>
                                <td class="blue-text pb-2 text-center" v-if="item.estado==1"><strong>{{etiquetaEstadoB}}</strong></td>

                                <td><a class='btn btn-danger btn-sm' href="#" @click="eliminarAula(item.id)"><i class="fas fa-trash"></i></a></td>
                            </tr>            
                    </table>
            </div>
    </div>
 </div>

<!-- Modal nuevo categoria de aula -->
<div class="modal fade" id="modalCatAula" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
    <!-- Form -->
    <form class="text-center" style="color: #757575;"  id="formCatAula" autocomplete="off" @submit.prevent="registroCatAula">                              

            <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Nueva categoria de aula</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
            </div>

            <div class="modal-body">          
                    <div class="form-row">                
                        <div class="md-form col-8 container-fluid">
                            <input type="text" id="materialRegisterFormEmail" required class="form-control" name="nombre" value="" autofocus>
                            <label for="materialRegisterFormEmail">Nombre</label>
                        </div>
                    </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
                <button type="submit" class="btn btn-primary" >Guardar categoria</button>
            </div>
    </from>
    </div>
  </div>

  
<script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();   
});
</script>
</div>
<!-- Fin modal nuevo titulo -->
<?php
        include "../includes/footer.php";
?>

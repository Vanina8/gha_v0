<?php   include '../includes/header.php';
@session_start();
include "../includes/menucompleto.php";

?>


<nav class="navbar navbar-light  form-inline active-cyan-3 active-cyan-4 px-2 pt-4">
<div class='col-8 d-flex justify-content-center'>
        <label for="" class="pr-2 pl-5"> Curso:</label>

            <select v-model="selectedYear" name="curso" class='form-control'>
                <option v-for="option in titulosYear" v-bind:value="option.curso" >
                    {{ option.curso }} 
                </option>
            </select>

          <label for="" class="pr-2 pl-2"> Semestre:</label>        

           <select v-model="selectedSem" name="seme" class='form-control'>
                <option v-for="option in semestres" v-bind:value="option" >
                    {{ option }} 
                </option>
            </select>

            <label for="" class="pr-2 pl-2"> Tipo:</label>        

            <select v-model="tipo" name="tipo" class='form-control'>
                    <option value="G">Grupo</option>
                    <option value="P">Profesor</option>
                    <option value="A">Aula</option>
                    <option value="As">Asignatura</option>
             </select>

           <label for="" class="pr-2 pl-2"> Nombre:</label>        

            <select v-model="id" name="seme" class='form-control'>
                <option v-for="option in datosFiltradosTipo" v-bind:value="option.id" >
                  <span v-if="tipo != 'P'">{{ option.nombre }}</span><span v-else>{{ option.nombre_profe }} {{ option.apellido_profe }}</span>   
                </option>
            </select>


        <button class="btn  blue-gradient btn-md my-2 my-sm-0 ml-5" type="button" v-on:click='infoInicio()'>Visualizar</button>
        </div>
</nav>
<!--/.Navbar -->
<div class="card text-center" v-if="mostrarPanelVer">
  <div class="card-header">
    VISUALIZAR HORARIOS
  </div>
  <div class="card-body mx-auto  col-8">
  
        <div class='row col-12 pt-4 pr-0 pl-0 ml-0 mr-0 justify-content-center' > 
            <nav class="navbar navbar-light col-12"> 
                <div class='col-2'>
                   <label class='text-center'> <strong> Tramos</strong></label>  
                </div>
                <div class='col-2'>
                   <label class='text-center'> <strong> Lunes</strong></label>  
                </div>
                <div class='col-2'>
                   <label class='text-center' > <strong> Martes</strong></label>  
                </div>
                <div class='col-2'>
                   <label class='text-center' > <strong> Miercoles</strong></label>  
                </div>
                <div class='col-2'>
                   <label class='text-center' > <strong> Jueves</strong></label>  
                </div>
                <div class='col-2'>
                   <label class='text-center' > <strong> Viernes</strong></label>  
                </div>
            </nav>
        </div>
        <div>                                                        
            <div class='row col-12 d-flex justify-content-center m-0 p-0 border' v-for="(item, index) in matrizVer" id='horarioV' >

                <div class='col-2 text-center p-0 m-0 ancho'>
                    <div  class="p-3  w-100"  >                                                    
                          <h6  > {{item[0].inicio}} - {{item[0].fin}}</h6>
                    </div>
                </div>                                                                                                                                             
                <div class='col-2 text-center p-0 m-0 ancho animate__backOutDown'>

                    <div class='cambioColor11 espacio rounded-lg' :id="'L'+index" v-show="!(item[1]=='libre')"   > 
                        <button type="button"  class="w-100" :class='item[1][1]'  v-on:click="asignaParam('As', item[1][0].s_id)"> <div >{{item[1][0].s_nombre}}</div></button> 
                        <button type="button" class="w-100" :class='item[1][1]' v-on:click="asignaParam('P', item[1][0].p_id)"><div>{{item[1][0].p_nombre}} {{item[1][0].p_apellido}}</div></button>
                        <button type="button" class="w-100" :class='item[1][1]' v-on:click="asignaParam('A', item[1][0].a_id)"><div>Aula:{{item[1][0].a_nombre}}</div></button>
                        <button type="button" class="w-100" :class='item[1][1]' v-on:click="asignaParam('G', item[1][0].g_id)"><div>Grupo:{{item[1][0].g_nombre}}</div></button>
                    </div>
                    <div class='cambioColor11 espacio rounded-lg w-100' :id="'L'+index" v-show="(item[1]=='libre')"   > 
                    -------
                    </div>

                </div>
                <div class='col-2 text-center p-0 m-0 ancho animate__backOutDown'>
                    <div class='cambioColor22 espacio rounded-lg' :id="'M'+index" v-show="!(item[2]=='libre')" >

                    <button type="button"  class="w-100" :class='item[2][1]' v-on:click="asignaParam('As', item[2][0].s_id)"> <div >{{item[2][0].s_nombre}}</div></button> 
                        <button type="button" class="w-100" :class='item[2][1]' v-on:click="asignaParam('P', item[2][0].p_id)"><div>{{item[2][0].p_nombre}} {{item[2][0].p_apellido}}</div></button>
                        <button type="button" class="w-100" :class='item[2][1]' v-on:click="asignaParam('A', item[2][0].a_id)"><div>Aula:{{item[2][0].a_nombre}}</div></button>
                        <button type="button" class="w-100" :class='item[2][1]' v-on:click="asignaParam('G', item[2][0].g_id)"><div>Grupo:{{item[2][0].g_nombre}}</div></button>
                    </div>
                    <div class='cambioColor22 espacio rounded-lg w-100' :id="'M'+index" v-show="(item[2]=='libre')"   > 
                     -------
                    </div>
                </div>

                <div class='col-2 text-center p-0 m-0 ancho'>
                    <div class='cambioColor33 espacio rounded-lg' :id="'Mi'+index" v-show="!(item[3]=='libre')">
                         <button type="button"  class="w-100" :class='item[3][1]' v-on:click="asignaParam('As', item[3][0].s_id)"> <div >{{item[3][0].s_nombre}}</div></button> 
                        <button type="button"  class="w-100" :class='item[3][1]' v-on:click="asignaParam('P', item[3][0].p_id)"><div>{{item[3][0].p_nombre}} {{item[3][0].p_apellido}}</div></button>
                        <button type="button" class="w-100" :class='item[3][1]'  v-on:click="asignaParam('A', item[3][0].a_id)"><div>Aula:{{item[3][0].a_nombre}}</div></button>
                        <button type="button" class="w-100" :class='item[3][1]'  v-on:click="asignaParam('G', item[3][0].g_id)"><div>Grupo:{{item[3][0].g_nombre}}</div></button>
                    </div>
                    <div class='cambioColor33 espacio rounded-lg w-100' :id="'Mi'+index" v-show="(item[3]=='libre')"   > 
                    -------
                    </div>
                </div>
                <div class='col-2 text-center p-0 m-0 ancho'>
                    <div class='cambioColor44 espacio rounded-lg' :id="'J'+index" v-show="!(item[4]=='libre')">
                        <button type="button" class="w-100" :class='item[4][1]' v-on:click="asignaParam('As', item[4][0].s_id)"> <div >{{item[4][0].s_nombre}}</div></button> 
                        <button type="button" class="w-100" :class='item[4][1]'  v-on:click="asignaParam('P', item[4][0].p_id)"><div>{{item[4][0].p_nombre}} {{item[4][0].p_apellido}}</div></button>
                        <button type="button" class="w-100" :class='item[4][1]' v-on:click="asignaParam('A', item[4][0].a_id)"><div>Aula:{{item[4][0].a_nombre}}</div></button>
                        <button type="button" class="w-100" :class='item[4][1]' v-on:click="asignaParam('G', item[4][0].g_id)"><div>Grupo:{{item[4][0].g_nombre}}</div></button>
                    </div>
                    <div class='cambioColor44 espacio rounded-lg w-100' :id="'J'+index" v-show="(item[4]=='libre')"   > 
                    -------
                    </div>
                </div>
                <div class='col-2 text-center p-0 m-0 ancho'>
                    <div class='cambioColor55 espacio rounded-lg' :id="'V'+index" v-show="!(item[5]=='libre')">
                        <button type="button" class="w-100" :class='item[5][1]'v-on:click="asignaParam('As', item[5][0].s_id)"> <div >{{item[5][0].s_nombre}}</div></button> 
                        <button type="button" class="w-100" :class='item[5][1]'v-on:click="asignaParam('P', item[5][0].p_id)"><div>{{item[5][0].p_nombre}} {{item[5][0].p_apellido}}</div></button>
                        <button type="button" class="w-100" :class='item[5][1]'v-on:click="asignaParam('A', item[5][0].a_id)"><div>Aula:{{item[5][0].a_nombre}}</div></button>
                        <button type="button" class="w-100" :class='item[5][1]' v-on:click="asignaParam('G', item[5][0].g_id)"><div>Grupo:{{item[5][0].g_nombre}}</div></button>
                    </div>
                    <div class='cambioColor55 espacio rounded-lg w-100' :id="'V'+index" v-show="(item[5]=='libre')"   > 
                    -------
                    </div>
                </div>              
          
            </div>
     </div>

  </div>
  <div class="card-footer text-muted">
      <div class='row container-fluid justify-content-center col-12'>
        <h4 class='col-2'>Colores distintos para:</h4>
        <h4 class='col-2'>Profesores ->Grupos</h4>
        <h4 class='col-2'>Aulas -> Asignaturas</h4>
        <h4 class='col-2'>Grupos -> Asignaturas</h4>
        <h4 class='col-2'>Asignaturas -> Profesores</h4>
      </div>
  </div>
</div>
</div>

<?php
        include "../includes/footerVer.php";
?>

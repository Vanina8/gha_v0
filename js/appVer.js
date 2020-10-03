const app = new Vue({
    el:'#app',
    data:{
        
        sesionesCG:[],
        sequeda:[],
        tramoshorario:[],

        semestres: ['1', '2'],       
        titulosYear:[],
        grupos:[],
        asignaturas:[],
        aulas:[],
        profesores:[],
          
        selectedSem:'',        // el semestre del horario
        selectedYear:'',       // Año del horario a registrar
        idHorario:-1,
        matrizVer:[],
        mostrarPanelVer: false,
        lunes:[],
        martes:[],
        miercoles:[],
        jueves:[],
        viernes:[],
        usuario:5,
        // cambiar vista de horario
        tipo:'',
        id:'',
        // agregar colores
        distinguido:[],
        colores:['btn-secondary', 'btn-success', 'btn-danger', 'btn-warning', 'btn-info', 'btn-default', 'btn-brown','btn-pink', 'btn-deep-orange','btn-unique','btn-indigo' ],  // 11 colores
        contadorDiferentes:0,
        contadorColores:0

    },
    created(){
        this.autorizamenu();
        this.getGrupos();
        this.getTitulosYear();
        this.getTramos();
        this.getAulas();
        this.getProfes();
        this.getAsignaturas();
    },
    watch:{ 
      selectedYear(newVal, oldVal){
        this.infoInicio();
      },
      selectedSem(newVal, oldVal){
        this.infoInicio();
      },
      tipo(newVal, oldVal){
        this.infoInicio();
      },
      id(newVal, oldVal){
        this.infoInicio();
      }
    },
    computed:{
        datosFiltradosTipo(){
            if(this.tipo=='P') {
                return this.profesores;
            }else if(this.tipo=='A'){
                return this.aulas;
            }else if( this.tipo==='As'){
                return this.asignaturas;
            }else if( this.tipo==='G'){
                return this.grupos;
            }
        },      
    },
    methods: {

        autorizamenu(){
            console.log('estoy en autorizacion usuairo');
                axios.get('http://localhost/gha/gha_nuevo/api/getRol.php')
                .then(res =>{                    
                  this.usuario = res.data             
                })
           },
        infoInicio(){
            if(this.selectedYear!='' && this.selectedSem!='' && this.tipo !='' && this.id !='' ){
              Swal.fire(
                'Cargó horario',
                '',
                'info'
              )
              this.verNuevo();            
            }
          },
        getSesiones($curso, $semestre, $horario){
            axios
            .get("http://localhost/gha/gha_nuevo/api/crud/getSesion.php/?curso="+$curso+"&semestre="+$semestre+"&idhorario="+$horario)
            .then((res) => {
                this.sequeda = res.data;
                if(this.sequeda.length>0){
                    this.idHorario= this.sequeda[0].id_horario;
                }else{
                  this.idHorario= -1;
                }
                this.verHorario(this.tipo, this.id);
            });             
        },
        getTitulosYear(){            
            axios
              .get('http://localhost/gha/gha_nuevo/api/crud/getTitulosYear.php')
              .then((res) => {                    
                  this.titulosYear = res.data;
              });        
          },
          getGrupos() {
              axios
                .get("http://localhost/gha/gha_nuevo/api/crud/getGrupos.php")
                .then((res) => {
                  this.grupos = res.data;
                });
          },   
          getAulas() {
            axios
              .get("http://localhost/gha/gha_nuevo/api/crud/getAulas.php")
              .then((res) => {
                this.aulas = res.data;
              });
          },    
          getProfes(){  // solo profesores con asignaturas asignadas
            axios
            .get("http://localhost/gha/gha_nuevo/api/crud/getProfeVer.php")
            .then((res) => {
              this.profesores = res.data;
            });     
          },
          getAsignaturas(){
                axios.get('http://localhost/gha/gha_nuevo/api/crud/getAsignaturas.php')
                .then(res =>{                    
                    this.asignaturas = res.data
                })
          },
          getTramos(){
            axios
              .get("http://localhost/gha/gha_nuevo/api/crud/getTramos.php")
              .then((res) => {
                this.tramoshorario = res.data;
              });             
          },  
          verNuevo(){
            this.mostrarPanelVer=true;
            this.getSesiones(this.selectedYear, this.selectedSem, this.idHorario);            
          },          
      
          encontradoProfe($dia, $tramo, $id){
            return this.sequeda.filter((filtro)=>{
                return filtro.t_id.match($tramo) && filtro.dia.match($dia) && filtro.p_id.match($id)
            });
          },
          encontradoAsig($dia, $tramo, $id){
              var elementos= this.sequeda.filter((filtro)=>{
                 return filtro.t_id.match($tramo) && filtro.dia.match($dia) && filtro.s_id.match($id)
               });
               console.log('tamaño elemento es:'+elementos.length);

                if(elementos.length>1){                    
                    console.log('elementos trae esta cantidad de items:'+elementos.length)
                        elementos.splice(1, elementos.length-1);
                        console.log(' devolvera esta cantidad de items:'+elementos.length)
                        return elementos;
                }
                return elementos;                    
          },
          encontradoGrupo($dia, $tramo, $id){
                return this.sequeda.filter((filtro)=>{
                    return filtro.t_id.match($tramo) && filtro.dia.match($dia) && filtro.g_id.match($id)
                });
          },
          encontradoAula($dia, $tramo, $id){
            return this.sequeda.filter((filtro)=>{
                return filtro.t_id.match($tramo) && filtro.dia.match($dia) && filtro.a_id.match($id)
            });
          },
          asignaParam($tipo, $id){
            this.tipo=$tipo;
            this.id=$id;
          },
          revisarDistinguir($id){
                if(!this.estaEnDistinguir($id)){
                    this.agregarADistinguir($id);
                }
                return this.dameColorDDistinguir($id);                
          },
          agregarADistinguir($id){

                var objeto= { id: $id,
                            color: this.colores[this.contadorColores]};
                this.distinguido.push(objeto);
                if(this.contadorColores+1>11){
                    this.contadorColores=0;
                }else{
                    this.contadorColores++;
                }
                return objeto.color;

          },
          estaEnDistinguir($id){
                return ( this.distinguido.findIndex(item => item.id === $id) !=  -1 ? true : false);
          },
          dameColorDDistinguir($id){
                var x= this.distinguido[this.distinguido.findIndex(item => item.id === $id)].color;
                return x;
          },        
          agregaSesion($dias, $elemento){
            if($dias==1){
                this.lunes.push($elemento);
            }else if($dias==2){
                this.martes.push($elemento);
            }else if($dias == 3){
                this.miercoles.push($elemento);
            }else if($dias == 4){
                this.jueves.push($elemento);
            }else if($dias == 5){
                this.viernes.push($elemento);
            }
          },
          agregaLibre($dias){
            if($dias==1){
                this.lunes.push('libre');
            }else if($dias==2){
                this.martes.push('libre');
            }else if($dias == 3){
                this.miercoles.push('libre');
            }else if($dias == 4){
                this.jueves.push('libre');
            }else if($dias == 5){
                this.viernes.push('libre');
            }
          },

          verHorario($tipo, $idX ){

            var fila=0;
            var elemento=[];

            this.lunes=[];
            this.martes=[];
            this.miercoles=[];
            this.jueves=[];
            this.viernes=[];
            this.distinguido=[];
            this.contadorColores=0;
            
              if($tipo ==='P'){
                for( dias=1; dias<6; dias++){

                    for (indice in this.tramoshorario){

                        elemento= this.encontradoProfe(dias, this.tramoshorario[indice].id, $idX);

                        if(elemento.length>0){

                            var $colorItem = this.revisarDistinguir(elemento[0].g_id);  // distinguirá por asignaturas
                                    
                            elemento.push($colorItem);
                            this.agregaSesion(dias, elemento);
                        }else{
                            this.agregaLibre(dias);
                        }
                    }
                }                      
              }else if($tipo==='A'){

                for( dias=1; dias<6; dias++){

                  for (indice in this.tramoshorario){

                      elemento= this.encontradoAula(dias, this.tramoshorario[indice].id, $idX);

                      if(elemento.length>0){
                        var $colorItem = this.revisarDistinguir(elemento[0].s_id);  // distinguirá por asignaturas                                    
                        elemento.push($colorItem);
                        this.agregaSesion(dias, elemento);
                      }else{
                          this.agregaLibre(dias);
                      }
                   }
                }

              }else if($tipo==='As'){

                for( dias=1; dias<6; dias++){

                  for (indice in this.tramoshorario){
              
                    elemento= this.encontradoAsig(dias, this.tramoshorario[indice].id, $idX);

                      if(elemento.length>0){
              
                         var $colorItem = this.revisarDistinguir(elemento[0].p_id);  // distinguirá por profesor                                    
                         elemento.push($colorItem);    

                          console.log('Encontrado el tipo: '+$tipo+' con id:'+$idX+' dia:'+dias+' tramo:'+this.tramoshorario[indice].id);

                          this.agregaSesion(dias, elemento);
                      }else{
                          this.agregaLibre(dias);
                      }

                   }
                }
              }else if($tipo =='G'){

                for( dias=1; dias<6; dias++){
                    
                  for (indice in this.tramoshorario){
                    
                      elemento= this.encontradoGrupo(dias, this.tramoshorario[indice].id, $idX);
                      if(elemento.length>0){

                        var $colorItem = this.revisarDistinguir(elemento[0].s_id);  // distinguirá por asignaturas                                    
                        elemento.push($colorItem);

                          this.agregaSesion(dias, elemento);
                      }else{
                          this.agregaLibre(dias);
                      }
                   }
                }
              }
              this.trasponerMatriz();
          },
          trasponerMatriz(){
            var fila=[];
            var contador=0;
            this.matrizVer=[];
            for ( contador=0; contador<5; contador++){
                    fila.push(this.tramoshorario[contador], this.lunes[contador], this.martes[contador], this.miercoles[contador], this.jueves[contador], this.viernes[contador]);    
                    this.matrizVer.push(fila);
                    fila=[];
            }
          }
    }
})

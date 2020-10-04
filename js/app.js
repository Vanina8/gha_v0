const app = new Vue({
    el:'#app',
    data:{
        menu:true,
        respuesta:'',
        listarAsig:[],
        listarPro:[],
        listarUsu:[],
        listar:[],
        titulos:[],
       
        buscar:'',
        buscarAsig:'',
        itemId:'',
        formEditar:{},
        userPost:'',
        estadoEtiAsig: false,
        estadoEtiAula: false,
        etiquetaEstadoA: "Activo",        
        etiquetaEstadoB: "Inactivo",
        years:[],
        selectedYear:'' ,
        selectedCatAula: 1,
        categoriasaulas: [],
     
        aulas:[],
        tramoshorario:[],
 
        sequeda:[],
        selectedProfe: 1,
        selectedAsig: 1,
        selectedGrupo: 1,
        selectedAula: 1,

        mostrarOpciones:false,

        buscarGrupos:'',
        buscarGruposDesA:'',
        gruposAsig:[],

        profeAsig:[],
        buscarProfe:'',
        
        selected: 1,        
        grupos:[],
        curso:'',
        semestre:'',
        estado:true,
      
        fin:'',
        inicio:'',
        codigo_asig:'',
        
        usuario:5,
        nombreAula:'',
      
            
    },
    created(){
        this.autorizamenu()
        this.getTitulos()
        this.cargaanos()
        this.getCatAulas()
        this.getGrupos()
        this.getAulas()
        this.getAsignaturas()
        this.getProfesores()
        this.getUsuarios()
        this.getTramos()
        this.getGruposAsig()
        this.getProfesAsig()
      
    },
    computed:{
        validarNombreAula(){
          if(this.nombreAula!=''){
              var encontro;
              encontro=this.aulas.filter((filtro)=>{
                return filtro.nombre.toUpperCase().match(this.nombreAula.toUpperCase())
              });
              if(encontro!=''){
                 return  true;                                  
              }else{
                return  false;                 
              }
           }else{
            return  false;                 
          }
        },
         datosFiltradosUsu(){
            return this.listarUsu.filter((filtro)=>{
                    return filtro.p_nombre.toUpperCase().match(this.buscar.toUpperCase()) || filtro.p_apellido.toUpperCase().match(this.buscar.toUpperCase()) || filtro.p_dni.toUpperCase().match(this.buscar.toUpperCase())
            });
        }, 
        datosFiltradosPro(){
          return this.listarPro.filter((filtro)=>{
                  return filtro.nombres.toUpperCase().match(this.buscar.toUpperCase()) || filtro.apellidos.toUpperCase().match(this.buscar.toUpperCase()) || filtro.dni.toUpperCase().match(this.buscar.toUpperCase())
          });
        }, 
        datosFiltradosAsig(){        
            return this.listarAsig.filter((filtro)=>{
                    return filtro.nombre.toUpperCase().match(this.buscarAsig.toUpperCase()) || filtro.titulo.toUpperCase().match(this.buscarAsig.toUpperCase()) || filtro.codigo.toUpperCase().match(this.buscarAsig.toUpperCase()) || filtro.estado.toUpperCase()==this.buscarAsig.toUpperCase() 
            });
        },
        datosFiltradosGrupos(){
          return this.grupos.filter((filtro)=>{
            return filtro.nombre.toUpperCase().match(this.buscarGrupos.toUpperCase()) 
          });
        },
        datosFiltradosAsigG(){
          return this.listarAsig.filter((filtro)=>{
            return filtro.nombre.toUpperCase().match(this.buscarAsig.toUpperCase()) && filtro.estado == 'activo'
          });
        },
        datosFiltradosDesA(){
          return this.gruposAsig.filter((filtro)=>{
            return filtro.nombre_grupo.toUpperCase().match(this.buscarGruposDesA.toUpperCase()) 
          });
        },
        datosFiltradosDesAP(){
          return this.profeAsig.filter((filtro)=>{
            return filtro.nombre_profe.toUpperCase().match(this.buscarProfe.toUpperCase()) || filtro.apellido_profe.toUpperCase().match(this.buscarProfe.toUpperCase())  
          });
        },      
    },
    methods:{
       autorizamenu(){
            axios.get('http://localhost/gha/api/getRol.php')
            .then(res =>{                    
              this.usuario = res.data             
            })
       },
        getUsuarios(){         
                axios.get('http://localhost/gha/api/crud/getUsuarios.php')
                .then(res =>{                    
                    this.listarUsu = res.data
                })
        },
        getProfesores(){         
          axios.get('http://localhost/gha/api/crud/getProfes.php')
          .then(res =>{                    
              this.listarPro = res.data
          })
        },

        getAsignaturas(){
                axios.get('http://localhost/gha/api/crud/getAsignaturas.php')
                .then(res =>{                    
                    this.listarAsig = res.data
                })
        },
        getTitulos(){
            
                axios.get('http://localhost/gha/api/crud/getTitulos.php')
                .then(res =>{                    
                    this.titulos = res.data
                })
        },
        getCatAulas() {
            axios
              .get("http://localhost/gha/api/crud/getCatAulas.php")
              .then((res) => {
                this.categoriasaulas = res.data;
              });
          },
          getGrupos() {
            axios
              .get("http://localhost/gha/api/crud/getGrupos.php")
              .then((res) => {
                this.grupos = res.data;
              });
          },     
          getAulas() {
            axios
              .get("http://localhost/gha/api/crud/getAulas.php")
              .then((res) => {
                this.aulas = res.data;
              });
          },        
          getTramos(){
            axios
              .get("http://localhost/gha/api/crud/getTramos.php")
              .then((res) => {
                this.tramoshorario = res.data;
              });             
          },
          getSesionesCursoGrupo($idgrupo, $curso, $semestre){
            axios
              .get("http://localhost/gha/api/crud/getSesionesCurso.php/?id_grupo="+$idgrupo+"&curso="+$curso+"&semestre="+$semestre)
              .then((res) => {
                this.sesionesCG = res.data;
              });             
          },
          getGruposAsig(){
            axios
            .get("http://localhost/gha/api/crud/getGruposAsig.php")
            .then((res) => {
              this.gruposAsig = res.data;
            });     
          },
          getProfesAsig(){
            axios
            .get("http://localhost/gha/api/crud/getProfeAsig.php")
            .then((res) => {
              this.profeAsig = res.data;
            });     
          },
          // getSesiones(){
          //   axios
          //   .get("http://localhost/gha/api/crud/getSesion.php")
          //   .then((res) => {
          //       this.sequeda = res.data;
          //       console.log('esto trae:'+this.sequeda)
          //   });             
          //  },

          registroAsignatura() {
            if(this.validaCodAsi()){
                swal.fire('Error código ya existe', 'El código debe ser único', 'fail');
            }else{
              this.registrar("formAsignatura", "../api/Registro/asignatura.php", "Asignatura registrada", "Error al registrar", "../principal/asignatura.php","asignatura" );
            }
          },
          validaCodAsi(){
            return this.codigoAsigFiltrado().length>0;              
          },
          codigoAsigFiltrado(){
            return this.listarAsig.filter((filtro)=>{
              return filtro.codigo.toUpperCase().match(this.codigo_asig.toUpperCase()) 
            })
          },
          registroTitulo() {
            this.registrar("formTitulo", "../api/Registro/titulo.php", "Titulo registrado", "Error al registrar", "../principal/asignatura.php","titulo");
          },
          registroCatAula() {
            this.registrar("formCatAula","../api/Registro/categoriaAula.php","Categoria registrada", "Error al registrar", "../principal/aulas.php", "cataula")
          },
          registroAula() {
            this.registrar("formAula", "../api/Registro/aula.php", "Aula registrado", "Error al registrar aula", "../principal/aulas.php", "aula" );
          },
          registroGrupo() {
            this.registrar("formGrupo", "../api/Registro/grupo.php","Grupo registrado", "Error al registrar grupo", "../principal/grupos.php", "grupo" );
          },
          registroTramo() {
            if(this.validaTramos()){
                this.registrar("formTramo", "../api/Registro/tramo.php","Tramo registrado","Error al registrar tramo", "../principal/tramos.php","tramo");
            }
          },
          RegistroProfeAsignaAsi(){
            this.registrar("formProfeAsigna", "../api/Registro/profesasigna.php", "Asignación registrada", "Error al registrar asignación", "../principal/profeasigna.php", "profeasig");
          },
          RegistroGrupoAsignaAsi(){
            this.registrar("formGrupoAsigna", "../api/Registro/gruposasigna.php","Asignación registrada","Error al registrar asignación","../principal/gruposasigna.php", "grupoasig");
          },
          registrar($formulario, $archivo, $mensajeOk, $mensajeFallo, $archivoOk, $tipo){

            const form = document.getElementById($formulario);         
            axios
              .post($archivo, new FormData(form))
              .then((res) => {
                this.respuesta = res.data
  
                  if (this.respuesta.trim() == "success") {
                      swal.fire($mensajeOk, '', 'success')
                      if($tipo=="aula"){
                          this.getAulas();
                      }
                      location.href = $archivoOk
                  } else {
                      swal.fire($mensajeFallo, '', 'fail')    
                  }
              })                
          },
          cargaanos(){
                var d = new Date();
                var n = d.getFullYear();
                this.selectedYear = n;

                for (i = 0; i < 5; i++) {
                    this.years[i] = n + i;
                }            
          },
        eliminarCateAula(id){
            this.eliminar(
            'Al eliminarlo no podras recuperarlo',
            'http://localhost/gha/api/crud/eliminarCateAula.php?id=' + id,
            'Categoria eliminada',
            'Categoria no eliminada',
            '../principal/aulas.php'
            );
        },
        eliminarAula(id){
          this.eliminar(
            'Al eliminarlo no podrá recuperarlo',
            'http://localhost/gha/api/crud/eliminarAula.php?id=' + id ,
            'Categoria eliminada',
            'Categoria no eliminada',
            '../principal/aulas.php'
          );
        },
        eliminarTitulo(id){
            this.eliminar( 
              'Al eliminarlo no podrá recuperarlo',
                'http://localhost/gha/api/crud/eliminarTitulo.php?id=' + id,
                'Tìtulo eliminado',
                'Título no eliminado',
                "../principal/asignatura.php"
                );
          },
          eliminar($texto, $uri, $mensajeOk, $mensajeFallo, $archivoOk){
            swal.fire({
              title:'Seguro de eliminar el registro?',
              text: $texto,
              icon:'warning',
              buttons:true,
              dangerMode:true,
            })
            .then((aceptar)=>{
              if (aceptar) {
                  axios.get($uri)
                  .then(res =>{
                   if (res.data.trim() == 'success') {
                       swal.fire($mensajeOk)
                       location.href = $archivoOk
                   }else{
                      swal.fire($mensajeFallo)
                   }})
            }})          
          },
          eliminarAsignatura(id, codigo){
            this.eliminar(
              'Al eliminarlo no podrá recuperarlo',
             'http://localhost/gha/api/crud/eliminarAsignatura.php?id=' + id +'&codigo='+ codigo,
             'Asignatura eliminada',
             'Asignatura no eliminado',
             '../principal/buscarAsig.php'
             );
          },
          eliminarTramo(id){
            this.eliminar(
              'Al eliminarlo no podrá recuperarlo',
            'http://localhost/gha/api/crud/eliminarTramo.php?id=' + id,
            'Tramo eliminado',
            'Tramo no eliminado',
            '../principal/tramos.php'
            );
          },        
          eliminarAsignaG(id){
            this.eliminar(
              'Al eliminarlo no podrá recuperarlo',
              'http://localhost/gha/api/crud/eliminargrupoasigna.php?id=' + id,
              'Asignación eliminada',
              'Asignación no eliminada',
              '../principal/gruposasigna.php'
            );
          },
          eliminarAsignaP(id){
            this.eliminar(
              'Al eliminarlo no podrá recuperarlo',
              'http://localhost/gha/api/crud/eliminarProfeAsig.php?id=' + id ,
              'Asignación eliminada',
              'Asignación no eliminada',
              '../principal/profeasigna.php'
            );              
          },
          // Eliminar usuarios
          eliminarProfe($idProfe){
            this.eliminar(
             'Al eliminarlo no podrá recuperarlo',
            'http://localhost/gha/api/crud/eliminarUsuario.php?id=' + $idProfe,
            'El profesor ha sido eliminado.',
            'No se pudo eliminar',
            '../principal/buscar.php'
            );
          },
          
          eliminarGrupo($idGrupo){
            this.eliminar(
            'tambien se borraran todas sus sesiones registradas',
            'http://localhost/gha/api/crud/eliminarGrupo.php?id=' + $idGrupo,
            'El grupo ha sido eliminado.',
            'No se pudo eliminar',
            '../principal/grupos.php'
            );
          },
          validaTramos(){
            if(this.inicio<this.fin){
              return true;
            }else{
              swal.fire('Horas no válidas', 'Hora fin debe ser mayor a hora inicio', 'fail')
            }
        } 
    }
})

$("#menu-toggle").click(function(e) {
  e.preventDefault();
  $("#wrapper").toggleClass("toggled");
});

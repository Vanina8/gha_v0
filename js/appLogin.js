const app = new Vue({
  el: "#app",
  data: {
    usuario:5,
    pass: "",
    passC: "",
    estadoEti: false,
    etiquetaEstadoA: "Activo",
    etiquetaEstadoB: "Inactivo",
    correo:'',
    dni:'',
    selectedRol:'',

    respuesta: "",
    // boton: "btn blue",
    // menu: false,
    // inicio: false,
    roles:[],
    listarUsu:[]
  },
  created(){
    this.autorizamenu()
    this.getRoles()
    this.getUsuarios()
  },
  
  methods:{

    autorizamenu(){
      console.log('estoy en autorizacion usuairo');
          axios.get('http://localhost/gha/api/getRol.php')
          .then(res =>{                    
            this.usuario = res.data             

            console.log('rol de usuario es:'+this.usuario);
          })
     },

    getUsuarios(){
      axios.get('http://localhost/gha/api/crud/getUsuarios.php')
      .then(res =>{                    
          this.listarUsu = res.data
      })
    },
    getRoles(){
      axios.get('http://localhost/gha/api/crud/getRoles.php')
      .then(res =>{                    
          this.roles = res.data
          // swal.fire('listado ok', '', 'success')
      })
    },
    dniProfeFiltrado(){
      return this.listarUsu.filter((filtro)=>{
        return filtro.p_dni.match(this.dni) 
      })
    },
    correoProfeFiltrado(){
      return this.listarUsu.filter((filtro)=>{
        return filtro.p_email.match(this.correo) 
      })
    },

// Registro nuevo usuario ***********************////
    registro() {

      pass=this.validaPass();
      dni=this.validaDNI();
      email=this.validaCorreo();

      if( pass && dni && email){

            const form = document.getElementById("formRegistro")
            axios
              .post("../api/Registro/registro.php", new FormData(form))
              .then((res) => {
                this.respuesta = res.data
                this.direccionamiento()
              })
      }
      if(!pass) {
        swal.fire("los passwords no son iguales", "", "fail");
      }
      if(!dni){
        swal.fire("DNI "+this.dni+" ya existe", " Debe ser dato único", "fail");
      }
      if(!email){
        swal.fire("E-mail "+this.correo+" ya existe", " Debe ser dato único", "fail");
      }
    },
    // Validaciones del registro de usuario //
    validaPass(){
      return this.pass== this.passC;
    },
    validaDNI(){
      return !(this.dniProfeFiltrado().length>0);
    },
    validaCorreo(){
      return !(this.correoProfeFiltrado().length>0);
    },
    // Fin Vaidaciones del registro de usuario //
    direccionamiento() {
      if (this.respuesta.trim() == "success") {
        swal.fire("Registrado", "", "success")
        location.href = "registro.php"
      } else {
        swal.fire("No se pudo registrar", "llame a soporte técnico", "fail")
      }
    },
// Fin Registro nuevo usuario ***********************////
    login(){
        const form = document.getElementById('inicioSesion')
        axios.post('../api/login/login.php', new FormData(form))
             .then( res =>{
             this.respuesta = res.data
                if (res.data == 'success') {        
                  location.href = '../principal'
                } else {
                  swal.fire('Usuario y/o contraseña incorrectos')
                }                
            })
    }
    // registroRol(){
    //     const form = document.getElementById("formRol");
         
    //     axios
    //       .post("../api/Registro/rol.php", new FormData(form))
    //       .then((res) => {
    //         this.respuesta = res.data

    //           if (this.respuesta.trim() == "success") {

    //               swal.fire('Rol registrado', '', 'success')
    //               location.href = '../principal/registro.php'
    //           } else {

    //               swal.fire('Error al registrar rol', '', 'fail')    
    //           }
    //       })     
    // }
  }
})
$("#menu-toggle").click(function(e) {
  e.preventDefault();
  $("#wrapper").toggleClass("toggled");
});
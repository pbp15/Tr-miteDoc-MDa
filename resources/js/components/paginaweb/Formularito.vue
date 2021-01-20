<template>

	<form  class="appointment-form " >
  							<div class="d-md-flex">
                                        <div class="form-group ml-md-4">
									<input type="text" v-model="apellidos" class="form-control" placeholder="Apellidos">
								</div>
								<div class="form-group">
									<input type="text" v-model="nombres" class="form-control" placeholder="Nombres">
								</div>
								
							</div>
							<div class="d-md-flex">
							
								<div class="form-group ml-md-4">
									<input type="number" v-model="telefono" class="form-control" placeholder="Celular">
								</div>

                                        <div class="form-group">
									<input type="email" v-model="email" class="form-control" placeholder=" Email">
								</div>
							</div>
							<div class="d-md-flex">
								<div class="form-group ml-md-4">
									<textarea  v-model="asunto" cols="30" rows="2" class="form-control" placeholder="Asunto"></textarea>
								</div>
							</div>                

                            <div class="d-md-flex">
								
								<div class="form-group ml-md-4">
									<input type="submit" value="Enviar" @click="registrarContacto()" class="btn btn-primary py-3 px-4">
								</div>
							</div>
                          <div class="d-md-flex">
                                <div v-show="errorContacto" class="form-group row div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in errorMostrarMsjContacto" :key="error" v-text="error">

                                        </div>
                                    </div>
                            </div>
                    </div>

			</form>

</template>



<script>
    export default {
           data (){
            return {           
                apellidos : '',
                nombres : '',
                email : '',
                telefono : '',
                asunto : '',
                arrayContacto : [],
                errorContacto : 0,
                errorMostrarMsjContacto : [],
            }
        },


  
        methods: {
       
            registrarContacto(){
                      
                let me = this;

                axios.post('/contacto/registrar',{
                    'apellidos': this.apellidos,
                    'nombres': this.nombres,
                    'email': this.email,
                    'telefono': this.telefono,
                    'asunto': this.asunto
                }).then(function (response) {
                        swal(
                        'Registrado!',
                        'Gracias por Contactarnos, pronto le escribiremos',
                        'success'
                        )
                    me.cerrarModal();
                }).catch(function (error) {
                     swal(
                        'Registro incorrecto!',
                        'Todos los Campos son Obligatorios',
                        'error'
                        )
                    console.log(error);
                });
            },
                    cerrarModal(){
                this.apellidos = '';
                this.nombres = '';
                this.email = 0;
                this.telefono = 0;
                this.asunto = '';
		        this.errorContacto=0;
            },


        },
        
          mounted() {
          this.registrarContacto();
        },
    }
</script>


<style>
   .div-error{
        display: flex;
        justify-content: center;
    }
    .text-error{
        color: red !important;
        font-weight: bold;
    }

    </style>
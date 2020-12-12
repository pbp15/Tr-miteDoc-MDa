<template>
<main class="main">
    <!-- Breadcrumb -->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item"><a href="#">Admin</a></li>
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>
    <div class="container-fluid">
        <!-- Ejemplo de tabla Listado -->
        <div class="card">
            <div class="card-header">
                <i class="fa fa-align-justify"></i> Personas
                <button type="button" @click="abrirModal('persona', 'registrar')" class="btn btn-secondary">
                    <i class="icon-plus"></i>&nbsp;Nuevo
                </button>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-md-6">
                        <div class="input-group">
                            <select class="form-control col-md-3" id="opcion" name="opcion">
                                <option value="nombre">Nombre</option>
                                <option value="descripcion">Descripción</option>
                            </select>
                            <input type="text" id="texto" name="texto" class="form-control" placeholder="Texto a buscar">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                        </div>
                    </div>
                </div>
                <table class="table table-bordered table-striped table-sm">
                    <thead>
                        <tr>
                            <th>Opciones</th>
                            <th>Nombre</th>
                            <th>Tipo de documento</th>
                            <th>Número de documento</th>
                            <th>Dirección</th>
                            <th>Telefono</th>
                            <th>Email</th> 
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for= "persona in arrayPersona" :key="persona.id" >
                            <td>
                                <button type="button" @click="abrirModal('persona', 'actualizar', persona)" class="btn btn-warning btn-sm">
                                    <i class="icon-pencil"></i>
                                </button> &nbsp;
                                <button type="button" class="btn btn-danger btn-sm" >
                                    <i class="icon-trash"></i>
                                </button>
                            </td>
                            <td v-text="persona.nombre"></td>
                            <td v-text="persona.tipo_documento"></td>
                            <td v-text="persona.num_documento"></td>
                            <td v-text="persona.direccion"></td>
                            <td v-text="persona.telefono"></td>
                            <td v-text="persona.email"></td>
                            
                        </tr>
                        
                    </tbody>
                </table>
                <nav>
                    <ul class="pagination">
                        <li class="page-item">
                            <a class="page-link" href="#">Ant</a>
                        </li>
                        <li class="page-item active">
                            <a class="page-link" href="#">1</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">2</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">3</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">4</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">Sig</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <!-- Fin ejemplo de tabla Listado -->
    </div>
    <!--Inicio del modal agregar/actualizar-->
    <div class="modal fade"  tabindex="-1" :class="{'mostrar':modal}"        role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-primary modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" v-text="tituloModal"></h4>
                    <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="text-input">Nombre</label>
                            <div class="col-md-9">
                                <input type="text" v-model="nombre" class="form-control" placeholder="Nombre">
                           
                            </div>
                        </div>

                         <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="text-input">Tipo de documento</label>
                            <div class="col-md-9">
                                <input type="text" v-model="tipo_documento" class="form-control" placeholder="Tipo de documento">
                           
                            </div>
                        </div>
                        
                         <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="text-input">Nº de documento</label>
                            <div class="col-md-9">
                                <input type="text" v-model="num_documento" class="form-control" placeholder="Nº de documento">
                           
                            </div>
                        </div>
                              <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="text-input">Direccion</label>
                            <div class="col-md-9">
                                <input type="text" v-model="direccion" class="form-control" placeholder="Direccion">
                             
                            </div>
                        </div>
                          
                         <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="text-input">Telefono</label>
                            <div class="col-md-9">
                                <input type="text" v-model="telefono" class="form-control" placeholder="Telefono">
                             
                            </div>
                        </div>
                    
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="email-input">Gmail</label>
                            <div class="col-md-9">
                                <input type="email" v-model="email" class="form-control" placeholder="Enter Email">
                            </div>
                        </div>

                        <div v-show="errorPersona" class="form-group row div-error">
                            <div class="text-center text-error">
                                <div v-for="error in errorMostrarMsjPersona" :key="error" v-text="error">
                                
                                 </div>
                            </div>
                          
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                    <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarPersona()" >Guardar</button>
                    <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarPersona()">Actualizar</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!--Fin del modal-->
    <!-- Inicio del modal Eliminar -->
    <div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-danger" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Eliminar Categoría</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Estas seguro de eliminar la categoría?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-danger">Eliminar</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- Fin del modal Eliminar -->

</main>
</template>

<script>
export default {

    data(){
        return{
            persona_id: 0,
            nombre: '',
            tipo_documento:'',
            num_documento:'',
            direccion: '',
            telefono: '',
            email: '',
            arrayPersona: [],
            modal : 0,
            tituloModal : '',
            tipoAccion : 0 ,
            errorPersona: 0,
            errorMostrarMsjPersona: [],
            pagination : {
               'total'  : 0 ,
               'current_page' : 0 ,
               'per_page' : 0 ,
               'last_page' : 0 ,
               'from' : 0 ,
               'to' : 0 ,
            },
            offset : 3
        }
    },
    methods: {
        listarPersona(){
            let me = this;
            axios.get('/persona').then(function (response) {
                // handle success
                me.arrayPersona =  response.data;
            })
            .catch(function (error) {
                // handle error
                console.log(error);
            });
         },

         cambiarPagina(page){
             let me =  this;
             //Actualiza la pagina actual
             me.pagination.current_page =  page ; 


         },

         registrarPersona(){
             if(this.validarPersona()){
                 return;
             }

             let me =  this;
             axios.post('/persona/registrar',{
                'nombre' : this.nombre,
                'tipo_documento' : this.tipo_documento,
                'num_documento': this.num_documento,
                'direccion' : this.direccion,
                'telefono': this.telefono,
                'email' :  this.email
                 
             }).then(function(response){
                 me.cerrarModal();
                 me.listarPersona();
             }).catch(function(error){
                 console.log(error);
             });
         },

            actualizarPersona(){
             if(this.validarPersona()){
                 return;
             }

             let me =  this;
             axios.put('/persona/actualizar',{
                'nombre' : this.nombre,
                'tipo_documento' : this.tipo_documento,
                'num_documento': this.num_documento,
                'direccion' : this.direccion,
                'telefono': this.telefono,
                'email' :  this.email,
                'id': this.persona_id
                 
             }).then(function(response){
                 me.cerrarModal();
                 me.listarPersona();
             }).catch(function(error){
                 console.log(error);
             });
         },

         validarPersona(){
            
             this.errorPersona=0;
             this.errorMostrarMsjPersona=[];

             if(!this.nombre) this.errorMostrarMsjPersona.push("El nombre no puede estar vacio");
             if(!this.tipo_documento) this.errorMostrarMsjPersona.push("El tipo de documento no puede estar vacio");
             if(!this.num_documento) this.errorMostrarMsjPersona.push("El numero de documento no puede estar vacio");
             if(!this.direccion)  this.errorMostrarMsjPersona.push("La direccion no puede estar vacia");
             if(!this.telefono)  this.errorMostrarMsjPersona.push("El telefeno no puede estar vacio");
             if(!this.email) this.errorMostrarMsjPersona.push("Tu correo no puede estar vacio");

            if(this.errorMostrarMsjPersona.length) this.errorPersona = 1;
            return this.errorPersona;
         },
         cerrarModal(){
             this.modal = 0;
             this.tituloModal = '';
             this.nombre ='';
             this.tipo_documento = '';
             this.num_documento = '';
             this.direccion = '';
             this.telefono = '';
             this.email = '';


         },
         abrirModal(modelo, accion , data=[]){
             switch(modelo){
                 case "persona" :
                 {
                     switch(accion){
                         case 'registrar':
                         {
                             this.modal = 1;
                             this.tituloModal = 'Registrar Persona';
                             this.nombre ='';
                             this.tipo_documento = 'DNI';
                             this.num_documento = '';
                             this.direccion = '';
                             this.telefono = '';
                             this.email = '';
                             this.tipoAccion = 1;
                             break;

                         }
                         case 'actualizar':
                         {
                           //  console.log(data);
                           this.modal = 1;
                           this.tituloModal = 'Actualizar Persona';
                           this.tipoAccion = 2;
                           this.persona_id = data['id'];    
                           this.nombre = data['nombre'];
                           this.tipo_documento =  data['tipo_documento'];
                           this.num_documento =  data['num_documento'];
                           this.direccion =  data['direccion'];
                           this.telefono = data['telefono'];
                           this.email = data['email'];
                           break;
                         }
                     }
                 }
             }
         }
    },
    mounted() {
        //invoca el metodo listarpersona
        this.listarPersona();
    }
}
</script>

<style>
    .modal-content {
        width: 100%  !important;
        position: absolute  !important;
    }
    .mostrar{
        display: list-item  !important;
        opacity: 1  !important;
        position: absolute !important;
        background-color: #3c29297a  !important;
    }

    .div-error{
        display: flex;
        justify-content: center;        
    }

    .text-error{
        color: red  !important;
        font-weight: bold;
    }
</style>



<template>
            <main class="main">
            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Escritorio</a></li>
            </ol>
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                <strong><h2 class="text-center">Lista de Contactanos</h2></strong> 
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i>  
                        <button type="button" @click="abrirModal('contacto','registrar')" class="btn btn-secondary">
                            <i class="icon-plus"></i>&nbsp;Nuevo
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" v-model="criterio">
                                      <option value="nombres">Nombres</option>   
                                      <option value="apellidos">Apellidos</option>
                                                                       
                                    </select>
                                    <input type="text" v-model="buscar" @keyup.enter="listarContacto(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" @click="listarContacto(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Opciones</th>    
                                    <th>Apellidos</th>
                                    <th>Nombres</th>
                                    <th>Email</th>
                                    <th>Telefono</th>
                                    <th>Asunto</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="contacto in arrayContacto" :key="contacto.id">
                                    <td>
                                        <button type="button" @click="abrirModal('contacto','actualizar',contacto)" class="btn btn-warning btn-sm">
                                          <i class="icon-pencil"></i>
                                        </button> 
                                    </td>                                   
                                    <td v-text="contacto.apellidos"></td>
                                    <td v-text="contacto.nombres"></td>
                                    <td v-text="contacto.email"></td>
                                    <td v-text="contacto.telefono"></td>
                                    <td v-text="contacto.asunto"></td>
                                </tr>                                
                            </tbody>
                        </table>
                        <nav>
                            <ul class="pagination">
                                <li class="page-item" v-if="pagination.current_page > 1">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1,buscar,criterio)">Ant</a>
                                </li>
                                <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(page,buscar,criterio)" v-text="page"></a>
                                </li>
                                <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page + 1,buscar,criterio)">Sig</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <!-- Fin ejemplo de tabla Listado -->
            </div>
            <!--Inicio del modal agregar/actualizar-->
            <div class="modal fade" tabindex="-1" :class="{'mostrar' : modal}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
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
                                    <label class="col-md-3 form-control-label" for="text-input">Apellidos</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="apellidos" class="form-control" placeholder="Apellidos">                                        
                                    </div>
                                </div>

                                  <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Nombres</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="nombres" class="form-control" placeholder="Nombres">                                        
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Correo Electrónico</label>
                                    <div class="col-md-9">
                                        <input type="email" v-model="email" class="form-control" placeholder="Correo">                                        
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Nº Celular</label>
                                    <div class="col-md-9">
                                        <input type="number" v-model="telefono" class="form-control" placeholder="celular">                                        
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="email-input">Asunto</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="asunto" class="form-control" placeholder="Ingrese asunto">
                                    </div>
                                </div>
                                <div v-show="errorContacto" class="form-group row div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in errorMostrarMsjContacto" :key="error" v-text="error">

                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                            <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarContacto()">Guardar</button>
                            <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarContacto()">Actualizar</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!--Fin del modal-->
        </main>
</template>

<script>
   
    export default {
        data (){
            return {
                contacto_id: 0,
                apellidos : '',
                nombres : '',
                email : '',
                telefono : '',
                asunto : '',
                arrayContacto : [],
                modal : 0,
                tituloModal : '',
                tipoAccion : 0,
                errorContacto : 0,
                errorMostrarMsjContacto : [],
                pagination : {
                    'total' : 0,
                    'current_page' : 0,
                    'per_page' : 0,
                    'last_page' : 0,
                    'from' : 0,
                    'to' : 0,
                },
                offset : 3,
                criterio : 'nombres',
                buscar : '',
            }
        },
 
        computed:{
            isActived: function(){
                return this.pagination.current_page;
            },
            //Calcula los elementos de la paginación
            pagesNumber: function() {
                if(!this.pagination.to) {
                    return [];
                }
                
                var from = this.pagination.current_page - this.offset; 
                if(from < 1) {
                    from = 1;
                }

                var to = from + (this.offset * 2); 
                if(to >= this.pagination.last_page){
                    to = this.pagination.last_page;
                }  

                var pagesArray = [];
                while(from <= to) {
                    pagesArray.push(from);
                    from++;
                }
                return pagesArray;             

            }
        },
        methods : {
            listarContacto(page,buscar,criterio){
                let me=this;
                var url= '/contacto?page=' + page + '&buscar='+ buscar + '&criterio='+ criterio;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.arrayContacto = respuesta.contactos.data;
                    me.pagination= respuesta.pagination;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            cambiarPagina(page,buscar,criterio){
                let me = this;
                //Actualiza la página actual
                me.pagination.current_page = page;
                //Envia la petición para visualizar la data de esa página
                me.listarContacto(page,buscar,criterio);
            },
            registrarContacto(){
                if (this.validarContacto()){
                    return;
                }
                
                let me = this;

                axios.post('/contacto/registrar',{
                    'apellidos': this.apellidos,
                    'nombres': this.nombres,
                    'email': this.email,
                    'telefono': this.telefono,
                    'asunto': this.asunto
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarContacto(1,'','nombres');
                }).catch(function (error) {
                    console.log(error);
                });
            },
            actualizarContacto(){
               if (this.validarContacto()){
                    return;
                }
                
                let me = this;

                axios.put('/contacto/actualizar',{
                    'apellidos': this.apellidos,
                    'nombres': this.nombres,
                    'email': this.email,
                    'telefono': this.telefono,
                    'asunto': this.asunto,
                    'id': this.contacto_id
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarContacto(1,'','nombre');
                }).catch(function (error) {
                    console.log(error);
                }); 
            },
      
            validarContacto(){
                this.errorContacto=0;
                this.errorMostrarMsjContacto =[];

                if (!this.apellidos) this.errorMostrarMsjContacto.push("Los apellidos del contacto no pueden estar vacío.");
                if (!this.nombres) this.errorMostrarMsjContacto.push("Los nombres del contacto no pueden estar vacío.");
                if (!this.email) this.errorMostrarMsjContacto.push("El email no puede estar vacío.");
                if (!this.asunto) this.errorMostrarMsjContacto.push("El asunto no puede estar vacío.");

                if (this.errorMostrarMsjContacto.length) this.errorContacto = 1;

                return this.errorContacto;
            },
            cerrarModal(){
                this.modal=0;
                this.tituloModal='';
                this.apellidos = '';
                this.nombres = '';
                this.email = 0;
                this.telefono = 0;
                this.asunto = '';
		        this.errorContacto=0;
            },
            abrirModal(modelo, accion, data = []){
                switch(modelo){
                    case "contacto":
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                this.modal = 1;
                                this.tituloModal = 'Registrar Contacto';
                                this.apellidos= '';
                                this.nombres='';                        
                                this.email='';
                                this.telefono='';
                                this.asunto = '';
                                this.tipoAccion = 1;
                                break;
                            }
                            case 'actualizar':
                            {
                                //console.log(data);
                                this.modal=1;
                                this.tituloModal='Actualizar Contacto';
                                this.tipoAccion=2;
                                this.contacto_id=data['id'];
                                this.apellidos=data['apellidos'];
                                this.nombres = data['nombres'];
                                this.email=data['email'];
                                this.telefono=data['telefono'];
                                this.asunto= data['asunto'];
                                break;
                            }
                        }
                    }
                }
            }
        },
        mounted() {
            this.listarContacto(1,this.buscar,this.criterio);
        }
    }
</script>
<style>    
    .modal-content{
        width: 100% !important;
        position: absolute !important;
    }
    .mostrar{
        display: list-item !important;
        opacity: 1 !important;
        position: absolute !important;
        background-color: #3c29297a !important;
    }
    .div-error{
        display: flex;
        justify-content: center;
    }
    .text-error{
        color: red !important;
        font-weight: bold;
    }
</style>

<template>
            <main class="main">
            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Escritorio</a></li>
            </ol>
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
             
                <div class="card">
                    <strong><h2 class="text-center">Comunicados</h2></strong> 
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> 
                        <button type="button" @click="abrirModal('comunicado','registrar')" class="btn btn-secondary">
                            <i class="icon-plus"></i>&nbsp;Nuevo
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" v-model="criterio">
                                      <option value="titulo">Titulo</option>
                                      <option value="descripcion">Descripcion</option>
                                    </select>
                                    <input type="text" v-model="buscar" @keyup.enter="listarComunicado(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" @click="listarComunicado(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Opciones</th>
                                    <th>Titulo</th>
                                    <th>Descripcion</th>                                    
                                    <th>Fecha</th>
                                    <th>Atentamente</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="comunicado in arrayComunicado" :key="comunicado.id">
                                    <td>
                                        <button type="button" @click="abrirModal('comunicado','actualizar',comunicado)" class="btn btn-warning btn-sm">
                                          <i class="icon-pencil"></i>
                                        </button>
                                        <button type="button" class="btn btn-danger btn-sm" @click="eliminarComunicado(comunicado.id)">
                                        <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                    <td v-text="comunicado.titulo"></td>
                                    <td v-text="comunicado.descripcion"></td>
                                    <td v-text="comunicado.fecha"></td>
                                    <td v-text="comunicado.atentamente"></td>
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
                                    <label class="col-md-3 form-control-label" for="text-input">Titulo</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="titulo" class="form-control" placeholder="Nombre del titulo">                                        
                                    </div>
                                </div>
                          
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Descripcion</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="descripcion" class="form-control" placeholder="Descripcion">                                        
                                    </div>
                                </div>                             
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Fecha</label>
                                    <div class="col-md-9">
                                        <input type="date" v-model="fecha" class="form-control" >                                        
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Atentamente</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="atentamente" class="form-control" >                                        
                                    </div>
                                </div>
                              

                                <div v-show="errorComunicado" class="form-group row div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in errorMostrarMsjComunicado" :key="error" v-text="error">

                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                            <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarComunicado()">Guardar</button>
                            <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarComunicado()">Actualizar</button>
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
                comunicado_id: 0,
                titulo : '',
                descripcion : '',
                fecha: '',                
                atentamente : '',
                arrayComunicado : [],
                modal : 0,
                tituloModal : '',
                tipoAccion : 0,
                errorComunicado : 0,
                errorMostrarMsjComunicado : [],
                pagination : {
                    'total' : 0,
                    'current_page' : 0,
                    'per_page' : 0,
                    'last_page' : 0,
                    'from' : 0,
                    'to' : 0,
                },
                offset : 3,
                criterio : 'titulo',
                buscar : ''
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
            listarComunicado (page,buscar,criterio){
                let me=this;
                var url= '/comunicado?page=' + page + '&buscar='+ buscar + '&criterio='+ criterio;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.arrayComunicado = respuesta.comunicados.data;
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
                me.listarComunicado(page,buscar,criterio);
            },
    
            registrarComunicado(){
                if (this.validarComunicado()){
                    return;
                }
                
                let me = this;

                axios.post('/comunicado/registrar',{
                    'titulo': this.titulo,
                    'descripcion': this.descripcion,
                    'atentamente' : this.atentamente,
                    'fecha' :  this.fecha,
                }).then(function (response) {
                    swal(
                        'Registrado!',
                        'El Comunicado ha sido registrado con éxito.',
                        'success'
                        )
                    me.cerrarModal();
                    me.listarComunicado(1,'','titulo');
                }).catch(function (error) {
                    console.log(error);
                });
            },
            actualizarComunicado(){
               if (this.validarComunicado()){
                    return;
                }
                
                let me = this;

                axios.put('/comunicado/actualizar',{
                    'titulo': this.titulo,
                    'descripcion': this.descripcion,
                    'atentamente' : this.atentamente,
                    'fecha' :  this.fecha,
                    'id': this.comunicado_id
                }).then(function (response) {
                   swal(
                        'Actualizado!',
                        'El comunicado ha sido actualizado con éxito.',
                        'success'
                        )
                    me.cerrarModal();
                    me.listarComunicado(1,'','titulo');
                }).catch(function (error) {
                    console.log(error);
                }); 
            },            
            validarComunicado(){
                this.errorComunicado=0;
                this.errorMostrarMsjComunicado =[];

                if (!this.titulo) this.errorMostrarMsjComunicado.push("El titulo del Comunicado no puede estar vacío.");

                if (this.errorMostrarMsjComunicado.length) this.errorComunicado = 1;

                return this.errorComunicado;
            },
              eliminarComunicado(id){
            
             swal({
                title: 'Esta seguro de eliminar este Comunicado?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar!',
                cancelButtonText: 'Cancelar',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
                }).then((result) => {
                if (result.value) {
                    let me = this;

                    axios.put('/comunicado/eliminar',{
                        'id': id
                    }).then(function (response) {
                        me.listarComunicado(1,'','titulo');
                        swal(
                        'Eliminado!',
                        'El Comunicado ha sido eliminado con éxito.',
                        'success'
                        )
                    }).catch(function (error) {
                        console.log(error);
                    });
                    
                    
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    
                }
                }) 
            },
     
            cerrarModal(){
                this.modal=0;
                this.tituloModal='';
                this.titulo='';
                this.descripcion='';
                this.atentamente='';
                this.fecha='';
                this.errorComunicado=0;

            },
            abrirModal(modelo, accion, data = []){
                switch(modelo){
                    case "comunicado":
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                this.modal = 1;
                                this.tituloModal = 'Registrar Comunicado';
                                this.titulo= '';
                                this.descripcion='';
                                this.atentamente='';
                                this.fecha='';
                                this.tipoAccion = 1;
                                break;
                            }
                            case 'actualizar':
                            {
                                //console.log(data);
                                this.modal=1;
                                this.tituloModal='Actualizar Comunicado';
                                this.tipoAccion=2;
                                this.comunicado_id=data['id'];
                                this.titulo = data['titulo'];
                                this.descripcion = data['descripcion'];
                                this.atentamente = data['atentamente'];
                                this.fecha=data['fecha'];
                                break;
                            }
                        }
                    }
                }
            }
        },
        mounted() {
            this.listarComunicado(1,this.buscar,this.criterio);
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
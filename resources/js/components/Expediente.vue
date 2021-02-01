<template>
<main class="main">
    <!-- Breadcrumb -->
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Escritorio</a></li>
    </ol>
    <div class="container-fluid">
        <!-- Ejemplo de tabla Listado -->
        <div class="card">
            <div class="card-header">
                <i class="fa fa-align-justify"></i> Registro de expedientes
                <button type="button" @click="abrirModal('expediente','registrar')" class="btn btn-secondary">
                    <i class="icon-plus"></i>&nbsp;Nuevo
                </button>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-md-6">
                        <div class="input-group">
                            <select class="form-control col-md-3" id="opcion" name="opcion">
                                <option value="codigo">Cód. expediente</option>
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
                            <th>Código</th>
                            <th>Cabecera</th>
                            <th>Tipo de documento</th>
                            <th>Asunto</th>
                            <th>Prioridad</th>
                            <th>N° folio</th>
                            <th>Documento</th>
                            <th>Fecha</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="expediente in arrayExpediente" :key="expediente.id">
                            <td>
                                <button type="button" @click="abrirModal('expediente','actualizar', expediente)" class="btn btn-warning btn-sm">
                                    <i class="icon-pencil"></i>
                                </button> &nbsp;
                                <template v-if="expediente.condicion">
                                    <button type="button" class="btn btn-danger btn-sm" @click="desactivarExpediente(expediente.id)">
                                        <i class="icon-trash"></i>
                                    </button>
                                </template>
                                <template v-else>
                                    <button type="button" class="btn btn-info btn-sm" @click="activarExpediente(expediente.id)">
                                        <i class="icon-check"></i>
                                    </button>
                                </template>
                            </td>
                            <td v-text="expediente.codigo_expediente"></td>
                            <td v-text="expediente.cabecera_documento"></td>
                            <td v-text="expediente.tipo_documento"></td>
                            <td v-text="expediente.asunto"></td>
                            <td v-text="expediente.prioridad"></td>
                            <td v-text="expediente.nro_folios"></td>
                            <td v-text="expediente.file"></td>
                            <td v-text="expediente.fecha_tramite"></td>
                            <td>
                                <div v-if="expediente.condicion">
                                    <span class="badge badge-success">Activo</span>
                                </div>
                                <div v-else>
                                    <span class="badge badge-danger">Desactivado</span>
                                </div>
                            </td>
                        </tr>
                        
                    </tbody>
                </table>
                <nav>
                    <ul class="pagination">
                        <li class="page-item" v-if="pagination.current_page > 1">
                            <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1)">Ant</a>
                        </li>
                        <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']">
                            <a class="page-link" href="#" @click.prevent="cambiarPagina(page)" v-text="page"></a>
                        </li>
                        <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                            <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page + 1)">Sig</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <!-- Fin ejemplo de tabla Listado -->
    </div>
    <!--Inicio del modal agregar/actualizar-->
    <div class="modal fade" tabindex="-1" :class="{'mostrar' :modal}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
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
                            <label class="col-md-3 form-control-label" for="text-input">Código</label>
                            <div class="col-md-9">
                                <input type="text" v-model="codigo_expediente" class="form-control">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="text-input">Cabecera</label>
                            <div class="col-md-9">
                                <input type="text" v-model="cabecera_documento" class="form-control">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="text-input">Tipo de documento</label>
                            <div class="col-md-9">
                                <select class="custom-select w-100" v-model="tipo_documento">
                                    <option disabled value="">Seleccione una opción</option>
                                    <option>Solicitud</option>
                                    <option>Carta</option>
                                    <option>Informe</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="text-input">Asunto</label>
                            <div class="col-md-9">
                                <input type="text" v-model="asunto" class="form-control">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="text-input">Prioridad</label>
                            <div class="col-md-9">
                                <input type="text" v-model="prioridad" class="form-control">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="text-input">N° de folios</label>
                            <div class="col-md-9">
                                <input type="text" v-model="nro_folios" class="form-control">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="text-input">Documento</label>
                            <div class="col-md-9">
                                <input type="file" class="form-control-file" @change="registrarExpediente" name="file">
                            </div>
                        </div>  

                        <!-- <vue-dropzone ref="myVueDropzone" id="dropzone" :options="dropzoneOptions"></vue-dropzone> -->

                        <div v-show="errorExpediente" class="form-group row div-error">
                            <div class="text-center text-error">
                                <div v-for="error in errorMostrarExpediente" :key="error" v-text="error"></div>
                            </div>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                    <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarExpediente()">Guardar</button>
                    <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarExpediente()">Actualizar</button>
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
        data(){
            return {
                expediente_id: 0,
                codigo_expediente: '',
                cabecera_documento: '',
                tipo_documento: '',
                asunto: '',
                prioridad: '',
                nro_folios: '',
                file: '',
                fecha_tramite: '',
                arrayExpediente : [],
                modal: 0,
                tituloModal: '',
                tipoAccion: 0,
                errorExpediente: 0,
                errorMostrarExpediente: [],
                pagination: {
                    'total': 0,
                    'current_page': 0,
                    'per_page': 0,
                    'last_page': 0,
                    'from': 0,
                    'to': 0,
                },
                offset: 3,

            }
        },
        computed: {
            isActived: function () {
                return this.pagination.current_page;
            },
            pagesNumber: function () {
                if (!this.pagination.to) {
                    return [];
                }

                var from = this.pagination.current_page - this.offset;
                if (from < 1) {
                    from = 1;
                }

                var to = from + (this.offset * 2);
                if (to >= this.pagination.last_page) {
                    to = this.pagination.last_page;
                }

                var pagesArray = [];
                while (from <= to) {
                    pagesArray.push(from);
                    from++;
                }

                return pagesArray;
            }
        },
        methods : {
            listarExpediente(page){
                let me = this;
                var url= '/expediente?page='+page;
                axios.get(url).then(function (response){
                    var respuesta = response.data;
                    me.arrayExpediente = respuesta.expedientes.data;
                    me.pagination = respuesta.pagination;
                })
                .catch(function (error){
                    console.log(error);
                });
            },
            //empezamos a hacer experiemnto 
            cambiarPagina(page){
                let me = this;
                //Actualiza la pagina actual
                me.pagination.current_page = page;

                //Envia la peticion para visualizar la data de sa pagina
                me.listarExpediente(page);
            },
            registrarExpediente(){
                if (this.validarExpediente()){
                    return;
                }
                let me = this;
                axios.post('/expediente/registrar',{
                    'codigo_expediente': this.codigo_expediente,
                    'cabecera_documento': this.cabecera_documento,
                    'tipo_documento': this.tipo_documento,
                    'asunto': this.asunto,
                    'prioridad': this.prioridad,
                    'nro_folios': this.nro_folios,
                    'file' :  this.file,
                    'condicion': this.condicion
                }).then(function (response){
                    me.cerrarModal();
                    me.listarExpediente();
                }).catch(function (error){
                    console.log(error);
                });
            },
            actualizarExpediente(){
                if (this.validarExpediente()){
                    return;
                }
                let me = this;
                axios.put('/expediente/actualizar',{
                    'codigo_expediente': this.codigo_expediente,
                    'cabecera_documento': this.cabecera_documento,
                    'tipo_documento': this.tipo_documento,
                    'asunto': this.asunto,
                    'prioridad': this.prioridad,
                    'nro_folios': this.nro_folios,
                    'file': this.file,
                    'fecha_tramite': this.fecha_tramite,
                    'id': this.expediente_id
                }).then(function (response){
                    me.cerrarModal();
                    me.listarExpediente();
                }).catch(function (error){
                    console.log(error);
                });
            },
            desactivarExpediente(id){
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-success',
                        cancelButton: 'btn btn-danger'
                    },
                    buttonsStyling: false
                })

                swalWithBootstrapButtons.fire({
                    title: '¿Esta seguro de desactivar el expediente?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Aceptar',
                    cancelButtonText: 'Cancelar',
                    reverseButtons: true
                    }).then((result) => {
                    if (result.isConfirmed) {
                        
                        let me = this;
                        axios.put('/expediente/desactivar',{
                            'id': id
                        }).then(function (response){
                            me.listarExpediente();                        
                            swalWithBootstrapButtons.fire(
                                'Desactivado!',
                                'El registro ha sido desactivado con éxito.',
                                'success'
                            )
                        })
                        .catch(function (error){
                            console.log(error);
                        });
                    } else if (
                        result.dismiss === Swal.DismissReason.cancel
                    ) {
                    }
                })
            },
            activarExpediente(id){
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-success',
                        cancelButton: 'btn btn-danger'
                    },
                    buttonsStyling: false
                })

                swalWithBootstrapButtons.fire({
                    title: '¿Esta seguro de activar el expediente?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Aceptar',
                    cancelButtonText: 'Cancelar',
                    reverseButtons: true
                    }).then((result) => {
                    if (result.isConfirmed) {
                        
                        let me = this;
                        axios.put('/expediente/activar',{
                            'id': id
                        }).then(function (response){
                            me.listarExpediente();                        
                            swalWithBootstrapButtons.fire(
                                'Activado!',
                                'El registro ha sido activado con éxito.',
                                'success'
                            )
                        })
                        .catch(function (error){
                            console.log(error);
                        });
                    } else if (
                        result.dismiss === Swal.DismissReason.cancel
                    ) {
                    }
                })
            },
            validarExpediente(){
                this.errorExpediente=0;
                this.errorMostrarExpediente=[];

                if(!this.cabecera_documento) this.errorMostrarExpediente.push("Necesito el nombre de la cabecera");
                
                if(this.errorMostrarExpediente.length) this.errorExpediente = 1;

                return this.errorExpediente;
            },
            cerrarModal(){
                this.modal = 0;
                this.tituloModal='';
                this.codigo_expediente='';
                this.cabecera_documento= '';
                this.tipo_documento= '';
                this.asunto= '';
                this.prioridad= '';
                this.nro_folios= '';
                this.file= '';
                this.fecha_tramite= '';
                this.condicion= '';
            },
            abrirModal(modelo, accion, data = []){
                switch (modelo) {
                    case "expediente":
                    {
                        switch (accion) {
                            case 'registrar':
                            {
                                this.modal = 1;
                                this.tituloModal = 'Registrar Expediente';
                                this.codigo_expediente='';
                                this.cabecera_documento= '';
                                this.tipo_documento= '';
                                this.asunto= '';
                                this.prioridad= '';
                                this.nro_folios= '';
                                this.file= '';
                                this.fecha_tramite= '';
                                this.condicion= 1;
                                this.tipoAccion= 1;
                                break;
                            }
                            case 'actualizar':
                            {
                                //console.log(data);
                                this.modal = 1;
                                this.tituloModal = 'Actualizar Expediente';
                                this.expediente_id= data['id'];
                                this.codigo_expediente= data['codigo_expediente'];
                                this.cabecera_documento= data['cabecera_documento'];
                                this.tipo_documento= data['tipo_documento'];
                                this.asunto= data['asunto'];
                                this.prioridad= data['prioridad'];
                                this.nro_folios= data['nro_folios'];
                                this.file= data['file'];
                                this.fecha_tramite= data['fecha_tramite'];
                                this.tipoAccion= 2;
                                break;
                            }
                        }
                    }
                }
            }
        },
        mounted() {
            this.listarExpediente();
            console.log('Component mounted.')
        }
    }
</script>
<style>
    .modal-content{
        width: 100%;
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
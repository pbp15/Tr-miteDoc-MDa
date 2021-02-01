<template>
    <main class="main">
        
        <!-- Breadcrumb -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Escritorio</a></li>
        </ol>
        <div class="container-fluid">

            <div class="card">
                <div class="card-header">
                    <i class="fa fa-align-justify"></i> Expedientes
                </div>
                <div class="card-body">
                    <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                        <div class="col-md-9 m-auto">
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
                                <label class="col-md-3 form-control-label" for="text-input">N° de folios</label>
                                <div class="col-md-9">
                                    <input type="text" v-model="nro_folios" class="form-control">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Firma</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" v-model="usuario_nombre">
                                </div>
                            </div>


                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Correo electronico</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" v-model="usuario_email">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Subir documento</label>
                                <div class="col-md-9">
                                    <input type="text" v-model="file" class="form-control">
                                   <!-- <input type="file" class="form-control-file" @change="obtenerDocumento" name="file"> -->
                                </div>
                            </div>  
                            <span>{{asunto}}</span>
                            <!-- <vue-dropzone ref="myVueDropzone" id="dropzone" :options="dropzoneOptions"></vue-dropzone> -->

                            <div v-show="errorExpediente" class="form-group row div-error">
                                <div class="text-center text-error">
                                    <div v-for="error in errorMostrarExpediente" :key="error" v-text="error"></div>
                                </div>
                            </div>

                            <div class="form-group d-flex justify-content-center">                    
                                <button type="button" class="btn btn-secondary mx-1" @click="cancelar()">Cancelar</button>
                                <button type="button" class="btn btn-primary mx-1" @click="registrarExpediente()">Guardar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            
        </div>
    </main>
</template>

<script>
    export default {  
        data() {
            return {
                expediente_id:0,
                codigo_expediente:'',
                cabecera_documento:'',
                tipo_documento: '',
                asunto: '',
                prioridad: '',
                nro_folios: 1,
                file: '',
                fecha_tramite: '',
                errorExpediente: 0,
                errorMostrarExpediente: [],
                arrayUsuario: [],
                usuario_id: 0,
                usuario_nombre: '',
                usuario_email: '',
            }
        },
        methods: {
            obtenerUsuario(){
                let me = this;
                var url = '/user/obtener';
                axios.get(url).then(function (response){
                    var respuesta = response.data;
                    me.arrayUsuario = respuesta.usuario;
                    me.loadUsuario();
                })
                .catch(function (error) {
                    console.log(error);
                })
            },
            loadUsuario(){
                let me = this;
                me.arrayUsuario.map(function (x){
                    me.usuario_id = data['id'];
                    me.usuario_nombre = data['nombre'];
                    me.usuario_email = data['email'];
                });
            },
            registrarExpediente(){
                if (this.validarExpediente()){
                    return;
                }
                let me = this;
                axios.post('/expediente/registrar',{
                    'codigo_expediente': this.codigo_expediente,
                    'cabecera_expediente': this.cabecera_documento,
                    'tipo_documento': this.tipo_documento,
                    'asunto': this.asunto,
                    'prioridad': this.prioridad,
                    'nro_folios': this.nro_folios,
                    'file': this.file,
                    'condicion': this.condicion
                }).then(function (response){
                    console.log()
                }).catch(function (error){
                    console.log(error);
                })
            },
            validarExpediente(){
                this.errorExpediente=0;
                this.errorMostrarExpediente=[];

                if (!this.cabecera_documento) this.errorMostrarExpediente.push("Necesito el nombre de la cabecera");

                if (this.errorMostrarExpediente.length) this.errorExpediente = 1;
                
                return this.errorExpediente;
            },
            cancelar(){
                this.codigo_expediente = '',
                this.cabecera_documento = '',
                this.tipo_documento = '',
                this.asunto = '',
                this.prioridad = '',
                this.nro_folios = 1,
                this.file = '',
                this.condicion = 0
            }
        },
        mounted(){
            this.loadUsuario();
        }
    }
</script>
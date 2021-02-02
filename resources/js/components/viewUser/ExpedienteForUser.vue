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
                                <label class="col-md-3 form-control-label" for="text-input">Subir documento</label>
                                <div class="col-md-9">
                                    <input @change="subirFile"  type="file" class="form-control" placeholder="">
                                    <input type="hidden" name="documento" id="documento"> 
                                </div>
                            </div>   

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
                codigo_expediente: '',
                cabecera_documento: '',
                tipo_documento: '',
                asunto: '',
                nro_folios: 1,
                file: '',
                iduser: 0,
                idoficina: 0,
                idexpediente: 0,
                estado: '',
                tipoAccion: 0,
                errorExpediente: 0,
                errorMostrarExpediente: [],
            }
        },
        methods: {            
            subirFile(e){
                let me=this;
                let file=e.target.files[0];

                let reader= new FileReader();
                reader.onloadend=(file)=>{
                    me.file=reader.result;
                }
                reader.readAsDataURL(file);
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
                    'nro_folios': this.nro_folios,
                    'file' :  this.file,
                    'iduser': this.iduser,
                    'idoficina': this.idoficina,
                    'idexpediente': this.idexpediente
                }).then(function (response){
                    me.confirmarEnvio();
                    me.cancelar();
                }).catch(function (error){
                    console.log(error);
                });
            },
            validarExpediente(){
                this.errorExpediente=0;
                this.errorMostrarExpediente=[];

                if (!this.cabecera_documento) this.errorMostrarExpediente.push("Necesito el nombre de la cabecera");

                if (this.errorMostrarExpediente.length) this.errorExpediente = 1;
                
                return this.errorExpediente;
            },
            confirmarEnvio(){
                Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'El archivo fue enviado con éxito',
                showConfirmButton: false,
                timer: 1500
                })
            },
            cancelar(){
                this.codigo_expediente = '',
                this.tipo_documento = '',
                this.asunto = '',
                this.prioridad = '',
                this.nro_folios = 1,
                this.file = '',
                this.condicion = 0
            }
        },
    }
</script>
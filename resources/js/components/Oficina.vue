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
                <i class="fa fa-align-justify"></i> Unidades Orgánicas
                <button type="button" @click="abrirModal('oficina','registrar')" class="btn btn-secondary">
                    <i class="icon-plus"></i>&nbsp;Nuevo
                </button>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-md-6">
                        <div class="input-group">
                            <select class="form-control col-md-3" id="opcion" name="opcion">
                                <option value="nombre">Nombre</option>
                                <option value="responsable">Responsable</option>
                                <option value="condicion">Estado</option>
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
                            <th>Responsable</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="oficina in arrayOficina" :key="oficina.id">
                            <td>
                                <button type="button" @click="abrirModal('oficina','actualizar', oficina)" class="btn btn-warning btn-sm">
                                    <i class="icon-pencil"></i>
                                </button> &nbsp;
                                <template v-if="oficina.condicion">
                                    <button type="button" class="btn btn-danger btn-sm" @click="desactivarOficina(oficina.id)">
                                        <i class="icon-trash"></i>
                                    </button>
                                </template>
                                <template v-else>
                                    <button type="button" class="btn btn-info btn-sm" @click="activarOficina(oficina.id)">
                                        <i class="icon-check"></i>
                                    </button>
                                </template>
                            </td>
                            <td v-text="oficina.nombre_oficina"></td>
                            <td v-text="oficina.responsable"></td>
                            <td>
                                <div v-if="oficina.condicion">
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
                            <label class="col-md-3 form-control-label" for="text-input">Nombre</label>
                            <div class="col-md-9">
                                <input type="text" v-model="nombre_oficina" class="form-control" placeholder="Ingrese el nombre de la unidad orgánica">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="text-input">Responsable</label>
                            <div class="col-md-9">
                                <input type="text" v-model="responsable" class="form-control" placeholder="Ingrese el nombre del responsable de la unidad orgánica">
                            </div>
                        </div>
                        <div v-show="errorOficina" class="form-group row div-error">
                            <div class="text-center text-error">
                                <div v-for="error in errorMostrarOficina" :key="error" v-text="error"></div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                    <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarOficina()">Guardar</button>
                    <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarOficina()">Actualizar</button>
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
            oficina_id:0,
            nombre_oficina: '',
            responsable: '',
            condicion: '',
            arrayOficina : [],
            modal: 0,
            tituloModal: '',
            tipoAccion: 0,
            errorOficina: 0,
            errorMostrarOficina: [],
            pagination: {
                total: 0,
                current_page: 0,
                per_page: 0,
                last_page: 0,
                from: 0,
                to: 0,
            },
            offset: 3
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
        listarOficina(page){
            let me = this;
            var url = '/oficina?page=' + page;
            axios.get(url).then(function (response){
                var respuesta= response.data;
                me.arrayOficina = respuesta.oficinas.data;
                me.pagination= respuesta.pagination;
            })
            .catch(function (error){
                console.log(error);
            });
        },
        cambiarPagina(page){
            let me = this;
            //Actualiza la pagina actual
            me.pagination.current_page = page;

            //Envia la peticion para visualizar la data de sa pagina
            me.listarOficina(page);
        },
        registrarOficina(){
            if (this.validarOficina()) {
                return;
            }
            let me = this;
            axios.post('/oficina/registrar',{
                'nombre_oficina': this.nombre_oficina,
                'responsable': this.responsable,
                'condicion': this.condicion
            }).then(function (response){
                me.cerrarModal();
                me.listarOficina();
            })
            .catch(function (error){
                console.log(error);
            });
        },
        actualizarOficina(){
            if (this.validarOficina()) {
                return;
            }
            let me = this;
            axios.put('/oficina/actualizar',{
                'nombre_oficina': this.nombre_oficina,
                'responsable': this.responsable,
                'id': this.oficina_id
            }).then(function (response){
                me.cerrarModal();
                me.listarOficina();
            })
            .catch(function (error){
                console.log(error);
            });
        },
        desactivarOficina(id){
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: '¿Esta seguro de desactivar la unidad orgánica?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Aceptar',
                cancelButtonText: 'Cancelar',
                reverseButtons: true
                }).then((result) => {
                if (result.isConfirmed) {
                    
                    let me = this;
                    axios.put('/oficina/desactivar',{
                        'id': id
                    }).then(function (response){
                        me.listarOficina();                        
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
        activarOficina(id){
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: '¿Esta seguro de activar la unidad orgánica?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Aceptar',
                cancelButtonText: 'Cancelar',
                reverseButtons: true
                }).then((result) => {
                if (result.isConfirmed) {
                    
                    let me = this;
                    axios.put('/oficina/activar',{
                        'id': id
                    }).then(function (response){
                        me.listarOficina();                        
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
        validarOficina(){
            this.errorOficina=0;
            this.errorMostrarOficina=[];

            if(!this.nombre_oficina) this.errorMostrarOficina.push("Necesito el nombre de la Unidad Orgánica que desea agregar.");
            if(!this.responsable) this.errorMostrarOficina.push("Necesito el nombre del responsable de la Unidad Orgánica que desea agregar.");

            if(this.errorMostrarOficina.length) this.errorOficina = 2;

            return this.errorOficina;
        },
        cerrarModal(){
            this.modal=0;
            this.tituloModal='';
            this.nombre_oficina='';
            this.responsable='';
            this.condicion='';
        },
        abrirModal(modelo, accion, data = []){
            switch (modelo) {
                case "oficina":
                {
                    switch (accion) {
                        case 'registrar':
                        {
                            this.modal = 1;
                            this.tituloModal = 'Registrar Unidad Orgánica'; 
                            this.nombre_oficina= '';
                            this.responsable='';
                            this.condicion=1;
                            this.tipoAccion= 1;
                            break;
                        }
                        case 'actualizar':
                        {
                            //console.log(data);
                            this.modal = 1;
                            this.tituloModal = 'Actualizar Unidad Orgánica'; 
                            this.oficina_id = data['id'];
                            this.nombre_oficina = data['nombre_oficina'];
                            this.responsable = data['responsable'];
                            this.condicion = 1;
                            this.tipoAccion= 2;
                            break;
                        }
                    }
                }
            }
        },
    },
    mounted() {
        this.listarOficina();
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

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
                        <i class="fa fa-align-justify"></i> Testimonios
                        <button type="button" @click="abrirModal('testimonio','registrar')" class="btn btn-secondary">
                            <i class="icon-plus"></i>&nbsp;Nuevo
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" v-model="criterio">
                                      <option value="nombre">nombre</option>
                                      <option value="descripcion">Descripcion</option>
                                    </select>
                                    <input type="text" v-model="buscar" @keyup.enter="listarTestimonio(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" @click="listarTestimonio(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Opciones</th>
                                    <th>Nombre</th>
                                    <th>Procedencia</th>
                                    <th>Descripcion</th>
                                    <th>Imagen</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="testimonio in arrayTestimonio" :key="testimonio.id">
                                    <td>
                                        <button type="button" @click="abrirModal('testimonio','actualizar',testimonio)" class="btn btn-warning btn-sm">
                                          <i class="icon-pencil"></i>
                                        </button>
                                        <button type="button" class="btn btn-danger btn-sm" @click="eliminarTestimonio(testimonio.id)">
                                        <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                    <td v-text="testimonio.nombre"></td>
                                           <td v-text="testimonio.procedencia"></td>
                                    <td v-text="testimonio.descripcion"></td>
                                    <td>
                                        <img :src="'imagepage/testimonios/' + testimonio.imagen" class="img-responsive" width="100px" height="100px">
                                    </td>
                         
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
                                    <label class="col-md-3 form-control-label" for="text-input">Nombre</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="nombre" class="form-control" placeholder="Nombre del titulo">                                        
                                    </div>
                                </div>
                                   <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Universidad</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="universidad" class="form-control" placeholder="Nombre de la Universidad">                                        
                                    </div>
                                </div>
                          
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Descripcion</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="descripcion" class="form-control" placeholder="Descripcion">                                        
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="email-input">Imagen</label>
                                    <div class="col-md-9">
                                          <input @change="subirImagen"  type="file" class="form-control" placeholder="">
                                           <img :src="imagen" class="img-responsive" width="100px" height="100px"> 
                                    </div>
                                </div>
                              

                                <div v-show="errorTestimonio" class="form-group row div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in errorMostrarMsjTestimonio" :key="error" v-text="error">

                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                            <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarTestimonio()">Guardar</button>
                            <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarTestimonio()">Actualizar</button>
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
                testimonio_id: 0,
                nombre : '',
                universidad: '',
                descripcion : '',
                imagen : '',
                arrayTestimonio: [],
                modal : 0,
                tituloModal : '',
                tipoAccion : 0,
                errorTestimonio : 0,
                errorMostrarMsjTestimonio : [],
                pagination : {
                    'total' : 0,
                    'current_page' : 0,
                    'per_page' : 0,
                    'last_page' : 0,
                    'from' : 0,
                    'to' : 0,
                },
                offset : 3,
                criterio : 'nombre',
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
            listarTestimonio (page,buscar,criterio){
                let me=this;
                var url= '/testimonio?page=' + page + '&buscar='+ buscar + '&criterio='+ criterio;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.arrayTestimonio = respuesta.testimonios.data;
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
                me.listarTestimonio(page,buscar,criterio);
            },
            subirImagen(e){
                let me=this;
                let file=e.target.files[0];

                let reader= new FileReader();
                reader.onloadend=(file)=>{
                    me.imagen=reader.result;
                }
                reader.readAsDataURL(file);
            },
            registrarTestimonio(){
                if (this.validarTestimonio()){
                    return;
                }
                
                let me = this;

                axios.post('/testimonio/registrar',{
                    'nombre': this.nombre,
                    'universidad':this.universidad,
                    'descripcion': this.descripcion,
                    'imagen' : this.imagen,
                }).then(function (response) {
                    swal(
                        'Registrado!',
                        'El testimonio ha sido registrado con éxito.',
                        'success'
                        )
                    me.cerrarModal();
                    me.listarTestimonio(1,'','titulo');
                }).catch(function (error) {
                    console.log(error);
                });
            },
            actualizarTestimonio(){
               if (this.validarTestimonio()){
                    return;
                }
                
                let me = this;

                axios.put('/testimonio/actualizar',{
                    'nombre': this.nombre,
                    'universidad' : this.universidad,
                    'descripcion': this.descripcion,
                    'imagen' : this.imagen,
                    'id': this.testimonio_id
                }).then(function (response) {
                   swal(
                        'Actualizado!',
                        'El testimonio ha sido actualizado con éxito.',
                        'success'
                        )
                    me.cerrarModal();
                    me.listarTestimonio(1,'','titulo');
                }).catch(function (error) {
                    console.log(error);
                }); 
            },            
            validarTestimonio(){
                this.errorTestimonio=0;
                this.errorMostrarMsjTestimonio =[];

                if (!this.nombre) this.errorMostrarMsjTestimonio.push("El nombre del testimonio no puede estar vacío.");

                if (this.errorMostrarMsjTestimonio.length) this.errorTestimonio = 1;

                return this.errorTestimonio;
            },
              eliminarTestimonio(id){
            
             swal({
                title: 'Esta seguro de eliminar este testimonio?',
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

                    axios.put('/testimonio/eliminar',{
                        'id': id
                    }).then(function (response) {
                        me.listarTestimonio(1,'','nombre');
                        swal(
                        'Eliminado!',
                        'El registro ha sido activado con éxito.',
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
                this.nombre='';
                this.universidad='',
                this.descripcion='';
                this.imagen='';
                this.errorTestimonio=0;

            },
            abrirModal(modelo, accion, data = []){
                switch(modelo){
                    case "testimonio":
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                this.modal = 1;
                                this.tituloModal = 'Registrar Testimonio';
                                this.nombre= '';
                                this.universidad='';
                                this.descripcion='';
                                this.imagen='';
                                this.tipoAccion = 1;
                                break;
                            }
                            case 'actualizar':
                            {
                                //console.log(data);
                                this.modal=1;
                                this.tituloModal='Actualizar Testimonio';
                                this.tipoAccion=2;
                                this.testimonio_id=data['id'];
                                this.nombre = data['nombre'];
                                this.universidad = data['universidad'];
                                this.descripcion = data['descripcion'];
                                this.imagen = data['imagen'];
                                break;
                            }
                        }
                    }
                }
            }
        },
        mounted() {
            this.listarTestimonio(1,this.buscar,this.criterio);
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

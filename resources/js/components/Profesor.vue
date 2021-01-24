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
                        <i class="fa fa-align-justify"></i> Profesores
                        <button type="button" @click="abrirModal('profesore','registrar')" class="btn btn-secondary">
                            <i class="icon-plus"></i>&nbsp;Nuevo
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" v-model="criterio">
                                      <option value="nombres">Nombres</option>
                                    </select>
                                    <input type="text" v-model="buscar" @keyup.enter="listarProfesor(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" @click="listarProfesor(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Opciones</th>
                                    <th>Apellidos y Nombres</th>
                                    <th>Curso a Cargo</th>
                                    <th>Nivel</th>
                                    <th>Imagen</th>
                                 
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="profesore in arrayProfesore" :key="profesore.id">
                                    <td>
                                        <button type="button" @click="abrirModal('profesore','actualizar',profesore)" class="btn btn-warning btn-sm">
                                          <i class="icon-pencil"></i>
                                        </button>
                                        <button type="button" class="btn btn-danger btn-sm" @click="eliminarProfesor(profesore.id)">
                                        <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                    <td v-text="profesore.nombres"></td>
                                    <td v-text="profesore.curso_cargo"></td>
                                          <td v-text="profesore.nivel"></td>
                                    <td>
                                        <img :src="'imagepage/profesores/' + profesore.imagen" class="img-responsive" width="100px" height="100px">
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
                                    <label class="col-md-3 form-control-label" for="text-input">Nombres</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="nombres" class="form-control" placeholder="Apellidos y Nombres">                                        
                                    </div>
                                </div>
                          
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Curso a Cargo</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="curso_cargo" class="form-control" placeholder="Descripcion">                                        
                                    </div>
                                </div>
                                 <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Nivel Educativo</label>
                                    <div class="col-md-9">                                
                                         <select class="form-control" v-model="nivel">
                                            <option value="0" disabled>Seleccione</option>
                                            <option >Inicial</option>
                                            <option > Primaria</option>
                                            <option >Secundaria</option>
                                        </select>                           
                              
                                    </div>
                                </div>
                              
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="email-input">Imagen</label>
                                    <div class="col-md-9">
                                          <input @change="subirImagen"  type="file" class="form-control" placeholder="">
                                           <img :src="imagen" class="img-responsive" width="100px" height="100px"> 
                                    </div>
                                </div>
                                

                                <div v-show="errorProfesore" class="form-group row div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in errorMostrarMsjProfesore" :key="error" v-text="error">

                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                            <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarProfesor()">Guardar</button>
                            <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarProfesor()">Actualizar</button>
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
                profesor_id: 0,
                nombres : '',
                curso_cargo : '',
                nivel: '',
                imagen : '',           
                arrayProfesore : [],
                modal : 0,
                tituloModal : '',
                tipoAccion : 0,
                errorProfesore : 0,
                errorMostrarMsjProfesore : [],
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
            listarProfesor (page,buscar,criterio){
                let me=this;
                var url= '/profesor?page=' + page + '&buscar='+ buscar + '&criterio='+ criterio;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.arrayProfesore = respuesta.profesores.data;
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
                me.listarProfesor(page,buscar,criterio);
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
            registrarProfesor(){
                if (this.validarProfesor()){
                    return;
                }
                
                let me = this;

                axios.post('/profesor/registrar',{
                    'nombres': this.nombres,
                    'curso_cargo': this.curso_cargo,
                     'nivel' :  this.nivel,
                    'imagen' : this.imagen,
                   
                }).then(function (response) {
                    swal(
                        'Registrado!',
                        'El profesor ha sido registrado con éxito.',
                        'success'
                        )
                    me.cerrarModal();
                    me.listarProfesor(1,'','nombres');
                }).catch(function (error) {
                    console.log(error);
                });
            },
            actualizarProfesor(){
               if (this.validarProfesor()){
                    return;
                }
                
                let me = this;

                axios.put('/profesor/actualizar',{
                    'nombres': this.nombres,
                    'curso_cargo': this.curso_cargo,                    
                    'nivel' :  this.nivel,
                    'imagen' : this.imagen,
                    'id': this.profesor_id
                }).then(function (response) {
                   swal(
                        'Actualizado!',
                        'El registro ha sido actualizado con éxito.',
                        'success'
                        )
                    me.cerrarModal();
                    me.listarProfesor(1,'','nombres');
                }).catch(function (error) {
                    console.log(error);
                }); 
            },            
            validarProfesor(){
                this.errorMostrarMsjProfesore=0;
                this.errorMostrarMsjProfesore =[];

                if (!this.nombres) this.errorMostrarMsjProfesore.push("El nombre del profesor no puede estar vacío.");

                if (this.errorMostrarMsjProfesore.length) this.errorProfesore = 1;

                return this.errorProfesore;
            },
              eliminarProfesor(id){
            
             swal({
                title: 'Esta seguro de eliminar este registro?',
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

                    axios.put('/profesor/eliminar',{
                        'id': id
                    }).then(function (response) {
                        me.listarProfesor(1,'','nombres');
                        swal(
                        'Eliminado!',
                        'El registro ha sido eliminado con éxito.',
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
                this.nombres='';
                this.curso_cargo='';                
                this.nivel='';
                this.imagen='';
                this.errorProfesore=0;

            },
            abrirModal(modelo, accion, data = []){
                switch(modelo){
                    case "profesore":
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                this.modal = 1;
                                this.tituloModal = 'Registrar Profesor';
                                this.nombres='';
                                this.curso_cargo='';                
                                this.nivel='';
                                this.imagen='';
                                this.tipoAccion = 1;
                                break;
                            }
                            case 'actualizar':
                            {
                                //console.log(data);
                                this.modal=1;
                                this.tituloModal='Actualizar Evento';
                                this.tipoAccion=2;
                                this.profesor_id=data['id'];
                                this.nombres = data['nombres'];
                                this.curso_cargo = data['curso_cargo'];                                
                                this.nivel=data['nivel'];
                                this.imagen = data['imagen'];
                                break;
                            }
                        }
                    }
                }
            }
        },
        mounted() {
            this.listarProfesor(1,this.buscar,this.criterio);
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

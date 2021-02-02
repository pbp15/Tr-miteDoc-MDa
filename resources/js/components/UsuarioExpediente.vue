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
                <i class="fa fa-align-justify"></i> Expedientes
                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modalNuevo">
                    <i class="icon-plus"></i>&nbsp;Nuevo
                </button>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-md-6">
                        <div class="input-group">
                            <select class="form-control col-md-3" id="opcion" name="opcion">
                                <option value="nombre">Cód. expediente</option>
                                <option value="prioridad">Remitente</option>
                            </select>
                            <input type="text" id="texto" name="texto" class="form-control" placeholder="Texto a buscar">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                        </div>
                    </div>
                </div>
                <table class="table table-bordered table-striped table-sm">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Remitente</th>
                            <th>Cabecera</th>
                            <th>Tipo de documento</th>
                            <th>Asunto</th>
                            <th>Prioridad</th>
                            <th>N° folio</th>
                            <th>Documento</th>
                            <th>Fecha</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="expediente in arrayExpediente" :key="expediente.id">
                            <td v-text="expediente.codigo_expediente"></td>
                            <td v-text="expediente.codigo_expediente"></td>
                            <td v-text="expediente.codigo_expediente"></td>
                            <td v-text="expediente.cabecera_documento"></td>
                            <td v-text="expediente.tipo_documento"></td>
                            <td v-text="expediente.asunto"></td>
                            <td v-text="expediente.prioridad"></td>
                            <td v-text="expediente.nro_folios"></td>
                            <td v-text="expediente.file"></td>
                            <td v-text="expediente.fecha_tramite"></td>
                            <td>
                                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalNuevo">
                                    <i class="icon-pencil"></i>
                                </button> &nbsp;
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalEliminar">
                                    <i class="icon-trash"></i>
                                </button>
                            </td>
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
    <div class="modal fade" id="modalNuevo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-primary modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Agregar expedientes</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="text-input">Código</label>
                            <div class="col-md-9">
                                <input type="text" id="codigo" name="codigo" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="text-input">Remitente</label>
                            <div class="col-md-9">
                                <input type="text" id="remitente" name="remitente" class="form-control" aria-disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="text-input">Cabecera</label>
                            <div class="col-md-9">
                                <input type="text" id="cabecera" name="cabecera" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="text-input">Tipo de documento</label>
                            <div class="col-md-9">
                                <input type="text" id="tipo" name="tipo" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="text-input">Asunto</label>
                            <div class="col-md-9">
                                <input type="text" id="asunto" name="asunto" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="text-input">Prioridad</label>
                            <div class="col-md-9">
                                <input type="text" id="prioridad" name="prioridad" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="text-input">N° de folios</label>
                            <div class="col-md-9">
                                <input type="text" id="folio" name="folio" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="text-input">Documento</label>
                            <div class="col-md-9">
                                <input type="text" id="documento" name="documento" class="form-control">
                                <span class="help-block">(*) Ingrese el el archivo a enviar</span>
                                <button>Cargar archivo...</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary">Guardar</button>
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
                    <h4 class="modal-title">Eliminar expediente</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>¿Estas seguro de eliminar este expediente?</p>
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
        return {
            codigo_expediente: '',
            cabecera_documento: '',
            tipo_documento: '',
            asunto: '',
            prioridad: '',
            nro_folios: '',
            file: '',
            fecha_tramite: '',
            arrayExpediente : []
        }
    },
    methods : {
        listarExpediente(){
            let me = this;
            axios.get('/expediente').then(function (response){
                me.arrayExpediente = response.data;
            })
            .catch(function (error){
                console.log(error);
            });
        }
    },
    mounted() {
        this.listarExpediente();
    }
}
</script>




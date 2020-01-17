<template>
    <main class="main">
        <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" v-model="criterio">
                                      <option value="nombre">Nombre</option>
                                      <option value="descripcion">Descripción</option>
                                    </select>
                                    <input type="text" v-model="buscar" @keyup.enter="listarProductos(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" @click="listarProductos(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Descripción</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="categoria in arrayProductos" :key="categoria.id">
                                    <td>
                                        <button type="button" @click="abrirModal('categoria','actualizar',categoria)" class="btn btn-warning btn-sm">
                                          <i class="icon-pencil"></i>
                                        </button> &nbsp;
                                        <template v-if="categoria.condicion">
                                            <button type="button" class="btn btn-danger btn-sm" @click="desactivarCategoria(categoria.id)">
                                                <i class="icon-trash"></i>
                                            </button>
                                        </template>
                                        <template v-else>
                                            <button type="button" class="btn btn-info btn-sm" @click="activarCategoria(categoria.id)">
                                                <i class="icon-check"></i>
                                            </button>
                                        </template>
                                    </td>
                                    <td v-text="categoria.nombre"></td>
                                    <td v-text="categoria.descripcion"></td>
                                    <td>
                                        <div v-if="categoria.condicion">
                                            <span class="badge badge-success">Activo</span>
                                        </div>
                                        <div v-else>
                                            <span class="badge badge-danger">Desactivado</span>
                                        </div>
                                        
                                    </td>
                                </tr>                                
                            </tbody>
                        </table>
                        <div src="btransparent">
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
                        </div>
                    </div>
                </div>
                <!-- Fin ejemplo de tabla Listado -->
            </div>
    </main>
</template>

<script>
document.addEventListener('DOMContentLoaded', function() {
                        var elems = document.querySelectorAll('select');
                        var instances = M.FormSelect.init(elems);
                    });
    export default {
        data(){
            return{
                img: '',
                arrayProductos:[],
                modal : 0,
                tituloModal : '',
                pagination:{
                    "total" : 0,
                    "current_page" :0,
                    "per_page" : 0,
                    "last_page" : 0,
                    "from" : 0,
                    "to" : 0
                },
                offset : 3,
                criterio : 'nombre',
                buscar : ''
            }
        },computed:{
            isActived: function() {
                return this.pagination.current_page;
            },
            //calcular los elementos de la paginacion
            pagesNumber: function(){
                if(!this.pagination.to){
                    return [];
                } 

                var from =  this.pagination.current_page - this.offset;
                if(from < 1){
                    from = 1;
                }

                var to = from + (this.offset * 2);
                if(to >= this.pagination.last_page){
                    to = this.pagination.last_page;
                }

                var pagesArray = []
                while(from <= to){
                    pagesArray.push(from);
                    from++;
                }
                return pagesArray;
            }
        }, 
        methods:{
            listarProductos(page,buscar,criterio){
                let m=this;
                var url= '/producto?page=' + page + '&buscar='+ buscar + '&criterio='+ criterio;

                axios.get(url).then(function (response){
                    var respuesta = response.data;
                    me.arrayProductos = respuesta.productos.data;
                    me.pagination = respuesta.pagination;
            })
            .catch(function(error){
                console.log(error);
            });

            },
            cambiarPagina(page){
                let me = this;

                //Actualizar la pagina actual.
                me.pagination.current_page = page;
                me.listarProductos(page,buscar,criterio);
            },

            // abrirModal(modelo,accion, data = []){
            //     switch(modelo){
            //         case "Producto":
            //             {
            //                 switch(accion){
            //                     case 'registrar':
            //                         {
            //                             this.modal = 1;
            //                             this.nombre = '';
            //                             this.tituloModal = 'Registrar Sliders';
            //                             break;

            //                         }
            //                     case 'actualizar':
            //                         {

            //                         }
            //                 }

            //             }
            //     }

            // },
          
        },
        mounted() {
            // this.listarSliders();
          
        }
     };
</script>
<style>

.mostrar{
    display: list-item !important;
    opacity: 1 !important;
    position: absolute !important;
    background-color: white !important;
}
</style>

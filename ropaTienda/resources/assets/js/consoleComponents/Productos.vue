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
                                    <th>Nombre<th>
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

    
  <!-- Modal de Registrar/Actualizar Slider -->
            <div class="modal fade" tabindex="-1" :class="{'mostrar' : modal}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                            <h4 class="modal-title center" v-text="tituloModal"></h4>
                            
                            <div class="col s5 center">
                                         <img v-if="tipoAccion==2" :src="'img/'+img"  class="imagenEdit" alt="">
                            </div>
                                <div class="form-group row">
                                    <!-- input para el nombre del producto -->
                                    <input id="nombre" type="text" v-model="Nombre" class="validate">
                                    <label  for="nombre">Nombre</label>
                                    <br> 
                                    <!-- input para la descripción del producto -->
                                    <input id="descripcion" type="text" v-model="Descripcion" class="validate">
                                    <label  for="descripcion">descripcion</label>
                                    <br> 
                                    <!-- input para el precio del producto -->
                                    <input id="precio" type="text" v-model="Precio" class="validate">
                                    <label  for="precio">Precio</label>
                                    <br> 
                                    <!-- select Subcategorias -->
                                    <select name="LeaveType" class="browser-default" v-model="idSubcat">
                                        <option value="" disabled selected>Selecciona la subCategoría</option>
                                        <option v-for="subcategoria in arraySubcategoria" :value="subcategoria.id" :key="subcategoria.id">{{ subcategoria.Nombre }}</option>
                                    </select> 
                                    <br>
                                    <!-- select color -->

                                    <select multiple name="LeaveType" class="browser-default" v-model="idColor">
                                        
                                        <option value="" disabled selected>Selecciona el color</option>
                                        <option v-for="color in arrayColor" :value="color.id" :key="color.id">{{ color.Nombre }}</option>
                                      
                                    </select> 
                                    <br>
                                    <!-- input para la imagen del producto -->
                                    <div class="col s10 center">
                                        <div class="file-field input-field">
                                            <div class="waves-effect waves-light btn deep-orange lighten-4 brown-text">
                                                <span>Imagen</span>
                                                <input id="file" ref="filea"  type="file" data-vv-scope="new"  v-on:change="seleccionarImagen(1)" class="sliderAlta">
                                            </div>
                                            <div class="file-path-wrapper">
                                                <input class="file-path validate" type="text">
                                            </div>
                                        </div>
                                    </div> 

                                </div> 
                        <div class="modal-footer">
                            <button type="button" class="espacioButton waves-effect waves-light btn deep-orange lighten-4 brown-text" @click="cerrarModal()">Cerrar</button>
                            <button type="button" v-if="tipoAccion==1" class="espacioButton waves-effect waves-light btn deep-orange lighten-4 brown-text" @click="nuevoProducto()">Guardar</button>
                            <button type="button" v-if="tipoAccion==2" class="espacioButton waves-effect waves-light btn deep-orange lighten-4 brown-text" @click="actualizarProducto(id)">Actualizar</button>
                        </div>
                    </div>
             </div>  
 <!-- termina modal   -->


    <!-- Muestra productos -->

       <div class="row">
           <div class="col s12">
            <h3 class="center">Productos</h3>
            <div class="right col s2">
                <a class="btn-floating btn-large waves-effect waves-light deep-orange lighten-4 right" @click="abrirModal('productos','registrar')"><i class="brown-text material-icons">add</i></a>
            </div>
           </div>

        <br>
           <div class="center col s12">
               <div class="centro col s5 ">
                    <ul class="collection " v-for="productos in arrayProductos" :key="productos.id">
                        <li class="collection-item avatar">
                            <h5 v-text="productos.Nombre"></h5>
                        <a href="#!" class="secondary-content">
                            <i class="switch">
                                <label>Off<input type="checkbox" @click="actualizarProducto()"><span class="lever"></span>On</label>
                            </i></a>
                        </li>
                    </ul>
               </div> 
           </div>   
       </div>
    <!-- Termina muestra de productos -->


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
                Nombre: '',
                Descripcion:'',
                Precio:'',
                idSubcat:'',
                idColor:'',
                tipoAccion:0,
                arrayProductos:[],
                arrayColor:[],
                arraySubcategoria:[],
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
                buscar : '',
                file: ''

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
                var url= '/productos?page=' + page + '&buscar='+ buscar + '&criterio='+ criterio;

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
            abrirModal(modelo,accion, data = []){
                switch(modelo){
                    case "productos":
                        {
                            switch(accion){
                                case 'registrar':
                                    {
                                        this.modal = 1;
                                        this.nombre = '';
                                        this.tipoAccion = 1;
                                        this.tituloModal = 'Registrar Producto';
                                        break;

                                    }
                                case 'actualizar':
                                    {
                                        this.modal = 2;
                                        this.Nombre = '';
                                        this.tipoAccion = 2;
                                        this.tituloModal = 'Actualizar Producto';
                                    }
                            }
                        }
                }
            },
            nuevoProducto(){
                let me = this;

                let formData = new FormData();
                formData.append('file', me.file);
                
                
                //Registramos la informacion
                axios.post('/productos/registrar', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then(function (response) {
                    me.listarProductos();
                    me.cerrarModal();
                    me.limpiar();
                    // var toastHTML = '<span>Slider Registrado Correctamente</span>';
                    // M.toast({ html: toastHTML, classes: 'rounded tos', displayLength: 1500 });

                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            actualizarProducto(){
                let me = this;
                    let formData = new FormData();
                        formData.append('file', me.file);
                         formData.append('id',id);
                    
                    //Regresamos la informacion
                    axios.post('/productos/actualizar', formData, {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    })
                    .then(function (response) {
                        me.listarProductos();
                        me.cerrarModal();
                   
                   })
                    .catch(function (error) {
                        console.log(error);
        
             });

            },
             cerrarModal(){
                this.modal=0;
                this.tituloModal='';
                this.img='';
            },
            limpiar(){
                let me = this;
                me.errors.clear('new');
                me.errors.clear('update');
                me.img = '';
                me.Descripcion='';
                me.Precio='';
                me.idSubcat='';
                me.idColor='';
                me.tipoAccion = 0;
                me.Cambio = 0;
            },
        mounted(){
            this.listarProductos();
        }
        }
    };
</script>
<style>
    .modal-content{
        width: 100% !important;
        position: absolute !important;
        height: 600px;
    }
    .mostrar{
        display: list-item !important;
        opacity: 1 !important;
        position: absolute !important;
        z-index: 100;
    }
    .centrado{
        height:560px;
        margin-left: 20%;
        margin-right: 30%;
    }
    .espacioButton{
        margin-left: 10px !important;
    }
</style>

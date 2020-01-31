<template>
    <main class="main">
         <!-- abre modal -->
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
                        <!-- input para la descripción del producto-->
                        <input id="descripcion" type="text" v-model="Descripcion" class="validate">
                        <label  for="descripcion">Descripcion</label>
                        <br> 
                        <!-- input para el precio del producto --> 
                        <input id="precio" type="text" v-model="Precio" class="validate">
                        <label  for="precio">Precio</label>
                        <br> 
                        <!-- select Subcategorias --> 
                        <select name="LeaveType" class="browser-default" v-model="idSubcat">
                            <option value="" disabled selected>Selecciona la subCategoría</option>
                            <option v-on:change="vercoloresSubCategorias()" v-for="subcategoria in arraySubcategoria" :value="subcategoria.idSubcat" :key="subcategoria.id">{{ subcategoria.NombreSub }}</option>
                        </select> 
                        <br>
                        <!-- select color -->
                        <!-- <select multiple name="LeaveType" class="browser-default"> -->
                            <!-- v-model="idColor" -->
                         <select name="LeaveType" class="browser-default" v-model="idColor">
                            <option value="" disabled selected>Selecciona un color</option>
                            <option  v-on:change="vercoloresSubCategorias()" v-for="color in arrayColor" :value="color.id" :key="color.id">{{ color.NombreColor }}</option>
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
                    <button type="button" v-if="tipoAccion==2" class="espacioButton waves-effect waves-light btn deep-orange lighten-4 brown-text" @click="actualizarProducto(idProducto)">Actualizar</button>
                </div>
            </div>
        </div>  
    <!-- cierra modal -->

  <!-- boton abrir modal -->
        <div class="row">
                <div class="col s12">
                    <h3 class="center">Productos</h3>
                    <div class="right col s2">
                        <a class="btn-floating btn-large waves-effect waves-light deep-orange lighten-4 right" @click="abrirModal('productos','registrar')"><i class="brown-text material-icons">add</i></a>
                     </div>
                </div>
        </div>
    <!-- fin boton abrir modal -->

        <!-- abre tabla -->
        <table class="tusers striped">
            <thead>
                <tr>
                    <th>Nombre<th>
                    <th>Descripción</th>
                    <th>Estado</th>
                    <th>Precio</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="producto in arrayProducto" :key="producto.idProducto">
                    <td v-text="producto.NombreProducto"></td>
                    <td></td>
                    <td v-text="producto.Descripcion"></td>
                    <td v-text="producto.Existencia"></td>
                    <td v-text="producto.Precio"></td>
                </tr>                                
            </tbody>
        </table>
    <!-- cierra tabla -->
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
                idProducto: 0,
                img: '',
                Nombre: '',
                Descripcion:'',
                Precio:'',
                idSubcat:'',
                idColor:'',
                Existencia: 0,
                idTalla:'',
                Talla:'',
                tipoAccion:0,
                arrayProducto:[],
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
            // calcular los elementos de la paginacion
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
        }, methods:{
            listarProductos(){
                let me=this;
                var url = '/productos'
                axios.get('/productos').then(function (response){
                    me.arrayProducto = response.data;
                  
                })
                .catch(function(error){
                    console.log(error);
                });
            }, 
            abrirModal(modelo,accion, data = []){
                switch(modelo){
                    case "productos":{
                        switch(accion){
                            case 'registrar':{
                                this.modal = 1;
                                this.nombre = '';
                                this.tipoAccion = 1;
                                this.tituloModal = 'Registrar Producto';
                                break;

                            }
                            case 'actualizar':{
                                this.modal = 2;
                                this.Nombre = '';
                                this.tipoAccion = 2;
                                this.img=data['Imagen'];
                                this.Nombre=data['Nombre'];
                                this.Descripcion=data['Descripcion'];
                                this.
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
                
                
                // Registramos la informacion
                axios.post('/productos/registrar', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then(function (response) {
                    me.listarProductos();
                    me.cerrarModal();
                    me.limpiar();
                     var toastHTML = '<span>Slider Registrado Correctamente</span>';
                     M.toast({ html: toastHTML, classes: 'rounded tos', displayLength: 1500 });

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
                
                // Regresamos la informacion
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
                this.Nombre = "";
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
            vercoloresSubCategorias(){
                let me=this;
                me.listado=2;
                //Obtener los datos del ingreso
                var url= this.ruta + '/subcategoria';
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    arraySubcategoria = respuesta.subCategorias;
                    me.NombreSubCategoria = arraySubcategoria[0]['NombreSubcategoria'];
                   
                })
                .catch(function (error) {
                    console.log(error);
                });
                //Obtener los datos de los detalles
                var urld= '/colores';
                axios.get(urld).then(function (response) {
                    console.log(response);
                    var respuesta= response.data;
                    arrayColor = respuesta.color;
                    arrayColor = respuesta.color;

                     me.NombreColor= arrayColor[0]['NombreColor'];

                })
                .catch(function (error) {
                    console.log(error);
                });
            },
        }, mounted(){
            this.listarProductos();
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





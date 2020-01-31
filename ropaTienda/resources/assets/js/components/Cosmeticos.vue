<template>
    <main class="main">

    <!-- Muestra de SubCategorías -->
        <div class="row " v-if="listado==1">
         <br>
            <div class="col s12">
              <div v-for="subcategorias in arraySubcategorias" :key="subcategorias.idSubCategorias" class="col s4 center">
                       <a @click="verProductos(subcategorias.idSubCategorias)" >
                           <img class="tImagen productos" :src="'img/'+ subcategorias.imagenSub"></a>
                        <h5><a class="brown-text" >{{ subcategorias.NombreSub}}</a></h5>
              </div>
            </div>
        </div>
    <!-- Termina muestra de SubCategorías -->

    <!-- Muestra de productos por subCategorías -->
     <div class="row contenedorCard" v-if="listado==2">
         <br>
          <div class="col s12">
            <div class="card medium col s4" v-for="producto in arrayProductos" :key="producto.idProducto">
                    <div class="card-image ">
                        <img :src="'img/'+producto.Imagen">
                    </div>
                    <div class="card-content">
                        <p> {{producto.Nombre}}</p>
                    </div>
                    <div class="card-action">
                        <a @click="verProductoDetalle(producto.id)">Mostrar más.</a>
                    </div>
            </div>
         </div>
     </div>
    <!-- Termina muestra de productos por subCategorías -->


    <!-- Muestra de producto individual -->
        <div class="row contenedorCard" v-else-if="listado==3">
            <br>
            <div  v-for="detalle in arrayDetalleProducto" :key="detalle.idPorducto">
                <div class="col s5">
                    <img :src="'img/'+detalle.Imagen">
                </div>
                <div class="s5 center">
                    <br>
                    <h2 >{{ detalle.NombreProducto}}</h2>
                    <h5>$ {{detalle.Precio}} MXN</h5>

                    <h5>
                        <p>Descripción:
                        <br>
                    {{detalle.Descripcion}}</p></h5>
                </div>               
            </div>
        </div>
    <!-- Termina muestra de producto individual -->

    </main>
</template>

<script>
    export default {
        data(){
            return{
            arraySubcategorias:[],
            arrayProductos:[],
            arrayDetalleProducto:[],
            listado:1
            }

        },
        methods:{
        listarSubcategorias(){
            let m=this;
            m.listado=1;


             axios.get('/subcategoria/accesorios').then(function (response){
                    m.arraySubcategorias = response.data;
                  
                })
                .catch(function(error){
                    console.log(error);
                });

        },
        verProductos(id){
            let m=this;
            m.listado=2;

             axios.get('/productosSub?id='+id).then(function (response){
                    m.arrayProductos = response.data;
                  
                })
                .catch(function(error){
                    console.log(error);
                });


        },
        verProductoDetalle(id){
            let m=this;
            m.listado=3;

             axios.get('/detalleProducto?id='+id).then(function (response){
                    m.arrayDetalleProducto = response.data;
                  
                })
                .catch(function(error){
                    console.log(error);
                });

        }
        },
        mounted() {
            console.log('Component mounted.');
            this.listarSubcategorias();
        }
     }
 </script>

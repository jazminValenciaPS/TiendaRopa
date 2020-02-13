<template>
    <main class="main">

        <div class="row " v-if="listado==1">
  <!-- Muestra breadcrumb -->
 

     <div class="breadcrumb colorLetra">
        <div class="breadcrumb-item">
            <div class="col s12 ">
                <a v-if="catalogo>=1" @click="catalogo=1" class="black-text ">Accesorios</a>
                <a v-if="catalogo>=2" @click="catalogo=2" class="black-text ">/ {{bread2}}</a>
                <a v-if="catalogo>=3" @click="catalogo=3" class="black-text ">/ {{bread3}}</a>
            </div>
        </div>
     </div>
  <!--Termina muestra breadcrumb -->

         <br>
          <!-- Muestra SubCategorias -->
            <div v-if="catalogo==1" class="col s12 l12">
              <div v-for="subcategorias in arraySubcategorias" :key="subcategorias.idSubCategorias" class="col s12 l4 center ">
                       <a @click="verProductos(subcategorias.idSubCategorias),bread2=subcategorias.NombreSub" >
                           <img class="tImagen productos" :src="'img/'+ subcategorias.imagenSub"></a>
                        <h5><a class="brown-text" >{{ subcategorias.NombreSub}}</a></h5>
                        <!-- <h6 style="color:white;">{{bread2=subcategorias.NombreSub }}</h6>  -->
              </div>
            </div>
         <!-- Termina muestra SubCategorias -->

         <!-- Muestra Productos -->

             <div v-else-if="catalogo==2" class="col s12 l4 contenedorCard">
               <div style="margin-left:20px;" class="card medium col s12 l4 " v-for="producto in arrayProductos" :key="producto.idProducto">
                    <div class="card-image ">
                        <img id="imagenCard" :src="'img/'+producto.Imagen">
                    </div>
                    <div class="card-content">
                        <p> {{producto.NombreProducto}}</p>
                        <!-- <h6 style="color:white;">{{}}</h6>  -->

                    </div>
                    <div class="card-action">
                        <!-- <a href="">Mostrar más.</a> -->
                        <a @click="verProductoDetalle(producto.idProducto),bread3=producto.NombreProducto ">Mostrar más.</a>
                    </div>
            </div>  
            </div>
         <!-- Termina muestra SubCateProductosgorias -->

         <!-- Muestra detalles de productos -->

            <div v-else-if="catalogo==3" class="col s12 l12 m12">
                <div class="row " >
                    <br>
                    <div  v-for="detalle in arrayDetalleProducto" :key="detalle.idPorducto">
                        <div class="col s12 l6 center">
                            <img class="responsive imagenProducto" :src="'img/'+detalle.Imagen">
                        </div>
                        <div class="col s12 l5 center">
                            <h2 style="margin-top: 0%;">{{ detalle.NombreProducto}}</h2>
                            <h5 class="">$ {{detalle.Precio}} MXN</h5>

                            <h5 class="">                    
                                <p>Talla: {{detalle.Talla}}
                                </p>
                            </h5>
                            <h5 class="">
                                <p>
                                    Color: {{detalle.NombreColor}}
                                </p>
                            </h5>
                            <h5 class="">
                                <p>Descripción:
                                <br>
                            {{detalle.Descripcion}}</p></h5>
                        </div>               
                    </div>
                 </div>
             </div>
         <!-- Termina muestra detalles de productos -->
        </div>

    </main>
</template>

<script>
  
    export default {
        data(){
            return{
            arraySubcategorias:[],
            arrayProductos:[],
            arrayDetalleProducto:[],
            listado:1,
            catalogo:1,
            bread2:'',
            bread3:'',
            }

        },
        methods:{
        listarSubcategorias(){
            let m=this;
            // m.listado=1;



             axios.get('/subcategoria/accesorios').then(function (response){
                    m.arraySubcategorias = response.data;
                  
                })
                .catch(function(error){
                    console.log(error);
                });

        },
        verProductos(id){
            let m=this;
            m.catalogo=2;
            // m.listado=2;

             axios.get('/productosSub?id='+id).then(function (response){
                    m.arrayProductos = response.data;
                  
                })
                .catch(function(error){
                    console.log(error);
                });


        },
        verProductoDetalle(id){
            let m=this;
            m.catalogo=3;

            // m.listado=3;

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

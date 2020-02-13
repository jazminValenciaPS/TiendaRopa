<template>
    <main>
        <div class="row contenedorCard" >
            <br>
            <div class="col s12">
                <div class="card medium col s4" v-for="producto in arrayProductos" :key="producto.idProducto">
                    <div class="card-image ">
                        <img :src="'img/'+producto.Imagen">
                    </div>
                    <div class="card-content">
                        <p> {{producto.NombreProducto}}</p>
                    </div>
                    <div class="card-action">
                        <a :href="'detalleProducto?id='+producto.id">Mostrar más.</a>
                        <!-- <a @click="verProductoDetalle(producto.id)">Mostrar más.</a> -->
                    </div>
                </div>
            </div>
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
            listado:1
            }

        },
        methods:{
       verProductos(id){
            let m=this;

             axios.get('/productosSub?id='+id).then(function (response){
                    m.arrayProductos = response.data;
                    console.table(m.arrayProductos);
                  
                })
                .catch(function(error){
                    console.log(error);
                });


        },
        
        },
        mounted() {
            this.verProductos();
        }
     }
    
</script>
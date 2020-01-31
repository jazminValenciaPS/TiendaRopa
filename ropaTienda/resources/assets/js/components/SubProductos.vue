<template>
<main class="main">

        <div class="row contenedorCard" v-if="listado==1">
            <div class="card medium" v-for="producto in arrayProducto" :key="producto.idPorducto">
                    <div class="card-image ">
                        <img :src="'img/'+producto.Imagen">
                    </div>
                    <div class="card-content">
                        <p> {{producto.Nombre}}</p>
                    </div>
                    <div class="card-action">
                        <a @click="verProductos(producto.idSubcat)">Mostrar más.</a>
                    </div>
            </div>
        </div>
        <div class="row contenedorCard" v-else-if="listado==2">
            <div class="row">
                <div class="s6">
                    <div class="card medium" v-for="producto in arrayProducto" :key="producto.idPorducto">
                    <div class="card-image ">
                        <img :src="'img/'+producto.Imagen">
                    </div>
                  </div>
                  <div class="s6">
                      <h2 v-text="producto.Nombre"></h2>
                      <h5 v-text="producto.Precio"></h5>

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
            arrayProductos:[],
            listado=1

            }

        },
        methods:{
        listarProductos(){
            let m=this;


             axios.get('/productos').then(function (response){
                    m.arrayProductos = response.data;
                  
                })
                .catch(function(error){
                    console.log(error);
                });

        },
        },
        mounted() {
            console.log('Component mounted.');
            this.listarProductos();
        }
     }
</script>
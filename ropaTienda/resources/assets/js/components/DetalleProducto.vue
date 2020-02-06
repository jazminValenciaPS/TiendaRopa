<template>
     <div class="row contenedorCard" >
            <br>
            <!-- <div  v-for="detalle in arrayDetalleProducto" :key="detalle.idPorducto">
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
            </div> -->
            <h2>Detalle del producto</h2>
        </div>
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
            var p=url.searchParams.get('id');
            console.log(p);


            //  axios.get('/subcategoria/accesorios').then(function (response){
            //         m.arraySubcategorias = response.data;
                  
            //     })
            //     .catch(function(error){
            //         console.log(error);
            //     });

        },
        
        },
        mounted() {
            this.listarSubcategorias();
        }
     }
 </script>

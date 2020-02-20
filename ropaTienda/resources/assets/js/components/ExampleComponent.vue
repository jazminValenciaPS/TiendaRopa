<template>
    <main class="main">
     <!-- Muestra los Sliders -->
     <br>
        <div class="row">
            <div class="col s12 contenedorCard">
                <br>
                <vueper-slides autoplay>
                    <vueper-slide  v-for="slider in arraySliders" :key="slider.id" :image="'img/'+slider.imagen"/>
                </vueper-slides>
            </div>
        </div>
       
     <!-- Termina muestra los Sliders -->
     <br>
    
        <div class="row ">
            <div class="col s1 l3 borde"></div>
            <div class="col s4 l3 right-align tamañoMedio" ><div class="textoArribos">Nuevos</div></div>
            <div class="col  s4 l3 tamañoMedio"><div class="textoArribos">productos</div></div>  
            <div class="col s1 l3 borde"></div>  
            <!-- <div class="col s1 l3 borde"></div>   -->

        </div>  

 <!-- Muestra de productos recientes -->

            <div class="row ">
                <div class="col s12 m12 l12 contenedorCard center" style="padding-left:200px;">
                     <!-- <div v-else-if="catalogo==2" class="col s12 l12" style="padding-left:200px;">
               <div style="margin-left:20px;" class="center card medium col s12 l3" v-for="producto in arrayProductos" :key="producto.idProducto">-->
                  
                    <div id="espacioCard" class="card medium col s12 l4 center" v-for="producto in arrayProductos" :key="producto.idProducto" > 
                        <div id="estiloImagenCard" class="card-image">
                            <img id="imagenCard" :src="'img/'+producto.Imagen">
                        </div>
                        <div id="DescripcionCard" class="responsive card-content">
                            <p class="col s12 l12">Nombre: {{producto.NombreProducto}}</p>
                            <p class="col s12 l12">Descripcion: {{producto.Descripcion}}</p>
                        </div>
                        <!-- <div class="card-action">
                        <a href="#">This is a link</a>
                        </div> -->
                    </div>
                </div>
            </div>
    </main>
</template>

<script>

import { VueperSlides, VueperSlide } from 'vueperslides'
import 'vueperslides/dist/vueperslides.css'


    export default {
        components: { VueperSlides, VueperSlide },
         data(){
            return{
                img: '',
                file:'',
                arraySliders:[],
                arrayProductos:[],
                catalogo:1,
            }
            },methods:{
              listarSliders(){
                let m=this;


                axios.get('/slider').then(function (response){
                    m.arraySliders = response.data;
                  
                 })
                 .catch(function(error){
                    console.log(error);
                 });

             },
             listarProductos(){
                let me=this;
                var url = '/productos/recientes'
                axios.get(url).then(function (response){
                    me.arrayProductos = response.data;
                  
                })
                .catch(function(error){
                    console.log(error);
                });
            }, 
            },
        mounted() {
            console.log('Component mounted.');
            this.listarSliders();
            this.listarProductos();
        }
     }


 </script>

 

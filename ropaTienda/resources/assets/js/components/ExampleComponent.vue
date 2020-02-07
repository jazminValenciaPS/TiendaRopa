<template>
    <main class="main">
     <!-- Muestra los Sliders -->
        <div class="container">
            <div class="row">
                <div class="col s12">    
                    <br>    
                    <div class="carousel carousel-slider center" id="carrucel-demo">
                        <a v-for="slider in arraySliders" :key="slider.id">
                            <img :src="'img/'+slider.imagen" class="responsive-img" >
                        </a>
                    </div>
                    <br>
                </div>
            </div>
        </div>         
     <!-- Termina muestra los Sliders -->
    
        <div class="row ">
            <div class="col s3 borde"></div>
            <div class="col s3 right-align tamañoMedio" ><div class="textoArribos">Nuevos</div></div>
            <div class="col h3 s3 tamañoMedio"><div class="textoArribos">arrivos</div></div>  
            <div class="col s3 borde"></div>  
        </div>  


        <div class="row contenedorCard">
            
            <div class="col s2 m4">
                <div class="card medium">
                    <div class="card-image ">
                        <img src="img/topAzul.jpg">
                    </div>
                    <div class="card-content">
                        <p>Lorem Ipsum es simplemente el texto de relleno de las imprentas y 
                        archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de 
                        las industrias desde el año 1500, cuando un impresor (N. del T. persona
                        que se dedica a la imprenta) desconocido usó una galería de textos.
                        </p>
                    </div>
                    <div class="card-action">
                        <a href="#">This is a link</a>
                    </div>
                </div>
            </div>


            <div class="col s2 m4">
                <div class="card medium">
                    <div class="card-image ">
                        <img src="img/topAzul.jpg">
                    </div>
                    <div class="card-content">   
                        <p>Lorem Ipsum Lorem Lorem  Melissa paolaes simplemente el texto de relleno de las imprentas y 
                        archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de 
                        las industrias desde el año 1500, cuando un impresor (N. del T. persona
                        que se dedica a la imprenta) desconocido usó una galería de textos.</p>
                    </div>
                    <div class="card-action">
                        <a href="#">Esto es un link</a>
                    </div>
                </div>
            </div> 

            <div class="col s2 m4 ">
                <div class="card medium ">
                    <div class="card-image ">
                        <img src="img/topAzul.jpg">
                    </div>
                    <div class="card-content">
                        <p>Lorem Ipsum es simplemente el texto de relleno de las imprentas y 
                        archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de 
                        las industrias desde el año 1500, cuando un impresor (N. del T. persona
                        que se dedica a la imprenta) desconocido usó una galería de textos.</p>
                    </div>
                    <div class="card-action">
                        <a href="#">This is a link</a>
                    </div>
                </div>
            </div>
        </div>
    </main>
</template>

<script>
//   document.addEventListener('DOMContentLoaded', function() {
//       var elems = document.querySelectorAll('.carousel');
    
//       var instances = M.Carousel.init(elems,
//     {
//           duration: 300,
//           indicators: true,
        
//           padding: 1,
        
//       }); 
//       autoplay();
//       function autoplay(){
//         setTimeout(autoplay, 2000);
//       }
//     });

        $(document).ready(function(){
        $('.carousel').carousel(
        {
            dist: 0,
            padding: 1,
            fullWidth: true,
            indicators: true,
            duration: 300,
        }
        );
        });

        autoplay()   
        function autoplay() {
            $('.carousel').carousel('next');
            setTimeout(autoplay, 1000);
        }

    export default {
         data(){
            return{
                img: '',
                file:'',
                arraySliders:[],
                arrayProductos:[]
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

             },
            },
        mounted() {
            console.log('Component mounted.');
            this.listarSliders();
        }
     }


 </script>

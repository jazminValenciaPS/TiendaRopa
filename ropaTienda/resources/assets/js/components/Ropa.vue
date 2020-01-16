<template>
    <main class="main">
        <div class="row productos">
            <div class="col s12">
                <div class="col s4 center">
                    <a href="#"><img class="tImagen" src="img/vestidos/vestido.jpg" ></a>
                        <h5><a  class="brown-text" href="#" >Vestidos</a></h5>
                </div>
                <div class="col s4 center">
                        <img class="tImagen" src="img/blusas/blusa.png" >
                        <h5><a class="brown-text" href="#" >blusas</a></h5>
                </div>
                <div class="col s4 center">
                    <a href="#"><img class="tImagen" src="img/pantalones/pantalones.jpg"></a>
                    <h5><a class="brown-text" href="#" >pantalones</a></h5>
                </div>                
            </div>
            <div class="col s12 center">
                <div class="col s4 ">
                    <a href="#"><img class="tImagen" src="img/faldas/falda.jpg" ></a>
                        <h5><a class="brown-text" href="#">Faldas</a></h5>
                </div>           
            </div>
        </div>
    </main>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
     }
 </script>

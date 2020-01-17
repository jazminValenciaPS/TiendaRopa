<template>
    <main class="main">
        <div class="row" :class="{'mostrar' : modal}" >
              <div class="col s12 center" >
                      <h3 v-text="tituloModal"></h3>

                        <form action="#">
                            <div class="file-field input-field">
                            <div class="btn">
                                <span>Imagen</span>
                                <input id="file" ref="filea" type="file" data-vv-scope="new"  v-on:change="seleccionarImagen(1)" class="sliderAlta">
                            </div>
                            <div class="file-path-wrapper">
                                <input class="file-path validate" type="text">
                            </div>
                            
                            
                            </div>
                        </form>
                                            
                           
                     </div>
                 </div>
                 <div class="row">
                 <div class="right col s2">
                      <a class="btn-floating btn-large waves-effect waves-light deep-orange lighten-4 right" @click="nuevoSlider()"><i class="brown-text material-icons">add</i></a>
                 </div>
             </div>

          

<div class="row">
    <div class="col s12">    
                <ul class="collection" v-for="slider in arraySliders" :key="slider.id">

                    <li class="collection-item avatar">
                    <img :src="'img/'+slider.img" alt="" class="circle">

                    <p class="center" v-text="slider.Nombre"><br>
                    </p>
                    <a href="#!" class="secondary-content"><i class="material-icons" @click="abrirModal('categoria','actualizar',slider)">create</i><i class="material-icons">delete</i></a>
                    </li>
                </ul>
                    </div>
                </div>

    </main>
</template>

<script>
    export default {
        data(){
            return{
                img: '',
                arraySliders:[],
                modal : 0,
                tituloModal : '' ,
                cambio : 0,
                file: ''
            }
        },
        methods:{
            listarSliders(){
             let m=this;


             axios.get('/slider').then(function (response){
                    m.arraySliders = response.data;
                  
                })
                .catch(function(error){
                    console.log(error);
                });

            },limpiar() {
            let me = this;
            me.errors.clear('new');
            me.errors.clear('update');
            
           
            me.img = '';
            me.Cambio = 0;
        },
            seleccionarImagen(img){
                if (img == 1) {            
                    this.file = this.$refs.filea.files[0];
                    readURL(document.getElementsByClassName("sliderAlta")[0], 1);
                }
                else {
                    this.file = this.$refs.filec.files[0];
                    readURL(document.getElementsByClassName("sliderEdit")[0], 2);
                }
                this.cambio = 1;

                function readURL(input, img) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();
                        reader.onload = function (e) {
                            if (img == 1) {
                                $('.imgAlta').attr('src', e.target.result);
                            }
                            else {
                                $('.imgCambio').attr('src', e.target.result);
                            }
                        };
                        reader.readAsDataURL(input.files[0]);
                    }
                }
            },
             nuevoSlider() {
            let me = this;

            //Validamos si la informacion modificada es correcta
            // me.$validator.validateAll('new').then(valid => {
            //     if (valid) {
                    let formData = new FormData();
                    formData.append('file', me.file);
                    
                    
                    //Registramos la informacion
                    axios.post('/slider/registrar', formData, {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    })
                    .then(function (response) {
                        me.listarSliders();
                        $('.modal.open').modal('close');
                        // var toastHTML = '<span>Slider Registrado Correctamente</span>';
                        // M.toast({ html: toastHTML, classes: 'rounded tos', displayLength: 1500 });
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
                //}
                // else {
                //     var toastHTML = '<span>Corrige la información e intente de nuevo</span>';
                //     M.toast({html: toastHTML, classes: 'rounded tos'});
                // }
            
        },
          
            cerrarModal(){
            this.modal=0;
            this.tituloModal='';
            this.img=''
            },

            abrirModal(modelo,accion, data = []){
                switch(modelo){
                    case "sliders":
                        {
                            switch(accion){
                                case 'registrar':
                                    {
                                        this.modal = 1;
                                        this.nombre = '';
                                        this.tituloModal = 'Registrar Sliders';
                                        break;

                                    }
                                case 'actualizar':
                                    {

                                    }
                            }

                        }
                }

            },
          
        },
        mounted(){
            this.listarSliders();
           

          
        }
     };    
 </script>
<style>

.mostrar{
    display: list-item !important;
    opacity: 1 !important;
    position: absolute !important;
    background-color: white !important;
}
</style>

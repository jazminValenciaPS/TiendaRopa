<template>
    <main class="main">

        <!-- Modal de Registrar/Actualizar Slider -->
            <div class="modal fade" tabindex="-1" :class="{'mostrar' : modal}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                            <h4 class="modal-title center" v-text="tituloModal"></h4>
                            <!-- <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
                            <span aria-hidden="true">×</span>
                            </button> -->
                            <div class="col s5 center">
                                         <img v-if="tipoAccion==2" :src="'img/'+img"  class="imagenEdit" alt="">
                                    </div>
                                <div class="form-group row">
                                    <div class="col s10 center">
                                        <div class="file-field input-field">
                                            <div class="waves-effect waves-light btn deep-orange lighten-4 brown-text">
                                                <span>Imagen</span>
                                                <input id="file" ref="filea"  type="file" data-vv-scope="new"  v-on:change="seleccionarImagen(1)" class="sliderAlta">
                                                <!-- <input id="file" ref="filec" v-if="tipoAccion==2" type="file" data-vv-scope="new"  v-on:change="seleccionarImagen(2)" class="sliderEdit"> -->

                                            </div>
                                            <div class="file-path-wrapper">
                                                <input class="file-path validate" type="text">
                                            </div>
                                        </div>
                                    </div> 
                                </div> 
                        <div class="modal-footer">
                            <button type="button" class="espacioButton waves-effect waves-light btn deep-orange lighten-4 brown-text" @click="cerrarModal()">Cerrar</button>
                            <button type="button" v-if="tipoAccion==1" class="espacioButton waves-effect waves-light btn deep-orange lighten-4 brown-text" @click="nuevoSlider()">Guardar</button>
                            <button type="button" v-if="tipoAccion==2" class="espacioButton waves-effect waves-light btn deep-orange lighten-4 brown-text" @click="actualizarSlider(id)">Actualizar</button>
                        </div>
                    </div>
             </div>  
        <!-- termina modal   -->

       
       
        <div class="row">
            <h3 class="center">Sliders</h3>

            <div class="right col s2">

                <a class="btn-floating btn-large waves-effect waves-light deep-orange lighten-4 right" @click="abrirModal('sliders','registrar')"><i class="brown-text material-icons">add</i></a>
                <!-- @click="nuevoSlider()" -->
            </div>
        </div>


        <div class="row contenedorCard centrado ">
            <div class="col s12 m6 ">

            <div class="card" v-for="slider in arraySliders" :key="slider.id">
                <div class="card-image small">
                 <img :src="'img/'+slider.imagen" >

                    <a  class="btn-floating halfway-fab waves-effect waves-light red" @click="abrirModal('sliders','actualizar',slider)"><i class="material-icons" >create</i></a>
                    <!-- <a  class="btn-floating halfway-fab waves-effect waves-light red"><i class="material-icons">delete</i></a> -->
                <!-- <a class="btn-floating halfway-fab waves-effect waves-light red"><i class="material-icons">add</i></a> -->
                </div>
                <div class="card-content">
                    <p></p>
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
                img: '',
                arraySliders:[],
                modal : 0,
                tituloModal : '' ,
                cambio : 0,
                tipoAccion : 0,
                id: 0,
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

            },
            limpiar() {
                let me = this;
                me.errors.clear('new');
                me.errors.clear('update');
                me.img = '';
                me.tipoAccion = 0;
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
                    me.cerrarModal();
                    me.limpiar();
                    // var toastHTML = '<span>Slider Registrado Correctamente</span>';
                    // M.toast({ html: toastHTML, classes: 'rounded tos', displayLength: 1500 });

                })
                .catch(function (error) {
                    console.log(error);
                });
                
                    
            },
            actualizarSlider(id){
            let me = this;

            let formData = new FormData();
            formData.append('file', me.file);
            formData.append('id',id);
      
            //Regresamos la informacion
            axios.post('/slider/actualizar', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })
            .then(function (response) {
                me.listarSliders();
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
                                        this.tipoAccion = 1;
                                        this.tituloModal = 'Registrar Sliders';
                                        break;

                                    }
                                case 'actualizar':
                                    {
                                        this.modal = 2;
                                        this.nombre = '';
                                        this.tipoAccion = 2;
                                        this.tituloModal = 'Actualizar Slider';
                                        this.id=data['id'];
                                        this.img=data['imagen'];
                                        break;
                                    }
                            }

                        }
                }

            },
            },
            cerrarModal(){
                this.modal=0;
                this.tituloModal='';
                this.img='';
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
                                        this.tipoAccion = 1;
                                        this.tituloModal = 'Registrar Sliders';
                                        break;

                                    }
                                case 'actualizar':
                                    {
                                        this.modal = 2;
                                        this.nombre = '';
                                        this.tipoAccion = 2;
                                        this.tituloModal = 'Actualizar Slider';
                                        this.id=data['id'];
                                        this.img=data['imagen'];

                                        break;
                                    }
                            }

                        }
                }

            },
          
        // },
        mounted(){
            this.listarSliders();
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
    height:560px !important;
     margin-left: 20% !important;
     margin-right: 30% ;
}
.espacioButton{
    margin-left: 10px !important;
}

</style>

<template>
    <main class="main">

        <!-- Modal de Registrar/Actualizar Slider -->
            <div class="modal fade" tabindex="-1" :class="{'mostrar' : modal}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                     <div  class = "container">
                        <h4 class="modal-title center" v-text="tituloModal"></h4>   
                        <div class="col s5 center">
                            <img v-if="tipoAccion==2" :src="'img/'+img"  class="imagenEdit" alt="">
                        </div>
                        <div class="form-group row">
                            <div class="col s10 center">
                                <div class="file-field input-field">
                                    <div class="waves-effect waves-light btn deep-orange lighten-4 brown-text">
                                        <span>Imagen</span>
                                        <input id="file" ref="filea"  type="file" data-vv-scope="new"  required="true" aria-required="true"  v-on:change="seleccionarImagen(1)" class="sliderAlta">
                                    </div>
                                    <div class="file-path-wrapper">
                                        <input class="file-path validate" type="text">
                                    </div>
                                </div>
                            </div> 
                        </div> 
                        <div v-show="errorSlider" class="form-group row div-error">
                                <div class="text-center text-error">
                                    <div v-for="error in errorMostrarMsjSlider" :key="error" v-text="error">

                                    </div>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" v-if="tipoAccion==1" class="espacioButton waves-effect waves-light btn deep-orange lighten-4 brown-text" @click="nuevoSlider()">Guardar</button>
                            <button type="button" v-if="tipoAccion==2" class="espacioButton waves-effect waves-light btn deep-orange lighten-4 brown-text" @click="actualizarSlider(id)">Actualizar</button>
                            <button type="button" class="espacioButton waves-effect waves-light btn deep-orange lighten-4 brown-text" @click="cerrarModal()">Cerrar</button>
                        </div>
                    </div>
                </div>
             </div>  
        <!-- termina modal   -->

       
       
       
         <div class="row">
                <div class="col s12 l12">
                    <h3 class="center">Sliders</h3>
                    <div class="right col s2 l4">
                        <a class="btn-floating btn-large waves-effect waves-light deep-orange lighten-4 right" @click="abrirModal('sliders','registrar')"><i class="brown-text material-icons">add</i></a>
                    </div>
                </div>
            </div>


        <div class="row">
            <div class="col s6 offset-s3">
                <div class="card " v-for="slider in arraySliders" :key="slider.id">
                    <div class="card-image small">
                        <img :src="'img/'+slider.imagen" >

                        <a  class="btn-floating halfway-fab waves-effect waves-light red" @click="abrirModal('sliders','actualizar',slider)"><i class="material-icons" >create</i></a>
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
                file: '',
                errorSlider:'',
                errorMostrarMsjSlider: [],

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
               $("#file").val("");

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
                //  if (this.validarSlider()){
                //     return;
                // }
                let me = this;
            // me.$validator.validateAll('new').then(valid => {
            //     if (valid) {
                //     let formData = new FormData();
                // formData.append('file', me.file);
                   
                    
                    //Regresamos la informacion
                //      axios.post('/slider/registrar', formData, {
                //     headers: {
                //         'Content-Type': 'multipart/form-data'
                //     }
                // })
                //     .then(function (response) {
                //     me.listarSliders();
                //     me.cerrarModal();
                //     me.limpiar();
                //     // var toastHTML = '<span>Slider Registrado Correctamente</span>';
                //     // M.toast({ html: toastHTML, classes: 'rounded tos', displayLength: 1500 });

                // })
                // .catch(function (error) {
                //     console.log(error);
                // });
            //     }
            //     else{
            //         var toastHTML = '<span>Corrige la información e intente de nuevo</span>';
            //         M.toast({html: toastHTML, classes: 'rounded tos fondo-baja'});
            //     }
            // });

//  me.$validator.validateAll('update').then(valid => {
//                 if (valid) {
//                     let formData = new FormData();
//                     if (me.Cambio == 1) {
//                         formData.append('file', me.file);
//                     }
//                     formData.append('ID', me.ID);
//                     formData.append('ID_Usuario', store.getters.getAuthUser);
//                     formData.append('Titulo', me.Titulo);
//                     formData.append('Cuerpo', me.Cuerpo);
//                     formData.append('Estado', me.Estado);
//                     formData.append('Cambio', me.Cambio);
                    
//                     //Regresamos la informacion
//                     axios.post('/Noticias/Actualizar', formData, {
//                         headers: {
//                             'Content-Type': 'multipart/form-data'
//                         }
//                     })
//                     .then(function (response) {
//                         me.listarNoticias(1,me.criterio,me.buscar,me.listadoEstatus);
//                         $('.modal.open').modal('close');
//                         var toastHTML = '<span>Información Actualizada Correctamente</span>';
//                         M.toast({html: toastHTML, classes: 'rounded tos fondo-alta', displayLength: 1500});
//                     })
//                     .catch(function (error) {
//                         console.log(error);
//                     });
//                 }
//                 else{
//                     var toastHTML = '<span>Corrige la información e intente de nuevo</span>';
//                     M.toast({html: toastHTML, classes: 'rounded tos fondo-baja'});
//                 }
//             });






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
                this.file='';

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
            validarSlider(){
                this.errorSlider=0;
                this.errorMostrarMsjSlider =[];

               
                if (!this.file ) this.errorMostrarMsjSlider.push("Se tiene que ingresar una imagen.");

                if (this.errorMostrarMsjSlider.length) this.errorSlider = 1;

                return this.errorSlider;
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
    max-height:560px !important;
     margin-left: 20% !important;
     margin-right: 30% ;
}
.espacioButton{
    margin-left: 10px !important;
}

</style>

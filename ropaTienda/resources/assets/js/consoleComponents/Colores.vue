<template>
    <main class="main">
       <!-- Modal de Registrar/Actualizar Slider -->
            <div class="modal fade" tabindex="-1" :class="{'mostrar' : modal}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                            <h4 class="modal-title center" v-text="tituloModal"></h4>
                                <div class="form-group row">
                                    <div class="col s10 center">
                                       
                                    </div> 
                                </div> 
                        <div class="modal-footer">
                            <button type="button" class="espacioButton waves-effect waves-light btn deep-orange lighten-4 brown-text" @click="cerrarModal()">Cerrar</button>
                            <button type="button" v-if="tipoAccion==1" class="espacioButton waves-effect waves-light btn deep-orange lighten-4 brown-text" @click="nuevoSlider()">Guardar</button>
                            <button type="button" v-if="tipoAccion==2" class="espacioButton waves-effect waves-light btn deep-orange lighten-4 brown-text" @click="actualizarSlider()">Actualizar</button>
                        </div>
                    </div>
             </div>  
       <!-- termina modal   -->

          
        <!-- <div class="row">
            <h3 class="center">Sliders</h3>

            <div class="right col s2">

                <a class="btn-floating btn-large waves-effect waves-light deep-orange lighten-4 right" @click="abrirModal('sliders','registrar')"><i class="brown-text material-icons">add</i></a>
                <!-- @click="nuevoSlider()" -->
            </div>
        </div> 
        
       <div class="row">
           <div class="col s5  center">
                <ul class="collection" v-for="color in arrayColores" :key="color.id">
                    <li class="collection-item" v-text="color.Nombre"></li>
                </ul>
           </div>
               
       </div>

    </main>

</template>
<script>
     export default {
          data(){
            return{
                nombre: '',
                arrayColores:[],
                modal : 0,
                tituloModal : '' ,
                cambio : 0,
                tipoAccion : 0,
                id: 0,
                errorColor : 0,
                errorMostrarMsjColor : [],
            }
        },
        methods:{
            listarColores(){
             let m=this;


             axios.get('/colores').then(function (response){
                    m.arrayColores = response.data;
                  
                })
                .catch(function(error){
                    console.log(error);
                });

            },
            limpiar() {
                let me = this;
                me.errors.clear('new');
                me.errors.clear('update');
                me.tipoAccion = 0;
                me.Cambio = 0;
                me.nombre="";
                
            },
           
            nuevoColor() {
                    // let me = this;
                            
                    //         //Registramos la informacion
                    //         axios.post('/slider/registrar', formData, {
                    //             headers: {
                    //                 'Content-Type': 'multipart/form-data'
                    //             }
                    //         })
                    //         .then(function (response) {
                    //             me.listarSliders();
                    //             me.cerrarModal();
                    //         })
                    //         .catch(function (error) {
                    //             console.log(error);
                    //         });

                if (this.validarColores()){
                    return;
                }
                
                let me = this;

                axios.post(this.ruta + '/colores/registrar',{
                    'Nombre': this.nombre,
                    
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarColores(); 
                }).catch(function (error) {
                    console.log(error);
                });
                      
                    
            },
            validarColores(){

                this.errorColor=0;
                this.errorMostrarMsjColor =[];

                if (!this.nombre) this.errorMostrarMsjColor.push("El nombre del color no puede estar vacío.");

                return this.errorColor;
            
            },
            actualizarSlider(){
                 let me = this;

                            let formData = new FormData();
                            formData.append('file', me.file);
                            formData.append('id',me.id);

                            
                            
                            //Registramos la informacion
                            axios.put('/slider/actualizar', formData, {
                                headers: {
                                    'Content-Type': 'multipart/form-data'
                                }
                            })
                            .then(function (response) {
                                me.listarSliders();
                                me.cerrarModal();
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


                // let me = this;
                // let formData = new FormData();
                // formData.append('file', me.file);
                // formData.append('slider_id',me.slider_id);
                
                
                // //Actualizar la informacion
                // axios.put('/slider/actualizar', formData, {
                //     headers: {
                //         'Content-Type': 'multipart/form-data'
                //     }
                // })
                // .then(function (response) {
                //     me.listarSliders();
                //     me.cerrarModal();
                    

                // })
                // .catch(function (error) {
                //     console.log(error);
                // });
                      
                    
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
        mounted(){
            this.listarColores();
        }
     };    
</script>
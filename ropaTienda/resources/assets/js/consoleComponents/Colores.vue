<template>
    <main class="main">
       <!-- Modal de Registrar Slider -->
            <div class="modal fade" tabindex="-1" :class="{'mostrar' : modal}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                            <h4 class="modal-title center" v-text="tituloModal"></h4>
                                <div class="form-group row">
                                    <div class="input-field col s10 center">
                                        <i class="material-icons prefix deep-orange-text text-lighten-4">color_lens</i>
                                        <input v-model="Nombre" id="Nombre" type="text" class="validate">
                                        <label for="Nombre">Nombre</label>
                                    </div> 
                                     <div v-show="errorColor" class="form-group row div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in errorMostrarMsjColor" :key="error" v-text="error">

                                        </div>
                                    </div>
                                </div>
                                </div> 
                        <div class="modal-footer">
                            <button type="button" class="espacioButton waves-effect waves-light btn deep-orange lighten-4 brown-text" @click="cerrarModal()">Cerrar</button>
                            <button type="button" v-if="tipoAccion==1" class="espacioButton waves-effect waves-light btn deep-orange lighten-4 brown-text" @click="nuevoColor()">Guardar</button>
                            <button type="button" v-if="tipoAccion==2" class="espacioButton waves-effect waves-light btn deep-orange lighten-4 brown-text" @click="actualizarColor()">Actualizar</button>
                        </div>
                    </div>
             </div>  
       <!-- termina modal   -->

       <div class="row">
           <div class="col s12">
            <h3 class="center">Color de ropa</h3>
            <div class="right col s2">
                <a class="btn-floating btn-large waves-effect waves-light deep-orange lighten-4 right" @click="abrirModal('color','registrar')"><i class="brown-text material-icons">add</i></a>
            </div>
           </div>

        <br>
           <div class="center col s12">
               <div class="centro col s5 ">
                    <ul class="collection " v-for="color in arrayColores" :key="color.id">
                        <li class="collection-item avatar">
                        <h5 v-text="color.Nombre"></h5>
                       <a href="#!" class="secondary-content">
                    <i class="material-icons brown-text  " @click="desactivarColor(color.id)">delete</i></a>
                    </li>
                    </ul>
               </div> 
           </div>   
       </div>

    </main>

</template>
<script>
import Swal from 'sweetalert2';
     export default {
          data(){
            return{
                Nombre: '',
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
                me.tipoAccion = 0;
                me.Cambio = 0;
                me.nombre= "";
                
            },   
            nuevoColor() {
                if (this.validarColores()){
                    return;
                }
                
                let me = this;
                axios.post('/colores/registrar',{
                    'Nombre': this.Nombre,
                    
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarColores(); 
                    me.limpiar();
                }).catch(function (error) {
                    console.log(error);
                });
                   
                    
            },
            validarColores(){

                this.errorColor=0;
                this.errorMostrarMsjColor =[];

                if (!this.Nombre) this.errorMostrarMsjColor.push("El nombre del color no puede estar vacío.");
                if (this.errorMostrarMsjColor.lenght) this.errorCategoria = 1;

                return this.errorColor;
            
            },
            actualizarColor(){
                if (this.validarColores()){
                    return;
                }
                 let me = this;

                            let formData = new FormData();
                            formData.append('Nombre', me.nombre);
                            formData.append('id',me.id);

                            
                            
                            //Registramos la informacion
                            axios.put('/colores/actualizar',{
                                
                            })
                            .then(function (response) {
                                me.listarColores();
                                me.cerrarModal();
                                me.limpiar();                    
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
                    case "color":
                        {
                            switch(accion){
                                case 'registrar':
                                    {
                                        this.modal = 1;
                                        this.nombre = '';
                                        this.tipoAccion = 1;
                                        this.tituloModal = 'Registrar Color';
                                        break;

                                    }
                                case 'actualizar':
                                    {
                                        this.modal = 2;
                                        this.nombre = '';
                                        this.tipoAccion = 2;
                                        this.tituloModal = 'Actualizar Color';
                                        this.id=data['id'];
                                        this.nombre=data['Nombre'];

                                        break;
                                    }
                            }
                       }
                }
            },      
            desactivarColor(id){
                Swal.fire({
                title: '¿Está seguro de desactivar este color?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar!',
                cancelButtonText: 'Cancelar',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
                }).then((result) => {
                if (result.value) {
                    let me = this;

                    axios.put('/colores/desactivar',{
                        'id': id
                    }).then(function (response) {
                        me.listarColores();
                        Swal.fire(
                        'Desactivado!',
                        'El color ha sido desactivado con éxito.',
                        'success'
                        )
                    }).catch(function (error) {
                        console.log(error);
                    });
                    
                    
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    
                }
                }) 






                // let me = this;

                // axios.put('/colores/desactivar',{
                //     'id': id
                // }).then(response => { 
                //      me.listarColores();  
                // })
                // .catch(error => {
                //     console.log(error.response)
                // });
                }
                }) 
            },
        },
        mounted(){
            this.listarColores();
        }
     };    
</script>
<style>
.div-error{
        display: flex;
        justify-content: center;
    }
    .text-error{
        color: red !important;
        font-weight: bold;
    }
</style>      }) 
            },
        },
        mounted(){
            this.listarColores();
        }
     };    
</script>
<style>
.div-error{
        display: flex;
        justify-content: center;
    }
    .text-error{
        color: red !important;
        font-weight: bold;
    }
</style>
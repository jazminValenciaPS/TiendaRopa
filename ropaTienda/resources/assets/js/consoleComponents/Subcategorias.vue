<template>
    <main class="main">

        <!-- Inicia modal agregar/actualizar subCategoria -->

            <div class="modal fade" tabindex="-1" :class="{'mostrar' : modal}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                  <div class="col s12">

                <h3 v-text="tituloModal"></h3>
                 <div  class="col s5 center">
                               <img  v-if="tipoAccion==2" :src="'img/'+imagenSub"  class="imagenEdit" alt="">
                         </div>
                    <div class="input-field ">
                        <!-- input para el nombre de la Sub categoria -->
                      
                        <input  id="nombre" type="text" v-model="NombreSub" class="validate">
                         <label class="activate" for="nombre">Nombre</label>

                        <br> 
                        <!-- select Sub categorias -->
                        <select name="LeaveType" class="browser-default" v-model="idCate">
                            <option value="" disabled selected>Selecciona la categoria</option>
                            <option value="1">Ropa</option>
                            <option value="2">Accesorios</option>
                            <option value="3">Cosmeticos</option>
                        </select> 
                        <br>
                        <!-- recoleccion de imagenes para la sub categoria -->       
                         <form action="#">
                            <div v-if="tipoAccion==1" class="file-field input-field">
                                <div class="btn deep-orange lighten-4">
                                    <span class="brown-text" >Imagen</span>
                                    <input id="file" ref="filea" type="file" data-vv-scope="new"  v-on:change="seleccionarImagen(1)" class="subCategoriaAlta">
                                </div>
                                <div class="file-path-wrapper">
                                    <input class="file-path validate" type="text">
                                </div>
                            </div>
                        </form>                          
                    </div>
            </div>
           <div v-show="errorSubcategoria" class="form-group row div-error">
                <div class="text-center text-error">
                    <div v-for="error in errorMostrarMsjSubcategoria" :key="error" v-text="error">

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a class=" espacioButton waves-effect waves-light btn deep-orange lighten-4 brown-text" v-if="tipoAccion==1"  @click="nuevaSubCategoria()">Guardar</a>
                <a class=" espacioButton waves-effect waves-light btn deep-orange lighten-4 brown-text" v-if="tipoAccion==2"  @click="actualizarSubCategorias(idSubCategorias)">Actualizar</a>

                <button type="button" class=" espacioButton btn btn-secondary deep-orange lighten-4 brown-text" @click="cerrarModal()">Cerrar</button>
            </div>
         </div>
       <!-- Termina modal  agregar/actualizar subCategoria-->

       <!-- Mostrar subcategoria -->

        <div class="row">
            <div class="col s12">  
                <h3 class="center">Sub categorias</h3>  
                <div class="right col s2">
                    <a class="btn-floating btn-large waves-effect waves-light deep-orange lighten-4 right" @click="abrirModal('subCategoria','registrar')"><i class="brown-text material-icons">add</i></a>
                </div>
            </div>
        </div>
               
        <div class="row">
                <ul class="collection col s12" v-for="subcategoria in arraySubcategoria" :key="subcategoria.idSubCategorias">
                    <li class="collection-item avatar">
                        <img :src="'img/'+subcategoria.imagenSub" class="circle">
                        <p v-text="subcategoria.NombreSub"></p>
                        <p>Categoría: {{ subcategoria.nombre }}</p>
                        <a class="secondary-content" v-if="subcategoria.Status == 1">
                            <i class="switch">
                                <label><input type="checkbox" checked="checked" name="status" v-model="subcategoria.Status" @click="desactivarSubCategorias(subcategoria.idSubCategorias)"><span class="lever"></span></label>
                            </i>
                            <i class="material-icons brown-text " @click="abrirModal('subCategoria','actualizar',subcategoria)">create</i>
                        </a>
                        <a class="secondary-content" v-if="subcategoria.Status == 0">
                            <i class="switch">
                                <label><input type="checkbox"  name="status" v-model="subcategoria.Status" @click="activarSubCategorias(subcategoria.idSubCategorias)"><span class="lever"></span></label>
                            </i>
                        <!-- </a>  
                         <a class="secondary-content"> -->
                            <i class="material-icons brown-text " @click="abrirModal('subCategoria','actualizar',subcategoria)">create</i>
                        </a>                      
                    </li>
                </ul>
        </div>
       <!-- Termina mostrar subcategoria -->
    
    </main>
</template>

<script>
import Swal from 'sweetalert2';

    export default {
        data(){
            return{
                idSubCategorias: 0,
                idCate: 0,
                NombreSub: '',
                nombreCat: '',
                status : true,
                arraySubcategoria:[],
                modal : 0,
                imagenSub: '',
                tituloModal : 'Registrar Sub Categorias' ,
                cambio : 0,
                tipoAccion: 0,
                file: '',
                errorSubcategoria : 0,
                errorMostrarMsjSubcategoria : [],
            }
        },
        methods: {
            listarSubCategorias(){
             let m=this;
             axios.get('/subcategoria').then(function (response){
                    m.arraySubcategoria = response.data;
                    m.status = response.status.data;
                    if(status == true){
                        status = 1
                    }else{
                        status = 0
                    }
                  
                })
                .catch(function(error){
                    console.log(error);
                });

            },
            limpiar() {
                let me = this;
                me.errors.clear('new');
                me.errors.clear('update');
                me.idSubCategorias=0;
                me.NombreSub= '';
                me.nombreCat= '';
                me.status = true;
                me.tipoAccion= 0;
                me.file= '';
                me.img = '';
                me.errorSubcategoria = 0;
                me.errorMostrarMsjSubcategoria = [];

                me.Cambio = 0;
            },
            seleccionarImagen(img){
                if (img == 1) {            
                    this.file = this.$refs.filea.files[0];
                    readURL(document.getElementsByClassName("subCategoriaAlta")[0], 1);
                }
                else {
                    this.file = this.$refs.filec.files[0];
                    readURL(document.getElementsByClassName("subCategoriaEdit")[0], 2);
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
            nuevaSubCategoria() {
                if (this.validarSubCategoria()){
                    return;
                }
                let me = this;

                //Validamos si la informacion modificada es correcta
                // me.$validator.validateAll('new').then(valid => {
                //     if (valid) {
                let formData = new FormData();
                formData.append('file', me.file);
                formData.append('idCate', me.idCate);
                formData.append('NombreSub', me.NombreSub);

                //Registramos la informacion
                axios.post('/subcategoria/registrar', formData, {
                    
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }

                })
                .then(function (response) {
                    me.cerrarModal();
                    me.listarSubCategorias();
                })
                .catch(function (error) {
                    console.log(error);
                });
            
            },
            cerrarModal(){
                this.modal=0;
                this.idCate="";
                this.NombreSub="";
                this.Status='1';
                this.tituloModal='';
		        this.errorSubcategoria=0;

            },
            abrirModal(modelo,accion, data = []){
                switch(modelo){
                    case "subCategoria":{
                        switch(accion){
                            case 'registrar':
                                {
                                    this.modal = 1;
                                    this.nombre = '';
                                    this.status = '';
                                    this.tipoAccion = 1;
                                    this.tituloModal = 'Registrar Sub categoria';
                                    break;

                                }
                            case 'actualizar':
                                {
                                    this.modal = 1;
                                    this.tipoAccion = 2;
                                    this.idSubCategorias = data['idSubCategorias']
                                    this.idCate = data['idCate'];
                                    this.NombreSub = data['NombreSub'];
                                    this.id= data['idSubCategorias'];
                                    this.imagenSub= data['imagenSub'];
                                    this.tituloModal = 'Actualizar Sub categoria';
                                    break;
                                }
                        }

                    }
                }

            },
            actualizarSubCategorias(id){
                let me = this;

                let formData = new FormData();

                formData.append('NombreSub', me.NombreSub);
                formData.append('idCate',me.idCate);
                formData.append('idSubCategorias',id);
                //Registramos la informacion
                axios.post('/subcategoria/actualizar',formData,{
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then(function (response) {
                    me.listarSubCategorias();
                    me.cerrarModal();
                    me.limpiar();                    
                })
                .catch(function (error) {
                    console.log(error);
                });      
            },
            desactivarSubCategorias(id){
                let me = this;
            
                Swal.fire({
                title: '¿Está seguro de desactivar esta Sub Categoria?',
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
 
                        axios.put('/subcategoria/desactivar',{
                            'id': id
                        }).then(function (response) {
                            Swal.fire(
                                'Desactivado!',
                                'la sub categoria ha sido desactivada con éxito.',
                                'success'
                            )
                          me.listarSubCategorias();

                        }).catch(function (error) {
                            console.log(error);
                        });                    
                    } else if  (
                            // Read more about handling dismissals
                            result.dismiss === Swal.DismissReason.cancel
                        ) {
                          me.listarSubCategorias();
                        
                    } 
                })
       
            },
            activarSubCategorias(id){

                let me = this;
            
                Swal.fire({
                title: '¿Está seguro de activar esta Sub Categoria?',
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
 
                        axios.put('/subcategoria/activar',{
                            'id': id
                        }).then(function (response) {
                            Swal.fire(
                                'Activado!',
                                'la sub categoria ha sido activada con éxito.',
                                'success'
                            )
                          me.listarSubCategorias();

                        }).catch(function (error) {
                            console.log(error);
                        });                    
                    } else if  (
                            // Read more about handling dismissals
                            result.dismiss === Swal.DismissReason.cancel
                        ) {
                          me.listarSubCategorias();
                        
                    } 
                })
       
            },
            validarSubCategoria(){
                this.errorSubcategoria=0;
                this.errorMostrarMsjSubcategoria =[];

                if (this.idCate==0) this.errorMostrarMsjSubcategoria.push("Seleccione una categoría.");
                if (!this.NombreSub) this.errorMostrarMsjSubcategoria.push("El nombre de la SubCategoría no puede estar vacío.");
                // if (!this.file) this.errorMostrarMsjSubcategoria.push("El stock del artículo debe ser un número y no puede estar vacío.");
                // if (!this.precio_venta) this.errorMostrarMsjSubcategoria.push("El precio venta del artículo debe ser un número y no puede estar vacío.");

                if (this.errorMostrarMsjSubcategoria.length) this.errorSubcategoria = 1;

                return this.errorSubcategoria;
            }

        },mounted(){
            this.listarSubCategorias();
          
        }
    };
</script>
<style>
    .mostrar{
        display: list-item !important;
        opacity: 1 !important; 
        position: absolute !important;
    }  
    .espacioButton{
        margin-left: 10px !important;
    }
</style>
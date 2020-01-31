<template>
    <main class="main">

        <!-- Inicia modal -->

            <div class="modal fade" tabindex="-1" :class="{'mostrar' : modal}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                  <div class="col s6">

                <h3 v-text="tituloModal"></h3>
                 <div  class="col s5 center">
                               <img  v-if="tipoAccion==2" :src="'img/'+imagenSub"  class="imagenEdit" alt="">
                         </div>
                    <div class="input-field">
                        <!-- input para el nombre de la Sub categoria -->
                        <input id="nombre" type="text" v-model="NombreSub" class="validate">
                         <label  for="nombre">Nombre</label>

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
          
            <div class="modal-footer">
                <a class=" espacioButton waves-effect waves-light btn deep-orange lighten-4 brown-text" v-if="tipoAccion==1"  @click="nuevaSubCategoria()">Guardar</a>
                <a class=" espacioButton waves-effect waves-light btn deep-orange lighten-4 brown-text" v-if="tipoAccion==2"  @click="actualizarSubCategorias()">Actualizar</a>

                <button type="button" class=" espacioButton btn btn-secondary deep-orange lighten-4 brown-text" @click="cerrarModal()">Cerrar</button>
            </div>
         </div>
       <!-- Termina modal  -->
      
        <div class="row">
            <div class="col s12">    
                <div class="row">
                    <div class="right col s2">
                        <a class="btn-floating btn-large waves-effect waves-light deep-orange lighten-4 right" @click="abrirModal('subCategoria','registrar')"><i class="brown-text material-icons">add</i></a>
                    </div>
                </div>
                <ul class="collection" v-for="subcategoria in arraySubcategoria" :key="subcategoria.idSubCategorias">
                    <li class="collection-item avatar">
                        <img :src="'img/'+subcategoria.imagenSub" class="circle">
                        <p v-text="subcategoria.NombreSub"></p>
                        <p v-text="subcategoria.NombreCategorias"></p>
                    <a href="#!" class="secondary-content">
                    <i class="material-icons brown-text " @click="abrirModal('subCategoria','actualizar',subcategoria)">create</i>
                    <i class="material-icons" @click="desactivarSubCategorias(subcategoria.idSubCategorias)">delete</i></a>
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
                idSubCategorias: 0,
                idCate: 0,
                NombreSub: '',
                status: '1',
                nombreCat: '',
                arraySubcategoria:[],
                modal : 0,
                imagenSub: '',
                tituloModal : 'Registrar Sub Categorias' ,
                cambio : 0,
                tipoAccion: 0,
                file: ''
            }
        },
        methods: {
            listarSubCategorias(){
             let m=this;
             axios.get('/subcategoria').then(function (response){
                    m.arraySubcategoria = response.data;
                  
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
                let me = this;

                //Validamos si la informacion modificada es correcta
                // me.$validator.validateAll('new').then(valid => {
                //     if (valid) {
                let formData = new FormData();
                formData.append('file', me.file);
                formData.append('idCate', me.idCate);
                formData.append('Nombre', me.Nombre);

                
                
                //Registramos la informacion
                axios.post('/subcategoria/registrar', formData, {
                    
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }

                })
                .then(function (response) {
                    me.cerrarModal();
                    me.listarSubCategorias();
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
                this.idCate=""
                this.Nombre="";
                this.Status='1';
                this.tituloModal='';
                this.imagenSub='nuevo '
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
                                    this.Nombre = data['Nombre'];
                                    this.id= data['idSubCategoria'];
                                    this.imagenSub= data['imagenSub'];
                                    this.tituloModal = 'Actualizar Sub categoria';
                                    break;
                                }
                        }

                    }
                }

            },
            desactivarSubCategorias(id){
                console.log(id)
                let me = this;

                axios.put('/subcategoria/desactivar',{
                    'id': id
                }).then(response => { 
                     me.listarSubCategorias();
                    console.log(response)
                })
                .catch(error => {
                    console.log(error.response)
                });
            },
            actualizarSubCategorias(){
                let me = this;

                let formData = new FormData();
                formData.append('file', me.file);
                formData.append('idSubCategorias', me.idSubCategorias)
                formData.append('idCate', me.idCate);
                formData.append('Nombre', me.Nombre);

                //Registramos la informacion
                axios.post('/subcategoria/actualizar', formData, {                
                    headers: {
                        'Content-Type': 'multipart/form-data',
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
            
        },
        mounted(){
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
<template>
    <main class="main">
        <div class="row" :class="{'mostrar' : modal}" >
            <div class="col s12 center" >
                <h3 v-text="tituloModal">Sub Categoria</h3>
                    <div class="input-field col s6">
                        <input  id="subcategoria" type="text" class="validate">
                        <label for="subcategoria">Nombre</label>
                    </div>
                    <div class="form-group row">
                        <div class="input-field col s6">
                            <select class="form-control col-md-3" v-model="criterio">
                                <option value="Ropa">Ropa</option>
                                <option value="Accesorios">Accesorios</option>
                                <option value="Cosmticos">Cosméticos</option>
                            </select>
                            <label>Seleccione la categoría</label>
                        </div>   
                    </div> 
            </div>
        </div>
        <div class="row">
            <div class="right col s2">
                <a class="btn-floating btn-large waves-effect waves-light deep-orange lighten-4 right" @click="abrirModal('subcategoria','registrar')"><i class="brown-text material-icons">add</i></a>
            </div>
        </div>

        <div class="row">
            <div class="col s12">    
                <ul class="collection" v-for="subcategoria in arraySubcategoria" :key="subcategoria.id">

                    <li class="collection-item avatar">
                        <img src="img/topAzul.jpg" alt="" class="circle">

                        <p class="center" v-text="subcategoria.Nombre"><br>
                        </p>
                        <a href="#!" class="secondary-content"><i class="material-icons" @click="abrirModal('categoria','actualizar',subcategoria)">create</i><i class="material-icons">delete</i></a>
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

                nombre: '',
                arraySubcategoria:[],
                modal : 0,
                tituloModal : '',
                pagination: {
                   " total" : 0,
                    'current_page' : 0,
                    'per_page' : 0,
                    'last_page' : 0,
                    'from' : 0,
                    'to' : 0,
                },
                offset: 3,
                criterio: '',
                buscar: ''
            }
                
        },
        computed:{
            isActived: function(){
                return this.pagination.current_page;
            },
            //Calcula los elementos de la paginación
            pagesNumber: function() {
                if(!this.pagination.to) {
                    return [];
                }
                
                var from = this.pagination.current_page - this.offset; 
                if(from < 1) {
                    from = 1;
                }

                var to = from + (this.offset * 2); 
                if(to >= this.pagination.last_page){
                    to = this.pagination.last_page;
                }  

                var pagesArray = [];
                while(from <= to) {
                    pagesArray.push(from);
                    from++;
                }
                return pagesArray;             

            }
        },
        methods:{
            listarSubcategoria(page,buscar,criterio){
              let me=this;
                var url= 'subcategoria/?page=' + page + '&buscar='+ buscar + '&criterio='+ criterio;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.arrayPersona = respuesta.personas.data;
                    me.pagination= respuesta.pagination;
            })
            .catch(function(error){
                console.log(error);
            });

            },
            registrarSubcategoria(){

            },
            abrirModal(modelo,accion, data = []){
                switch(modelo){
                    case "subcategoria":
                        {
                            switch(accion){
                                case 'registrar':
                                    {
                                        this.modal = 1;
                                        this.nombre = '';
                                        this.tituloModal = 'Registrar Subcategoria';
                                        break;

                                    }
                                case 'actualizar':
                                    {

                                    }
                            }

                        }
                }

            }
          
        },
        mounted() {
            this.listarPersona(1,this.buscar,this.criterio);
          
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

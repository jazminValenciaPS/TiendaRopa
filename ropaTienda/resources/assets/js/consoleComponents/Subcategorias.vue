<template>
    <main class="main">
        <div class="row" :class="{'mostrar' : modal}" >
              <div class="col s12 center" >
                      <h3 v-text="tituloModal"></h3>
                    
                        <div class="input-field col s6">
                        <input  id="subcategoria" type="text" class="validate">
                        <label for="subcategoria">Nombre</label>
                        </div>
                         <div class="input-field col s6">
                             <select>
                                 <option value="1">Ropa</option>
                                 <option value="2">Accesorios</option>
                                 <option value="3">Cosméticos</option>
                             </select>
                            <label>Seleccione la categoría</label>
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
     <!-- <tbody>
 <tr v-for="subcategoria in arraySubcategoria" :key="subcategoria.id">
         <td v-text="subcategoria.nombre">

         </td>
         <td>
                    <a href="#!" class="secondary-content"><i class="material-icons" @click="abrirModal('categoria','actualizar',subcategoria)">create</i><i class="material-icons">delete</i></a>

         </td>
     </tr>
     </tbody> -->
    
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
                tituloModal : '' 
            }
        },
        methods:{
            listarSubcategoria(){
             let m=this;
            axios.get('/subcategoria').then(function (response){
                m.arraySubcategoria = response.data;
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

            },
          
        },
        mounted() {
            this.listarSubcategoria();
        }
     };

        document.addEventListener('DOMContentLoaded', function() {
            var elems = document.querySelectorAll('select');
            var instances = M.FormSelect.init(elems);
        });

 
      
 </script>
<style>

.mostrar{
    display: list-item !important;
    opacity: 1 !important;
    position: absolute !important;
    background-color: white !important;
}
</style>

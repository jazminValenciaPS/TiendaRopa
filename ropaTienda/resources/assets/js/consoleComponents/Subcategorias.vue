

<template>
    <main class="main">
        <div class="row" :class="{'mostrar' : modal}" >
            <div class="col s6">
                    <div class="input-field">
                        <input  id="subcategoria" type="text" class="validate">
                        <label for="subcategoria">Nombre</label>

                        <select name="LeaveType" @change="onChange($event)" class="browser-default" v-model="key">
                            <option value="" disabled selected>Selecciona la categoria</option>
                            <option value="1">Ropa</option>
                            <option value="2">Accesorios</option>
                            <option value="3">Cosmeticos</option>
                        </select>  
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
                    </li>

                     <p class="center" v-text="subcategoria.Nombre"><br></p>
                    <a href="#!" class="secondary-content">
                    <i class="material-icons" @click="abrirModal('categoria','actualizar',subcategoria)">create</i>
                    <i class="material-icons">delete</i></a>
                </ul>

            </div>
        </div>
    </main>
</template>

<script>
    export default {
        data(){
            return{
                key: "",
                nombre: '',
                arraySubcategoria:[],
                modal : 0,
            }
        },
        methods: {
            onChange(event) {
                console.log(event.target.value)
            }
        }
    }
</script>
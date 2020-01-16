@extends('consolaPrincipal')
@section('consola')
    <template v-if="menu==0">
    <h3>Altas y bajas de sliders</h3>

    </template>
    <template v-if="menu==1">
    <h3>Altas y bajas de colores</h3>
    </template>
    <template v-if="menu==2">
   <subcategorias-component></subcategorias-component>

    </template>
    <template v-if="menu==3">
    <h3>Altas y bajas de productos</h3>
    </template>
@endsection

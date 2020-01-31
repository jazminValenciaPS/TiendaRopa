@extends('consolaPrincipal')
@section('consola')
    <template v-if="menu==0">
    <sliders-component></sliders-component>
    </template>
    <template v-if="menu==1">
    <colores-component></colores-component>

    </template>
    <template v-if="menu==2">
    <!-- <h3>Altas y bajas de Sub Cartegorias</h3> -->
    <subcategorias-component></subcategorias-component>

    </template>
    <template v-if="menu==3">
    <productos-component></productos-component>
    </template>
@endsection

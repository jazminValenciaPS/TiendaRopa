@extends('principal')
@section('contenido')
    <template v-if="menu==0">
    <example-component></example-component>
    </template>
    <template v-if="menu==1">
        <ropa-component></ropa-component>
    </template>
    <template v-if="menu==2">
        <accesorios-component><accesorios-component>
    </template>
    <template v-if="menu==3">
        <cosmeticos-component><cosmeticos-component>
    </template>
@endsection

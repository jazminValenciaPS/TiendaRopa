@extends('principal')
@section('contenido')
    <template v-if="menu==0">
    <h1>Melisssa</h1>
    <example-component></example-component>
    </template>
    <template v-if="menu==1">
        <h1>menu1 </h1>
    </template>
    <template v-if="menu==2">
        <h1>menu 2</h1>
    </template>
    <template v-if="menu==3">
        <h1>menu 3</h1>
    </template>
@endsection

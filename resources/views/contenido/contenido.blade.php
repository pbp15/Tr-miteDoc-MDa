 @extends('principal')
 @section('contenido')
 <!-- Contenido Principal -->
        <template  v-if="menu==0">
            <h1>Contenido del menú 0</h1>
        </template>
       
        <template  v-if="menu==1">
            <oficina></oficina>
        </template>

        <template  v-if="menu==2">
            <h1>Contenido Nº3 </h1>
        </template>

        <template  v-if="menu==3">
            <h1>Contenido Nº3 </h1>
        </template>

        <template  v-if="menu==4">
            <h1>Contenido Nº4 </h1>
        </template>

        <template  v-if="menu==5">
            <expediente></expediente>
        </template>

        <template  v-if="menu==6">
            <h1>Contenido Nº6 </h1>
        </template>

        <template  v-if="menu==7">
            <h1>Contenido Nº7 </h1>
        </template>

        <template  v-if="menu==8">
            <h1>Contenido Nº8 </h1>
        </template>

        <template  v-if="menu==9">
            <h1>Contenido Nº9 </h1>
        </template>

        <template  v-if="menu==10">
            <h1>Contenido Nº10 </h1>
        </template>

        <template  v-if="menu==11">
            <h1>Contenido Nº11 </h1>
        </template>

        <template  v-if="menu==12">
            <h1>Contenido Nº12 </h1>
        </template>
<!-- /Fin del contenido principal -->

@endsection 
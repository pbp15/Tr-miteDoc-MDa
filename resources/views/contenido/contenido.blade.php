 @extends('principal')
 @section('contenido')

    @if(Auth::check())
            @if(Auth::user()->idrol == 1)
                
                            <!-- Contenido Principal -->
                            <template  v-if="menu==0">
                                <h1>Escritorio</h1>           
                            </template>

                            <template  v-if="menu==1">
                                <categoria></categoria>
                            </template>

                            <template  v-if="menu==2">
                             <contacto></contacto>
                            </template>

                            <template  v-if="menu==3">
                                <persona></persona>
                            </template>

                            <template  v-if="menu==4">
                                <rol></rol>
                            </template>

                            <template  v-if="menu==5">
                                <user></user>
                            </template>

                            <template  v-if="menu==6">
                            </template>

                            <template  v-if="menu==7">
                                <evento></evento>
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
                            <template  v-if="menu==13">
                           
                            </template>
                            <!-- /Fin del contenido principal -->
            
            @elseif (Auth::user()->idrol == 2)
                    <!-- Contenido Principal -->
                    <template  v-if="menu==0">
                        <h1>Escritorio</h1>           
                    </template>
                    <template  v-if="menu==1">
                    </template>   

                    <template  v-if="menu==5">
                    </template>

                    <template  v-if="menu==6">
                    </template>

            
            <!-- /Fin del contenido principal -->
            @elseif (Auth::user()->idrol == 3)
                    <!-- Contenido Principal -->
                    <template  v-if="menu==0">
                        <h1>Escritorio</h1>           
                    </template>

                    <template  v-if="menu==5">
                    </template>

                    <template  v-if="menu==6">
                    </template>
            
            @elseif (Auth::user()->idrol == 4)
                    <template  v-if="menu==0">
                        <h1>Escritorio</h1>           
                    </template>

                    <template  v-if="menu==5">
                    </template>

                    <template  v-if="menu==6">
                    </template>
            @else

      @endif

    @endif


@endsection 
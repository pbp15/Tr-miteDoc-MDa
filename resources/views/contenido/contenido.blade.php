 @extends('principal')
 @section('contenido')


    @if(Auth::check())
            @if(Auth::user()->idrol == 1)
                
                            <!-- Contenido Principal -->
                            <template  v-if="menu==0">
                                <h1>Escritorio</h1>           
                            </template>

                            <template  v-if="menu==1">
                                <oficina></oficina>
                            </template>

                            <template  v-if="menu==2">
                                <user></user>
                            </template>

                            <template  v-if="menu==3">
                                <h1>Contenido Nº3 </h1>
                            </template>

                            <template  v-if="menu==4">
                                <rol></rol>
                            </template>

                            <template  v-if="menu==5">
                                <expediente></expediente>
                            </template>

                            <template  v-if="menu==6">
                                <usuarioexpediente></usuarioexpediente>
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
                            <template  v-if="menu==13">
                                <persona></persona>
                            </template>
                            <!-- /Fin del contenido principal -->
            
            @elseif (Auth::user()->idrol == 2)
                    <!-- Contenido Principal -->
                    <template  v-if="menu==0">
                        <h1>Escritorio</h1>           
                    </template>
                    <template  v-if="menu==1">
                        <oficina></oficina>
                    </template>   

                    <template  v-if="menu==5">
                        <expediente></expediente>
                    </template>

                    <template  v-if="menu==6">
                        <usuarioexpediente></usuarioexpediente>
                    </template>

            
            <!-- /Fin del contenido principal -->
            @elseif (Auth::user()->idrol == 3)
                    <!-- Contenido Principal -->
                    <template  v-if="menu==0">
                        <h1>Escritorio</h1>           
                    </template>

                    <template  v-if="menu==5">
                        <expediente></expediente>
                    </template>

                    <template  v-if="menu==6">
                        <usuarioexpediente></usuarioexpediente>
                    </template>
            
            @elseif (Auth::user()->idrol == 4)
                    <template  v-if="menu==0">
                        <h1>Escritorio</h1>           
                    </template>

                    <template  v-if="menu==5">
                        <expediente></expediente>
                    </template>

                    <template  v-if="menu==6">
                        <usuarioexpediente></usuarioexpediente>
                    </template>
            @else

      @endif

    @endif


@endsection 

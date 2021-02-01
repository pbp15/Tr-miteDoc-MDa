 @extends('principal')
 @section('contenido')

    @if(Auth::check())
            @if(Auth::user()->idrol == 1)
            
                            <!-- Contenido Principal -->
                            <template  v-if="menu==0">
                              
                            </template>

                            <template  v-if="menu==1">
                                <categoria></categoria>
                            </template>

                            <template  v-if="menu==2">
                                   <blog></blog>
                            </template>

                            <template  v-if="menu==3">
                                <evento></evento>
                            </template>

                            <template  v-if="menu==4">
                                <noticia></noticia>
                            </template>

                            <template  v-if="menu==5">
                                <comunicado></comunicado>
                            </template>

                            <template  v-if="menu==6">
                                <testimonio></testimonio>
                            </template>

                            <template  v-if="menu==7">
                                <profesor></profesor>
                            </template>

                            <template  v-if="menu==8">
                                <contacto></contacto>
                            </template>

                            <template  v-if="menu==9">
                                <admision></admision>
                            </template>

                            <template  v-if="menu==10">
                                  <persona></persona> 
                            </template>

                            <template  v-if="menu==11">
                               <rol></rol> 
                            </template>

                            <template  v-if="menu==12">
                                <user></user> 
                            </template>
                            <template  v-if="menu==13">
                                <h1>INSTITUCION</h1>
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
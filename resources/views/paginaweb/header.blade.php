<div class="bg-top navbar-light  " >

    <div class="container"  >       
        <div class="row no-gutters d-flex align-items-center align-items-stretch">            
            <div class="col-md-5  d-flex align-items-center py-4">
                <img src="images/log1.jpg" class="ml-2" alt="logo eisntein" width="100px">

                <a class="navbar-brand ml-3" href="#">Einstein - Tarma <span>Institución Educativa Particular </span></a>
            </div>
            <div class="col-md-7  d-block pl-4" >
                <div class="row d-flex">
                    <div class="col-md d-flex topper align-items-center align-items-stretch  py-md-4 mt-4">
                        <div class="icon d-flex justify-content-center align-items-center"><span class="icon-paper-plane"></span>
                        </div>
                        <div class="text">                       
                            <h4><strong>Email</strong></h4>
                            <h6>einstenTarma10@gmail.com</h6>
                        </div>
                    </div>
                    <div class="col-md col-sm-12 d-flex topper align-items-center align-items-stretch py-md-4 mt-4" >
                        <div class="icon d-flex justify-content-center align-items-center"><span class="icon-phone2"></span></div>
                        <div class="text">
                            <h4><strong>Teléfono</strong></h4>
                            <h5>(064)- 322660</h5>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container d-flex align-items-center px-4">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
            aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> Menu
        </button>
    
        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active"><a href="{{route('page')}}" class="nav-link pl-0">Inicio</a></li>
                <li class="nav-item dropdown"><a href="#" class="nav-link">Quienes Somos</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{route('bienvenida')}}">Bienvenida</a></li>
                        <li><a class="dropdown-item" href="{{route('historia')}}">Nuestra Historia</a></li>
                        <li><a class="dropdown-item" href="{{route('vision-mision')}}">Visión y Misión</a></li>
                      </ul>
                </li>
                <li class="nav-item dropdown"><a href="#" class="nav-link">Que ofrecemos</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{route('propuesta')}}">Nuestra Propuesta</a></li>
                        <li><a class="dropdown-item" href="{{route('metodologia')}}">Metodología de Enseñanza</a></li>
                        <li><a class="dropdown-item" href="{{route('niveles')}}">Niveles Educativos</a></li>
                        <li><a class="dropdown-item" href="{{route('servicios')}}">Servicios</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown"><a href="" class="nav-link"> Comunidad </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{route('eventos')}}">Eventos</a></li>
                        <li><a class="dropdown-item" href="{{route('testimonios')}}">Testimonios</a></li>
                        <li><a class="dropdown-item" href="{{route('noticias')}}">Noticias</a></li>
                        <li><a class="dropdown-item" href="{{route('blogs')}}">Blogs</a></li>
                      </ul>
                
                </li>
                <li class="nav-item dropdown"><a href="#" class="nav-link"> Admisión 2021 </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{route('ficha')}}">Ficha de Inscripción</a></li>
                        <li><a class="dropdown-item" href="{{route('requisitos')}}">Requisitos Matricula </a></li>
                        <li><a class="dropdown-item" href="{{route('admision')}}">Admision</a></li>
                      </ul>                
                </li>
             
                <li class="nav-item dropdown"><a href="{{route('defect')}}" class="nav-link">Intranet</a></li>
                <li class="nav-item dropdown"><a href="{{route('contactanos')}}" class="nav-link">Contactanos</a></li>
        
            </ul>
        </div>
    </div>
</nav>



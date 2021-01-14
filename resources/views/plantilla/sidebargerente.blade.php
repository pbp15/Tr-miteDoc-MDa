<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li @click="menu=0" class="nav-item">
                <a class="nav-link active" href="#"><i class="icon-speedometer"></i> Inicio de Trámite</a>
            </li>
            <li class="nav-title">
                Mesa de Partes Virtual 
            </li>
         
            <li @click="menu=11" class="nav-item">
                <a class="nav-link" href="#"><i class="icon-book-open"></i> Ayuda <span class="badge badge-danger">PDF</span></a>
            </li>
            <li @click="menu=12" class="nav-item">
                <a class="nav-link" href="#"><i class="icon-info"></i> Acerca de...<span class="badge badge-info">IT</span></a>
            </li>
      
        </ul>
    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>
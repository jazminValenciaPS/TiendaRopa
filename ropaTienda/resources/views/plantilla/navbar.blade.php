
<nav class=" deep-orange lighten-4 responsive"> 
    <div class=" fixed finish nav-wrapper  ">
    <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons brown-text">menu</i></a>
        <ul id="nav-mobile " class=" hide-on-med-and-down ">
            <li class="centerText right" @click="menu=0" ><a class="black-text"  href="/#">Inicio</a></li>
            <li class="centerText right"  @click="menu=1"><a class="black-text" href="/#">Ropa</a></li>
            <li class="centerText right"  @click="menu=2"><a class="black-text" href="/#">Accesorios</a></li>
            <li class="centerText right"  @click="menu=3"><a class="black-text" href="/#">Cosméticos</a></li>
        </ul>
    </div>      
</nav>


<ul class="sidenav left" id="mobile-demo">
            <li><img class="logoNav  centro" src="img/algoPrecioso.png" alt=""></li>
            <li class="centerText" @click="menu=0" ><a class="black-text"  href="#">Inicio </a></li>
            <li class="centerText"  @click="menu=1"><a class="black-text" href="#">Ropa</a></li>
            <li class="centerText"  @click="menu=2"><a class="black-text" href="#">Accesorios</a></li>
            <li class="centerText"  @click="menu=3"><a class="black-text" href="#">Cosméticos</a></li>
  </ul>

<!-- 
<nav class="menuCentradoConsola deep-orange lighten-4 "> 
    <div class=" fixed finish nav-wrapper  ">
    <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
        <ul id="nav-mobile " class=" hide-on-med-and-down ">
            <li><img class="logoNav centerTextConsola" src="img/algoPrecioso.png" alt=""></li>
            <li class="centerTextConsola" @click="menu=0" ><a class="black-text"  href="#">Sliders </a></li>
            <li class="centerTextConsola"  @click="menu=1"><a class="black-text" href="#">Color ropa</a></li>
            <li class="centerTextConsola"  @click="menu=2"><a class="black-text" href="#">Subcategorias</a></li>
            <li class="centerTextConsola"  @click="menu=3"><a class="black-text" href="#">Productos</a></li>
            <li class="centerTextConsola" >
            <a class="black-text" href="{{ route('logout')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Cerrar Sesión</a>
            </li>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" >
            {{ csrf_field() }}
            </form>
        </ul>
    </div>      
</nav>

<ul class="sidenav" id="mobile-demo">
            <li><img class="logoNav centerTextConsola" src="img/algoPrecioso.png" alt=""></li>
            <li class="centerTextConsola" @click="menu=0" ><a class="black-text"  href="#">Sliders </a></li>
            <li class="centerTextConsola"  @click="menu=1"><a class="black-text" href="#">Color ropa</a></li>
            <li class="centerTextConsola"  @click="menu=2"><a class="black-text" href="#">Subcategorias</a></li>
            <li class="centerTextConsola"  @click="menu=3"><a class="black-text" href="#">Productos</a></li>
            <li class="centerTextConsola" >
            <a class="black-text" href="{{ route('logout')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Cerrar Sesión</a>
            </li>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" >
            {{ csrf_field() }}
            </form>
  </ul> -->

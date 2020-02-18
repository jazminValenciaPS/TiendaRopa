
<!-- Navbar de la pantalla principal -->
<nav class=" deep-orange lighten-4 responsive"> 
    <div class=" fixed finish nav-wrapper  ">
    <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons brown-text">menu</i></a>
        <ul id="nav-mobile " class="menuCentrado hide-on-med-and-down ">
        <li class="centerText right"  @click="menu=3"><a class="black-text" href="/#">Cosméticos</a></li>
            <li class="centerText right"  @click="menu=2"><a class="black-text" href="/#">Accesorios</a></li>
            <li class="centerText right"  @click="menu=1"><a class="black-text" href="/#">Ropa</a></li>
            <li class="centerText right" @click="menu=0" ><a class="black-text"  href="/#">Inicio</a></li>

        </ul>
    </div>      
</nav>


<ul class="sidenav left" id="mobile-demo">
            <li><img class="logoNav  centro" src="img/LogoMW.png" alt=""></li>
            <li class="centerText" @click="menu=0" ><a class="black-text"  href="#">Inicio </a></li>
            <li class="centerText"  @click="menu=1"><a class="black-text" href="#">Ropa</a></li>
            <li class="centerText"  @click="menu=2"><a class="black-text" href="#">Accesorios</a></li>
            <li class="centerText"  @click="menu=3"><a class="black-text" href="#">Cosméticos</a></li>
  </ul>

<!DOCTYPE html>
<html>
  <head>
      <!--Import Google Icon Font-->
      
      <!--Import materialize.css-->
      <link rel="stylesheet" href='css/plantilla.css' >

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      <meta name="csrf-token" content="{{ csrf_token()  }}">
        <!-- Styles -->
      <style>
       
       
      </style>
   </head>
  
   <body>
     <div id="app">
       <div class="row">
         <div class="col s12 m12 l12 center">
           <img class="tLogo" src="img/algoPrecioso.png" alt="">
         </div>
       </div>
       @include('plantilla.navbar')      

       <!--Inicia Contenido Principal-->
         @yield('contenido')
       <!--Termina Contenido Principal-->
     </div>

      <footer class="page-footer deep-orange lighten-4">
        <div class="container">
          <div class="row">
            <div class="col l6 s12">
              <h5 class="black-text" >Footer Content</h5>
              <p class="black-text" >You can use rows and columns to organize your footer content.</p>
            </div>
            <div class="col l4 offset-l2 s12">
              <h5 class="black-text">Links</h5>
              <ul>
                <li><a class="black-text " href="#!">Link 1</a></li>
                <li><a class="black-text " href="#!">Link 2</a></li>
                <li><a class="black-text " href="#!">Link 3</a></li>
                <li><a class="black-text" href="#!">Link 4</a></li>
              </ul>
            </div>
          </div>
        </div>
        <div class="footer-copyright deep-orange lighten-3">
          <div class="container brown-text">
          © 2014 Copyright Text
          <a class="brown-text right" href="#!">More Links</a>
          </div>
        </div>
      </footer>
      
     
      <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
      <script src="js/plantilla.js"></script>
      <script src="js/app.js"></script>

   </body>
</html>

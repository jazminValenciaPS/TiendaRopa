<!DOCTYPE html>
<html>
  <head>
      <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
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
  
       @include('plantilla.consolaNavbar')      
        
       <!--Inicia Contenido Principal-->
         @yield('consola')
       <!--Termina Contenido Principal-->
     </div>

      <footer class="page-footer deep-orange lighten-4">
       
          <div class="container brown-text">
          © 2014 Copyright Text
          <a class="brown-text right" href="#!">More Links</a>
          </div>
    
      </footer>
      
     
      <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
      <script src="js/plantilla.js"></script>
      <script src="js/app.js"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

      
   <script>
      document.addEventListener('DOMContentLoaded', function() {
            var elems = document.querySelectorAll('select');
            var instances = M.FormSelect.init(elems);
        });
 
   </script>

   </body>
</html>

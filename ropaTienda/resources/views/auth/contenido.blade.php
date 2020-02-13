
<!DOCTYPE html>
<html>
  <head>
    <!--Import Google Icon Font-->
      
    <!--Import materialize.css-->
    <link rel="stylesheet" href='css/plantilla.css' >


    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="csrf-token" content="{{ csrf_token()  }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- <script src="sweetalert2.min.js"></script> -->
    <!-- <link rel="stylesheet" href="sweetalert2.min.css"> -->
   </head>
  
   <body class="login">

   <div class="col s12">
    <div class="row">
     <div class="center">
       <img class="responsive" src="img/algoPrecioso.png">
     </div>
    </div>

    @yield('login')

  </div>



      
     
      <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
      <script src="js/plantilla.js"></script>
      

   </body>
</html>

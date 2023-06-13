<?php

/*=============================================
Iniciar variables de sesión
=============================================*/

ob_start();
session_start();

/*=============================================
Variable Path
=============================================*/

$path = TemplateController::path();

/*=============================================
Capturar las rutas de la URL
=============================================*/

$routesArray = explode("/",$_SERVER["REQUEST_URI"]);
array_shift($routesArray);

foreach ($routesArray as $key => $value) {
  $routesArray[$key] = explode("?",$value)[0];
}


/*=============================================
Solicitud GET de Template
=============================================*/

$url = "templates?linkTo=active_template&equalTo=ok";
$method = "GET";
$fields = array();

$template = CurlController::request($url,$method,$fields);

if($template->status == 200){

  $template = $template->results[0];

}else{

  echo '<!DOCTYPE html>
        <html lang="en">
        <head>
        <link rel="stylesheet" href="'.$path.'views/assets/css/plugins/adminlte/adminlte.min.css">
        </head>
        <body class="hold-transition sidebar-collapse layout-top-nav">
        <div class="wrapper">';
        include "pages/500/500.php";
  echo '</div>
        </body>
        </html>';

  return;

}


/*=============================================
Datos en Arreglo
=============================================*/

$keywords = null;

foreach (json_decode($template->keywords_template, true) as $key => $value) {

  $keywords .= $value.", ";

}

$keywords = substr($keywords, 0, -2);

/*=============================================
Datos en Objeto
=============================================*/

$fontFamily = json_decode($template->fonts_template)->fontFamily;
$fontBody = json_decode($template->fonts_template)->fontBody;
$fontSlide = json_decode($template->fonts_template)->fontSlide;

/*=============================================
Datos en JSON
=============================================*/

$topColor = json_decode($template->colors_template)[0]->top;
$templateColor = json_decode($template->colors_template)[1]->template;

?>

<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $template->title_template ?></title>

  <meta name="description" content="<?php echo $template->description_template ?>">
  <meta name="keywords" content="<?php echo $keywords ?>">

  <link rel="icon"
    href="<?php echo $path ?>views/assets/img/template/<?php echo $template->id_template ?>/<?php echo $template->icon_template ?>">

  <!-- Google Font: Source Sans Pro -->
  <?php echo urldecode($fontFamily) ?>

  <!-- CSS -->

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?php echo $path ?>views/assets/css/plugins/fontawesome-free/css/all.min.css">

  <!-- Latest compiled and minified CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- JDSlider -->
  <link rel="stylesheet" href="<?php echo $path ?>views/assets/css/plugins/jdSlider/jdSlider.css">

  <!-- Notie Alert -->
  <link rel="stylesheet" href="<?php echo $path ?>views/assets/css/plugins/notie/notie.min.css">

  <!-- Toastr Alert -->
  <link rel="stylesheet" href="<?php echo $path ?>views/assets/css/plugins/toastr/toastr.min.css">

  <!-- Material Preloader -->
  <link rel="stylesheet" href="<?php echo $path ?>views/assets/css/plugins/material-preloader/material-preloader.css">

  <!-- DataTables -->
  <link rel="stylesheet"
    href="<?php echo $path ?>views/assets/css/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet"
    href="<?php echo $path ?>views/assets/css/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet"
    href="<?php echo $path ?>views/assets/css/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo $path ?>views/assets/css/plugins/adminlte/adminlte.min.css">

  <link rel="stylesheet" href="<?php echo $path ?>views/assets/css/template/template.css">

  <link rel="stylesheet" href="<?php echo $path ?>views/assets/css/products/products.css">

  <style>
    body {
      font-family: '<?php echo $fontBody ?>', sans-serif;
    }

    .slideOpt h1,
    .slideOpt h2,
    .slideOpt h3 {
      font-family: '<?php echo $fontSlide ?>', sans-serif;
    }

    .topColor {
      background: <?php echo $topColor->background ?>;
      color: <?php echo $topColor->color ?>;
    }

    .templateColor,
    .templateColor:hover,
    a.templateColor {
      background: <?php echo $templateColor->background ?> !important;
      color: <?php echo $templateColor->color ?> !important;
    }
  </style>

  <!-- JS -->

  <!-- jQuery -->
  <script src="<?php echo $path ?>views/assets/js/plugins/jquery/jquery.min.js"></script>
  <!-- Latest compiled JavaScript -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>

  <!-- JDSlider
  https://www.jqueryscript.net/slider/Carousel-Slideshow-jdSlider.html -->
  <script src="<?php echo $path ?>views/assets/js/plugins/jdSlider/jdSlider.js"></script>

  <!-- Knob -->
  <script src="<?php echo $path ?>views/assets/js/plugins/knob/knob.js"></script>

  <script src="<?php echo $path ?>views/assets/js/alerts/alerts.js"></script>

  <!-- Notie Alert -->
  <!-- https://jaredreich.com/notie/ -->
  <script src="<?php echo $path ?>views/assets/js/plugins/notie/notie.min.js"></script>

  <!-- Sweet Alert 2 -->
  <!-- https://sweetalert2.github.io/ -->
  <script src="<?php echo $path ?>views/assets/js/plugins/sweetalert/sweetalert.min.js"></script>

  <!-- Toastr Alert-->
  <script src="<?php echo $path ?>views/assets/js/plugins/toastr/toastr.min.js"></script>

  <!-- Material Preloader -->
  <!-- https://www.jqueryscript.net/demo/Google-Inbox-Style-Linear-Preloader-Plugin-with-jQuery-CSS3/ -->
  <script src="<?php echo $path ?>views/assets/js/plugins/material-preloader/material-preloader.js"></script>

  <!-- DataTables  & Plugins -->
  <script src="<?php echo $path ?>views/assets/js/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="<?php echo $path ?>views/assets/js/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?php echo $path ?>views/assets/js/plugins/datatables-responsive/js/dataTables.responsive.min.js">
  </script>
  <script src="<?php echo $path ?>views/assets/js/plugins/datatables-responsive/js/responsive.bootstrap4.min.js">
  </script>
  <script src="<?php echo $path ?>views/assets/js/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="<?php echo $path ?>views/assets/js/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="<?php echo $path ?>views/assets/js/plugins/jszip/jszip.min.js"></script>
  <script src="<?php echo $path ?>views/assets/js/plugins/pdfmake/pdfmake.min.js"></script>
  <script src="<?php echo $path ?>views/assets/js/plugins/pdfmake/vfs_fonts.js"></script>
  <script src="<?php echo $path ?>views/assets/js/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="<?php echo $path ?>views/assets/js/plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="<?php echo $path ?>views/assets/js/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>


</head>

<body class="hold-transition sidebar-collapse layout-top-nav">

  <input type="hidden" id="urlPath" value="<?php echo $path ?>">
  <div class="wrapper">

    <?php

  include "modules/top.php";
  include "modules/navbar.php";

  if (isset($_SESSION["admin"])){
    include "modules/sidebar.php";
  }

  if(!empty($routesArray[0])) {

    if($routesArray[0] == "admin" ||
       $routesArray[0] == "salir"){

      include "pages/".$routesArray[0]."/".$routesArray[0].".php";

    }else{

      include "pages/404/404.php";

    }

  }else{

    include "pages/home/home.php";

  }

  include "modules/footer.php";

  ?>

  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->

  <!-- AdminLTE App -->
  <script src="<?php echo $path ?>views/assets/js/plugins/adminlte/adminlte.min.js"></script>
  <script src="<?php echo $path ?>views/assets/js/products/products.js"></script>

</body>

</html>

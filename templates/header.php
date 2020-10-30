<?php $page_title = "Coches App"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css"
    /> -->
    <link rel="stylesheet" href="./../assets/css/styles.css" />
    <title>
        <?php echo $page_title; ?>
    </title>

    <head>
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script type="text/javascript" src="ajax-script.js"></script>
</head> 

<body>
<div class="container p-3 my-3 border">
    <!-- <div class="nav-container" style="overflow:auto;"> -->
    <p class="navbar-brand">APLICACIÓN GESTIÓN COCHES</p>
  <!-- <h3 style="margin-top: 20px; padding-left: 60px;">APLICACIÓN GESTIÓN COCHES</h3> -->

  <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <!-- Brand -->
    <a class="navbar-brand" href="#">
    <img src="./assets/img/driving-wheel.png" alt="Logo" style="width:40px;">
    </a>

    <!-- Links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="index.php">Home</a>
      </li>
      <!-- <li class="nav-item">
        <a class="nav-link" href="#">Link 2</a>
      </li> -->

      <!-- Dropdown -->
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
        Añadir Datos
        </a>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="anadir-ciudad.php">Añadir Ciudad</a>
          <a class="dropdown-item" href="anadir-vendedor.php">Añadir Vendedor</a>
          <a class="dropdown-item" href="anadir-modelo.php">Añadir Modelo</a>
          <a class="dropdown-item" href="anadir-coche.php">Añadir Coche</a>
          <a class="dropdown-item" href="anadir-comprador.php">Añadir Comprador</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
        Vistas
        </a>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="mostrar-coches.php">Vista Coches</a>
          <a class="dropdown-item" href="#vendedores">Vista Vendedores</a>
        </div>
      </li>

    </ul>
  <!-- </nav>  -->
</div>
<!-- </div> -->
<!-- The navigation menu -->
<!-- <div class="navbar">
    <a href="index.php">HOME</a>
    <div class="subnav">
        <button class="subnavbtn">AÑADIR DATOS <i class="fa fa-caret-down"></i></button>
        <div class="subnav-content">
                <a href="anadir-ciudad.php">AÑADIR CIUDAD</a>
                <a href="anadir-vendedor.php">AÑADIR VENDEDOR</a>
                <a href="anadir-modelo.php">AÑADIR MODELO</a>
                <a href="anadir-coche.php">AÑADIR COCHE</a>
                <a href="anadir-comprador.php">AÑADIR COMPRADOR</a>
        </div>
  </div>
  <div class="subnav">
        <button class="subnavbtn">VISTAS <i class="fa fa-caret-down"></i></button>
        <div class="subnav-content">
                <a href="mostrar-coches.php">VISTA COCHES</a>
                <a href="#vendedores">VISTA VENDEDORES</a>
      
        </div>
  </div>

</div> -->








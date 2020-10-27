<?php $page_title = "Coches App"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css"
    />
    <link rel="stylesheet" href="./../assets/css/styles.css" />
    <title>
        <?php echo $page_title; ?>
    </title>

    <head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" src="ajax-script.js"></script>
</head> 

<body>

<h3 style="margin-top: 20px; padding-left: 60px;">APLICACIÓN GESTIÓN COCHES</h3>

<!-- The navigation menu -->
<div class="navbar">
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
  <!-- <div class="subnav">
    <button class="subnavbtn">Partners <i class="fa fa-caret-down"></i></button>
    <div class="subnav-content">
      <a href="#link1">Link 1</a>
      <a href="#link2">Link 2</a>
      <a href="#link3">Link 3</a>
      <a href="#link4">Link 4</a>
    </div>
  </div>
  <a href="#contact">Contact</a> -->

</div>

<!-- <div id="navmenu">
	<ul>
		<li><a href="index.php">HOME</a></li>
        <li><a href="mostrar-coches.php">VISTA COCHES</a></li>
        <li><div class="subnav">
                <button class="subnavbtn">AÑADIR DATOS<i class="fa fa-caret-down"></i></button>
                <div class="subnav-content">
                <a href="anadir-ciudad.php">AÑADIR CIUDAD</a>
                <a href="anadir-vendedor.php">AÑADIR VENDEDOR</a>
                <a href="anadir-modelo.php">AÑADIR MODELO</a>
                <a href="anadir-coche.php">AÑADIR COCHE</a>
                <a href="anadir-comprador.php">AÑADIR COMPRADOR</a>
                <a href="#careers">Careers</a>
                </div>
            </div>
        </li>
        <li><a href="anadir-modelo.php">AÑADIR MODELO</a></li>
        <li><a href="anadir-vendedor.php">AÑADIR VENDEDOR</a></li>
        <li><a href="anadir-coche.php">AÑADIR COCHE</a></li>
        <li><a href="anadir-comprador.php">AÑADIR COMPRADOR</a></li>
        <li><a href="anadir-ciudad.php">AÑADIR CIUDAD</a></li>
    </ul>
    <hr>
    <br/>
</div> -->




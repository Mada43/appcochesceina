<?php
$page_title = "APLICACIÓN GESTIÓN COCHES";
include "./templates/header.php";
//include "./classes/class.forms.php";
// Create object CeinaForms
//$FormularioCeina = new CeinaForms();

// Check if we are in POST method
// if ($_SERVER["REQUEST_METHOD"] === "POST") {
//     var_dump($_FILES);
//     $FormularioCeina->enviarFormulario($_POST, $_FILES);
// }
// Check if we are in POST method and if the class exists
//and store the result in a var
//$existeValidacion = !empty($FormularioCeina) && $_SERVER["REQUEST_METHOD"] === "POST" ? true : false;
?>
<!-- <div class="caja-contenedora"> -->
<!-- <h3 style="margin-top: 30px;">APLICACIÓN GESTIÓN TRABAJADORES</h3> -->
<!-- <hr> -->
<form
    action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
    method="post"
    enctype="multipart/form-data"
>

<p class="saludo">Bienvenido en la APLICACIÓN DE GESTIÓN DE COCHES</p>
<p class="info">Escoge una opción de añadir <br/>
                                    <a href="anadir-ciudad.php">un ciudad</a><br/> 
                                    <a href="anadir-vendedor.php">un vendedor</a></br>
                                    <a href="anadir-modelo.php">un modelo de coche</a></br>
                                    <a href="anadir-coche.php">un coche</a></br>
                                    <a href="anadir-comprador.php">un comprador</a></br>
                                    o de visualizar <a href="mostrar-coches.php">los coches</a></p>
<?php
    // $FormularioCeina->showInput(
    //     "file", 
    //     "archivo", 
    //     "archivo", 
    //     "Archivo", 
    //     "Subir Archivo",
    //      $existeValidacion);
    
    // $errores = $FormularioCeina->hayErrores();
    // if (!$errores && $existeValidacion) {
    //     // Enviar a la base de datos
    //     var_dump($FormularioCeina->datosRecibidos);
    // }
?>
<!-- <button type="submit" class="submit">Enviar</button> -->
</form>
</div>
<?php include "./templates/footer.php";
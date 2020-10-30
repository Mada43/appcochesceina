<?php
include "./templates/header.php";
include "./classes/class.forms.php";
include "./classes/class.db.php";

$page_title = "Añadir Vendedor";

//these lines, until the form, could be put in the header so that they are included in every page
//creating the necessary objects
//instantiating the class that builds the form
$FormularioCeina = new CeinaForms();
//instantiating the class that manages the db
//$enviarOficina = new DBforms();
$enviarCoche = new DBforms();

// COMPRUEBO SI ESTAMOS EN METODO POST.
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    //if ($_FILES[key($_FILES)]['size'] === 0) 
    if (!isset($_FILES))
    { 
        $FormularioCeina->enviarFormulario($_POST); 
    } else { 
        $FormularioCeina->enviarFormulario($_POST, $_FILES); }

    // echo '<pre>';
    // print_r($_POST);
    // echo '</pre>';
    // echo '<pre>';
    // print_r($_FILES);
    // echo '</pre>';
    //$FormularioCeina->enviarFormulario($_POST, $_FILES);
}

// COMPRUEBO SI ESTAMOS EN METODO POST Y LA CLASE EXISTE
$existeValidacion = !empty($FormularioCeina) && $_SERVER["REQUEST_METHOD"] === "POST" ? true : false;
?>
<div class="caja-contenedora">
    <h3 style="margin-top: 55px;"><?php echo $page_title ?></h3> 
    <!-- OR the title can be stored in a php var and echoed here as follows: -->	
    <? //php echo $page_title ?>
    <hr> 
    
    <form
        action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
        method="post" enctype="multipart/form-data"
    >
    <!-- generating the inputs -->
    <?php
    
        //text input for name
        $FormularioCeina->showInput(
            $type = "text",
            $id = "nombre",
            $name = "nombre",
            $myFunction = "",
            $placeholder = "Nombre Vendedor",
            $label = "Introduzca el nombre del Vendedor",
            $validacion = $existeValidacion
        );

        //text input for apellido
        $FormularioCeina->showInput(
            $type = "text",
            $id = "apellido",
            $name = "apellido",
            $myFunction = "",
            $placeholder = "Apellido Vendedor",
            $label = "Introduzca el apellido del Vendedor",
            $validacion = $existeValidacion
        );

        //text input for dni
        $FormularioCeina->showInput(
            $type = "number",
            $id = "dni",
            $name = "dni",
            $myFunction = "",
            $placeholder = "Introduzca el DNI del vendedor",
            $label = "DNI vendedor",
            $validacion = $existeValidacion
        );

        //text input for address
        $FormularioCeina->showInput(
            $type = "text",
            $id = "direccion",
            $name = "direccion",
            $myFunction = "",
            $placeholder = "Introduzca la direccion",
            $label = "Dirección",
            $validacion = $existeValidacion
        );

        //text input for zip code
        $FormularioCeina->showInput(
            $type = "text",
            $id = "codigo-postal",
            $name = "codigo-postal",
            $myFunction = "",
            $placeholder = "Introduzca el codigo postal",
            $label = "Codigo Postal",
            $validacion = $existeValidacion
        );

        //echo '<hr>';

        //simple (not multiple) select input for Cities
        $FormularioCeina->showInput(
            $type = "select",
            $id = "ciudad",
            $name = "ciudad",
            $placeholder = "",
            $label = "Ciudad",
            $validacion = $existeValidacion,
            $options = $enviarCoche->obtenerCiudades(),
            //$multiple = true
        );

        //file upload input
        // $FormularioCeina->showInput(
        //     $type = "file",
        //     $id = "foto",
        //     $name = "foto",
        //     $placeholder = "Archivo",
        //     $label = " Select photo to upload ",
        //     $validacion = $existeValidacion
        // );

        echo '<hr>';
        
    ?>
        <button type="submit" class="submit">Enviar</button>
    </form>
</div>
<?php
    $errores = $FormularioCeina->hayErrores();
    $selected_option;

    //if there are no errors + 
    //method is POST and the class that builds and validates the form exists
    if (!$errores && $existeValidacion) {
        //we can now build the path where the file will be uploaded
        //$filePath = '/tmp/' . $FormularioCeina->fotoRecibida['name'];
        //insert data into MEDIA tbl and keep the inserted id
        //$idMedia = $enviarCoche->enviarMedia(
        //    'ssi',
        //    '/tmp/' . $FormularioCeina->fotoRecibida['name'],
        //    "",
        //    0
            //$FormularioCeina->fotoRecibida['mime_type'],
            //$FormularioCeina->fotoRecibida['filesize']
        //);

        //$ascensor = array_key_exists('ascensor', $FormularioCeina->datosRecibidos)? 1 : 0;
        //$discap = array_key_exists('discap', $FormularioCeina->datosRecibidos)? 1 : 0;
        // Enviar a la base de datos y guarda el id
        //echo "Checkboxes are sent as: ";
        //var_dump($FormularioCeina->datosRecibidos['ascensor']);
        //var_dump($FormularioCeina->datosRecibidos['discap']);

        //get data from multiple SELECT and ...
        //if ($FormularioCeina->datosRecibidos['ciudad']) {
            //foreach ($FormularioCeina->datosRecibidos['ciudad'] as $key => $value) {
                //...pass it to the fct that inserts it into the DB
                // $enviarOficina->enviarOficinaTrabajador(
                //     'ii',
                //     $idOficina,
                //     $value
                // );
                //$selected_option = $value;
            //}
        //}

      //$sqlResult = $enviarOficina->enviarOficinaMedia('ii', $idOficina, $idMedia);
      //echo $sqlResult;
     // var_dump($enviarOficina);    
    

        //insert data into LOCALIZACION and keep the id
        $idLocalizacion = $enviarCoche->enviarLocalizacion(
            'ssi',
            $FormularioCeina->datosRecibidos['direccion'],
            $FormularioCeina->datosRecibidos['codigo-postal'],
            $FormularioCeina->datosRecibidos['ciudad']
            //$FormularioCeina->datosRecibidos['ascensor'],
            //$FormularioCeina->datosRecibidos['discap'],
            //$selected_option //the selected_option = id ciudad
            //$FormularioCeina->datosRecibidos['foto'] //we should have the id here?
        );

        //if (!empty($idOficina)) {
        //    echo '<p>Gracias, hemos recibido y guardado sus datos</p>';
        //}

        //insert data into VENDEDORES and keep the id
        $idVendedor = $enviarCoche->enviarVendedor(
            'sssi',
            $FormularioCeina->datosRecibidos['nombre'],
            $FormularioCeina->datosRecibidos['apellido'],
            $FormularioCeina->datosRecibidos['dni'],
            $idLocalizacion
            //$FormularioCeina->datosRecibidos['foto'] //we should have the id here?
        );

        if (!empty($idVendedor)) {
            echo '<p>Gracias, hemos recibido y guardado los datos del vendedor</p>';
        }
    }


        
    
?>
<?php include "./templates/footer.php";
?>

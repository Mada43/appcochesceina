<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include "./templates/header.php";
include "./classes/class.forms.php";
include "./classes/class.db.php";

$page_title = "Añadir Coche";

//creating the necessary objects
//instantiating the class that builds the form
$FormularioCeina = new CeinaForms();
//instantiating the class that manages the db
$objectCoche = new DBforms();

// COMPRUEBO SI ESTAMOS EN METODO POST.
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if ($_FILES[key($_FILES)]['size'] === 0) { 
        $FormularioCeina->enviarFormulario($_POST); 
    } else { 
        $FormularioCeina->enviarFormulario($_POST, $_FILES); }

    // echo '<pre>';
    // print_r($_POST);
    // echo '</pre>';
    // echo '<pre>';
    // print_r($_FILES);
    // echo '</pre>';
    $FormularioCeina->enviarFormulario($_POST, $_FILES);
    //var_dump($FormularioCeina->datosRecibidos);
}

// COMPRUEBO SI ESTAMOS EN METODO POST Y LA CLASE EXISTE
$existeValidacion = !empty($FormularioCeina) && $_SERVER["REQUEST_METHOD"] === "POST" ? true : false;
?>
<div class="caja-contenedora">
    <h3 style="margin-top: 0px;"><?php echo $page_title ?></h3>
    <hr> 
    
    <form
        action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
        method="post" enctype="multipart/form-data"
    >
    <!-- generating the form inputs -->
    <?php
    
    //select input - Marca
    // $FormularioCeina->showInput(
    //     $type = "select",
    //     $id = "marca",
    //     $name = "marca",
    //     $placeholder = "",
    //     $label = "Marca",
    //     $validacion = $existeValidacion,
    //     $options = $objectCoche->obtenerMarcas(),
    //     //$multiple = true
    // );
    
    //select input - Modelo
    $FormularioCeina->showInput(
        $type = "select",
        $id = "modelo",
        $name = "modelo",
        //$myFunction = "",
        $placeholder = "",
        $label = "Modelo",
        $validacion = $existeValidacion,
        $options = $objectCoche->obtenerModelos(),
        //$multiple = true
    ); 
    
    //text input -año fabricación
    $FormularioCeina->showInput(
        $type = "number",
        $id = "anio_produccion",
        $name = "anio_produccion",
        $myFunction = "",
        $placeholder = "Introduzca el año de fabricación",
        $label = "Año fabricación",
        $validacion = $existeValidacion
    );

    //select input - combustible
    $FormularioCeina->showInput(
        $type = "select",
        $id = "combustible",
        $name = "combustible",
        //$myFunction = "",
        $placeholder = "",
        $label = "Combustible",
        $validacion = $existeValidacion,
        $options = $objectCoche->obtenerCombustible(),
        //$multiple = true
    );

    //text input - precio
    $FormularioCeina->showInput(
        $type = "number",
        $id = "precio",
        $name = "precio",
        $myFunction = "",
        $placeholder = "Introduzca el precio",
        $label = "Precio",
        $validacion = $existeValidacion
    );

    //select input - vendedor
    $FormularioCeina->showInput(
        $type = "select",
        $id = "vendedor",
        $name = "vendedor",
        //$myFunction = "",
        $placeholder = "",
        $label = "Propietario",
        $validacion = $existeValidacion,
        $options = $objectCoche->obtenerVendedores(),
        //$multiple = true
    ); 

    //select input - comprador
    // $FormularioCeina->showInput(
    //     $type = "select",
    //     $id = "comprador",
    //     $name = "comprador",
    //     //$myFunction = "",
    //     $placeholder = "",
    //     $label = "Comprador",
    //     $validacion = $existeValidacion,
    //     $options = $objectCoche->obtenerCompradores(),
        //$multiple = true
    //); 

        //checkbox input
        // $FormularioCeina->showInput(
        //     $type = "checkbox",
        //     $id = "ascensor",
        //     $name = "ascensor",
        //     $placeholder = "",
        //     $label = "Tiene Ascensor",
        //     $validacion = $existeValidacion
        // );

        echo '<hr>';
    
        // //multiple select input for EMPLOYEES
        // $FormularioCeina->showInput(
        //     $type = "select",
        //     $id = "trabajadores",
        //     $name = "trabajadores[]",
        //     $placeholder = "",
        //     $label = "Trabajadores",
        //     $validacion = $existeValidacion,
        //     $options = $enviarOficina->obtenerTrabajadores(),
        //     $multiple = true
        // );

        //file upload input
        $FormularioCeina->showInput(
            $type = "file",
            $id = "foto",
            $name = "foto",
            $myFunction = "",
            $placeholder = "Archivo",
            $label = "Select photo to upload ",
            $validacion = $existeValidacion
        );

        echo '<hr>';
        
    ?>
        <button type="submit" class="submit">Enviar</button>
    </form>
</div>
<?php
    $errores = $FormularioCeina->hayErrores();

    //if there are no errors + 
    //method is POST and the class that builds and validates the form exists
    if (!$errores && $existeValidacion) {
        //we can now build the path where the file will be uploaded
        $filePath = '/tmp/' . $FormularioCeina->fotoRecibida['name'];
        //insert data into MEDIA tbl and keep the inserted id
        $idMedia = $objectCoche->enviarMedia(
            'ssi',
            '/tmp/' . $FormularioCeina->fotoRecibida['name'],
            "",
            0
            //$FormularioCeina->fotoRecibida['mime_type'],
            //$FormularioCeina->fotoRecibida['filesize']
        );

        //$ascensor = array_key_exists('ascensor', $FormularioCeina->datosRecibidos)? 1 : 0;
        //$discap = array_key_exists('discap', $FormularioCeina->datosRecibidos)? 1 : 0;
        // Enviar a la base de datos y guarda el id
        //echo "Checkboxes are sent as: ";
        //var_dump($FormularioCeina->datosRecibidos['ascensor']);
        //var_dump($FormularioCeina->datosRecibidos['discap']);

        //insert data into COCHES and keep the id
        $produced = intval($FormularioCeina->datosRecibidos['anio_produccion']);
        $price = intval($FormularioCeina->datosRecibidos['precio']);
        $seller = intval($FormularioCeina->datosRecibidos['vendedor']);
        //$buyer = intval($FormularioCeina->datosRecibidos['comprador']);
        $fuel = intval($FormularioCeina->datosRecibidos['combustible']);
        $model = intval($FormularioCeina->datosRecibidos['modelo']);

        $idCoche = $objectCoche->enviarCoche(
            'iiiii',
            $produced,
            $price,
            $seller,
            //$buyer,
            $fuel,
            $model
        );

        var_dump($FormularioCeina->datosRecibidos);

        //if (!empty($idOficina)) {
        //    echo '<p>Gracias, hemos recibido y guardado sus datos</p>';
        //}

        //get data from multiple select and 
        // if ($FormularioCeina->datosRecibidos['trabajadores']) {
        //     foreach ($FormularioCeina->datosRecibidos['trabajadores'] as $key => $value) {
        //         //...pass it to the fct that inserts it into the DB
        //         $enviarOficina->enviarOficinaTrabajador(
        //             'ii',
        //             $idOficina,
        //             $value
        //         );
        //     }
        // }

        

      $sqlResult = $objectCoche->enviarCochesMedia('ii', $idCoche, $idMedia);
      echo $sqlResult;
     // var_dump($enviarOficina);

        
    }
?>
<?php include "./templates/footer.php";


/*
DIFERENTES MÉTODOS DE HACER QUERIES:
CON BIND RESULTS HAREMOS QUERIES ESPECIFICAS OBTENIENDO LA/S COLUMNA/S
1. ES MÁS FÁCIL.
2. USA FETCH
CON RESULT get_result() HAREMOS QUERIES QUE IMPLIQUEN TRAER TODOS
LOS PAREMTROS. SELECT * FROM .....
1. FUNCIONA BIEN CON TODO TIPO DE DECLARACIONES SQL
2. USA fetch_assoc()
*/


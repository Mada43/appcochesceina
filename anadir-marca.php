<?php
$page_title = "Añadir Marca";

include "./templates/header.php";
include "./classes/class.forms.php";
include "./classes/class.db.php";

//creating the necessary objects
//instantiating the class that builds the form
$FormularioCeina = new CeinaForms();
//instantiating the class that manages the db
$enviarOficina = new DBforms();

// COMPRUEBO SI ESTAMOS EN METODO POST.
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if ($_FILES[key($_FILES)]['size'] === 0) { 
        $FormularioCeina->enviarFormulario($_POST); 
    } else { 
        $FormularioCeina->enviarFormulario($_POST, $_FILES); }

    echo '<pre>';
    print_r($_POST);
    echo '</pre>';
    echo '<pre>';
    print_r($_FILES);
    echo '</pre>';
    $FormularioCeina->enviarFormulario($_POST, $_FILES);
}

// COMPRUEBO SI ESTAMOS EN METODO POST Y LA CLASE EXISTE
$existeValidacion = !empty($FormularioCeina) && $_SERVER["REQUEST_METHOD"] === "POST" ? true : false;
?>
<div class="caja-contenedora">
    <h3 style="margin-top: 0px;">Añadir Marca</h3>
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
            $placeholder = "Nombre Oficina",
            $label = "Nombre Oficina",
            $validacion = $existeValidacion
        );

        //text input for address
        $FormularioCeina->showInput(
            $type = "text",
            $id = "direccion",
            $name = "direccion",
            $placeholder = "Introduzca la direccion",
            $label = "Dirección",
            $validacion = $existeValidacion
        );

        //text input for number
        $FormularioCeina->showInput(
            $type = "number",
            $id = "nr-puestos",
            $name = "nr-puestos",
            $placeholder = "Introduzca el numero de puestos",
            $label = "Numero de Puestos",
            $validacion = $existeValidacion
        );

        //checkbox input
        $FormularioCeina->showInput(
            $type = "checkbox",
            $id = "ascensor",
            $name = "ascensor",
            $placeholder = "",
            $label = "Tiene Ascensor",
            $validacion = $existeValidacion
        );

        //checkbox input
        $FormularioCeina->showInput(
            $type = "checkbox",
            $id = "discap",
            $name = "discap",
            $placeholder = "",
            $label = "Tiene Acceso para Discapacitados",
            $validacion = $existeValidacion
        );

        echo '<hr>';
        
        echo '<hr>';
        //multiple select input for EMPLOYEES
        $FormularioCeina->showInput(
            $type = "select",
            $id = "trabajadores",
            $name = "trabajadores[]",
            $placeholder = "",
            $label = "Trabajadores",
            $validacion = $existeValidacion,
            $options = $enviarOficina->obtenerTrabajadores(),
            $multiple = true
        );

        //file upload input
        $FormularioCeina->showInput(
            $type = "file",
            $id = "foto",
            $name = "foto",
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
        $idMedia = $enviarOficina->enviarMedia(
            'ssi',
            '/tmp/' . $FormularioCeina->fotoRecibida['name'],
            "",
            0
            //$FormularioCeina->fotoRecibida['mime_type'],
            //$FormularioCeina->fotoRecibida['filesize']
        );

        $ascensor = array_key_exists('ascensor', $FormularioCeina->datosRecibidos)? 1 : 0;
        $discap = array_key_exists('discap', $FormularioCeina->datosRecibidos)? 1 : 0;
        // Enviar a la base de datos y guarda el id
        //echo "Checkboxes are sent as: ";
        //var_dump($FormularioCeina->datosRecibidos['ascensor']);
        //var_dump($FormularioCeina->datosRecibidos['discap']);

        //insert data into OFICINA and keep the id
        $idOficina = $enviarOficina->enviarOficina(
            'ssiiis',
            $FormularioCeina->datosRecibidos['nombre'],
            $FormularioCeina->datosRecibidos['direccion'],
            $FormularioCeina->datosRecibidos['nr-puestos'],
            //$FormularioCeina->datosRecibidos['ascensor'],
            //$FormularioCeina->datosRecibidos['discap'],
            $ascensor,
            $discap,
            $idMedia
            //$FormularioCeina->datosRecibidos['foto'] //we should have the id here?
        );

        //if (!empty($idOficina)) {
        //    echo '<p>Gracias, hemos recibido y guardado sus datos</p>';
        //}

        //get data from multiple select and 
        if ($FormularioCeina->datosRecibidos['trabajadores']) {
            foreach ($FormularioCeina->datosRecibidos['trabajadores'] as $key => $value) {
                //...pass it to the fct that inserts it into the DB
                $enviarOficina->enviarOficinaTrabajador(
                    'ii',
                    $idOficina,
                    $value
                );
            }
        }

      $sqlResult = $enviarOficina->enviarOficinaMedia('ii', $idOficina, $idMedia);
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


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

function printVar ($var){
    echo '<pre>';
    print_r($var);
    echo '</pre>';
    return;
}

$marcas = $objectCoche->obtenerMarcas();
$marcas_modelos = $objectCoche -> obtenerMarcasModelos2(); //returns the result as an array of assoc subarrays
// echo "El resultado del query para Marcas_Modelos: </br>";
// printVar($marcas_modelos);


// $infoMarcas = array(
//     'mercedes' => ['mercedes-1', 'mercedes-2', 'mercedes-3'],
//     'seat' => ['leon-1', 'leon-2', 'leon-3']
// );
    

//define the array to associate each car make with its models 
//bidim assoc arr: Marca = arr of models ex: [Dacia] => Array([2] => Duster [11] => Sandero)
$infoMarcas = array(); 
//$info_id_modelos = array();
// echo "El contenido de la var marcas: ";
// printVar($marcas);
// echo "El contenido de la var marcas_modelos: ";
// printVar($marcas_modelos);
        
foreach ($marcas as $key => $value) {
    foreach($marcas_modelos as $mm){
        if ($value == $mm['marca']) {
            $infoMarcas[$value][$mm['id_modelo']] = $mm['modelo'];
            $info_id_modelos[$value][] = $mm['id_modelo'];
            //$infoMarcas[$key][] = $mm['modelo'];
        }
    }
}

// $arrayToEncode = array();
// $arrayToEncode[] = $infoMarcas;
// $arrayToEncode[] = $info_id_modelos;



// echo "El contenido da la var infoMarcas: </br>";
// printVar($infoMarcas);
// echo "Var info_id_modelos: </br>";
// printVar($info_id_modelos);

// echo "Array de marcas - var infoMarcas - updated is: </br>";
//         //var_dump($arr_marcas);
//         printVar($infoMarcas);

// echo "Var arrayToEncode: </br>";
// printVar($arrayToEncode);

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
    <h3 style="margin-top: 55px;"><?php echo $page_title ?></h3>
    <hr> 
    
    <form
        action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
        method="post" enctype="multipart/form-data"
    >
    <!-- generating the form inputs -->
    
<!-- select input for marcas -->

<?php 
    $classes = "input input-select";
    $mensaje_validacion = "";
?>
    <div class="grupo grupo-select">
        <label class="label" for="marcas">Marca</label>
        <select name="marcas" id="marcas" class="'$classes'">
        <option value="" disabled selected>-- Escoge una marca</option>
        <?php 
        foreach ($infoMarcas as $marca => $models) : 
        ?>
            <option value="<?php echo $marca ?>" ><?php echo $marca ?></option>
        <?php 
        endforeach; 
        ?>
        </select>
    </div>

<?php    
    // //select input - Marca
    // $FormularioCeina->showInput(
    //     $type = "select",
    //     $id = "marca",
    //     $name = "marca",
    //     $placeholder = "",
    //     $label = "Marca",
    //     $validacion = $existeValidacion,
    //     $options = $marcas
    //     //$options = $objectCoche->obtenerMarcas(),
    //     //$multiple = true
    // );

    //echo "Var options for Marcas contains: </br>";
    //printVar($options);
    // echo "Var infoMarcas contains: </br>";
    // printVar($infoMarcas);


    ?>

    <!-- select input for modelos -->
    <div class="grupo grupo-select">
        <label id="label-modelos" class="label" for="modelos" style="visibility: hidden">Modelo</label>
        <select name="modelos" id="modelos" style="visibility: hidden">
        <!-- <option value="" disabled selected>-- Escoge el modelo</option> -->
        </select>
    </div>

    
    <?php
    //select input - Modelo
    // $FormularioCeina->showInput(
    //     $type = "select",
    //     $id = "modelo",
    //     $name = "modelo",
    //     //$myFunction = "",
    //     $placeholder = "",
    //     $label = "Modelo",
    //     $validacion = $existeValidacion,
    //     $options = $objectCoche->obtenerModelos(),
    //     //$multiple = true
    // );
    ?> 
    
    <?php
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
        $label = "Precio (€)",
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

        echo '<hr>';

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

        //printVar($_POST);
        //printVar($_FILES);

        //insert data into COCHES and keep the id
        $produced = intval($FormularioCeina->datosRecibidos['anio_produccion']);
        $price = intval($FormularioCeina->datosRecibidos['precio']);
        $seller = intval($FormularioCeina->datosRecibidos['vendedor']);
        //$buyer = intval($FormularioCeina->datosRecibidos['comprador']);
        $fuel = intval($FormularioCeina->datosRecibidos['combustible']);
        $model = intval($FormularioCeina->datosRecibidos['modelos']);

        $idCoche = $objectCoche->enviarCoche(
            'iiiii',
            $produced,
            $price,
            $seller,
            //$buyer,
            $fuel,
            $model
        );

        //var_dump($idCoche); 
        if ($idCoche) {
            echo "Gracias, hemos recibido los datos!";
        }else{
            "En error ocurred when trying to process the data...";
        }

      $sqlResult = $objectCoche->enviarCochesMedia('ii', $idCoche, $idMedia);
      //echo $sqlResult;
           
    }
?>

<script id="marcas_coches" type="application/json"><?php echo json_encode($infoMarcas); ?></script>
    <script>
        var marcas_modelos = JSON.parse(document.getElementById("marcas_coches").innerHTML);

        console.log("marcas_modelos = php array JSON parsed: ");
        console.log(marcas_modelos);
        console.log("typeof marcas_modelos: ");
        console.log(typeof(marcas_modelos)); //Object

        //console.log("ob keys: ");
        //console.log (Object.keys(marcas_modelos)[0]);
        //console.log(marcas_modelos[(Object.keys(marcas_modelos)[0])]);
        //console.log((Object.keys(marcas_modelos[(Object.keys(marcas_modelos)[0])])));

        // Object.entries(marcas_modelos.Object.keys(marcas_modelos)).forEach(element => {
        //     console.log(marcas_modelos.Object.keys(marcas_modelos)); 
        // });

        var SELECT_MARCAS = document.getElementById("marcas");
        var LABEL_MODELOS = document.getElementById("label-modelos");
        var SELECT_MODELOS = document.getElementById("modelos");

        SELECT_MARCAS.addEventListener('change', function() {
            var SMval = SELECT_MARCAS.value;
            console.log("SMval: typeof and value: ");
            console.log(typeof(SMval)); //string ex.: Seat
            console.log(SMval);
            console.log("marcas_modelos[SMval]: typeof and value: ");
            console.log(typeof(marcas_modelos[SMval]));
            console.log(marcas_modelos[SMval]); //Object
            console.log("marcas_modelos[SMval]: .length: ");
            console.log(marcas_modelos[SMval].length); //undefined - because it is not an array, here we have an object

            if (SMval !== '') {
                SELECT_MODELOS.innerHTML = ''; //reset model select options
                //make visible modelos select and its label
                LABEL_MODELOS.style.visibility = 'visible';
                SELECT_MODELOS.style.visibility = 'visible';
                var obj = marcas_modelos[SMval]; //Object { 6: "Ateca", 7: "Mii", 8: "Ibiza" }
                for (const prop in obj) {
                    //console.log(`obj.${prop} = ${obj[prop]}`);
                    let id = prop; //ex. : 6
                    let modelo = obj[prop]; //ex. : Ateca
                    var option = document.createElement('option');
                    option.appendChild(document.createTextNode(obj[prop])); //contenido text mostrado
                    option.value = prop; //id modelo
                    SELECT_MODELOS.appendChild(option);
                    }

                
                // for (let i = 0; i < marcas_modelos[SMval].length; i++) {
                //     const el = marcas_modelos[SMval][i];
                //     var option = document.createElement('option');
                //     option.appendChild(document.createTextNode(marcas_modelos[SMval][i]));
                //     //a modificar para introducir el id del modelo como option value
                //     option.value = marcas_modelos[SMval][i];
                //     SELECT_MODELOS.appendChild(option);                   
                // }


            }
        });
    </script>

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


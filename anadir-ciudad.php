<?php
include "./templates/header.php";
include "./classes/class.forms.php";
include "./classes/class.db.php";
$page_title = "Añadir Ciudad";
?>
<?php
//creating the necessary objects
//instantiating the class that builds the form
$FormularioCeina = new CeinaForms();
//instantiating the class that manages the db
$enviarCoche = new DBforms();

// COMPRUEBO SI ESTAMOS EN METODO POST.
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if (!isset($_FILES)) { 
        //if ($_FILES[key($_FILES)]['size'] === 0)
        {
            $FormularioCeina->enviarFormulario($_POST);
        }
         
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
    <!-- <h3 style="margin-top: 30px;">Añadir Oficina</h3> -->
    <!-- OR the title can be stored in a php var and echoed here as follows: -->	
    <h3 style="margin-top: 30px;"><?php echo $page_title ?></h3> 
    <hr> 
    
    <form
        action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
        method="post"
    >
    <!-- generating the inputs -->
    <?php
    
        //text input
        $FormularioCeina->showInput(
            $type = "text",
            $id = "ciudad",
            $name = "ciudad",
            $myFunction = "",
            $placeholder = "Nombre Ciudad",
            $label = "Introduzca el ciudad",
            $validacion = $existeValidacion
        );

        //text input
        $FormularioCeina->showInput(
            $type = "text",
            $id = "pais",
            $name = "pais",
            $myFunction = "",
            $placeholder = "Nombre pais",
            $label = "Introduzca el pais",
            $validacion = $existeValidacion
        );

        echo '<hr>';
        
    ?>
        <button type="submit" class="submit">Enviar</button>
    </form>
</div>
<?php
var_dump($_POST);
if(isset($_POST["submit"])){
    echo $_POST['ciudad'];
    echo $_POST['pais'];   
}
$errores = $FormularioCeina->hayErrores();
if (!$errores && $existeValidacion){

        //insert data into ciudades and keep the id
        // $idCiudad = $enviarCoche->enviarCiudad(
        //     'ss',
        //     $FormularioCeina->datosRecibidos['ciudad'],
        //     $FormularioCeina->datosRecibidos['pais']
        // );

        $idCiudad = $enviarCoche->enviarCiudad(
            'ss',
            $_POST['ciudad'],
            $_POST['pais']
        );

        if (!empty($idCiudad)) {
            echo $_POST['ciudad'];
            echo $_POST['pais'];
            echo '<p>Gracias, hemos recibido y guardado sus datos</p>';
        }

        var_dump($idCiudad);

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

    //   $sqlResult = $enviarOficina->enviar('ii', $idOficina, $idMedia);
    //   echo $sqlResult;
    }
       

include "./templates/footer.php";


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
?>

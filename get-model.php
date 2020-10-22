<?php

$page_title = "Get Model Test";

include "./templates/header.php";
include "./classes/class.forms.php";
include "./classes/class.db.php";

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

    echo '<pre>';
    print_r($_POST);
    echo '</pre>';
    echo '<pre>';
    print_r($_FILES);
    echo '</pre>';
    //$FormularioCeina->enviarFormulario($_POST, $_FILES);
}

// COMPRUEBO SI ESTAMOS EN METODO POST Y LA CLASE EXISTE
$existeValidacion = !empty($FormularioCeina) && $_SERVER["REQUEST_METHOD"] === "POST" ? true : false;
?>
<div class="caja-contenedora">
    <h3 style="margin-top: 30px;"><?php echo $page_title ?></h3> 
    <!-- OR the title can be stored in a php var and echoed here as follows: -->	
    <? //php echo $page_title ?>
    <hr> 
    
    <form
        action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
        method="post" enctype="multipart/form-data"
    >
    <!-- generating the inputs -->
    <?php

        //echo '<hr>';

        //select input for Marcas
        $FormularioCeina->showInput(
            $type = "select",
            $id = "marca",
            $name = "marca",
            $myFunction = "showModel(this.value)",
            //$placeholder = "",
            $label = "Marca",
            $validacion = $existeValidacion,
            $options = $enviarCoche->obtenerMarcas(),
            //$multiple = true
        );
        ?>

        <div id="modelsList">Models available will be listed here...</div>

        <?php
        //select input for Modelos
        // $FormularioCeina->showInput(
        //     $type = "select",
        //     $id = "modelo",
        //     $name = "modelo",
        //     $placeholder = "",
        //     $label = "Modelo",
        //     $validacion = $existeValidacion,
        //     $options = $enviarCoche->obtenerModelos(),
        //     //$multiple = true
        // );

        echo '<hr>';
        
    ?>
        <button type="submit" class="submit">Enviar</button>
    </form>
</div>
<?php
    //$errores = $FormularioCeina->hayErrores();
    //$selected_option;

    //if there are no errors + 
    //method is POST and the class that builds and validates the form exists
    //if (!$errores && $existeValidacion) { 
       //insert data into LOCALIZACION and keep the id
        // $idLocalizacion = $enviarCoche->enviarLocalizacion(
        //     'ssi',
        //     $FormularioCeina->datosRecibidos['direccion'],
        //     $FormularioCeina->datosRecibidos['codigo-postal'],
        //     $FormularioCeina->datosRecibidos['ciudad']
        // );

        //if (!empty($idOficina)) {
        //    echo '<p>Gracias, hemos recibido y guardado sus datos</p>';
        //}

        //insert data into VENDEDORES and keep the id
        // $idVendedor = $enviarCoche->enviarVendedor(
        //     'sssi',
        //     $FormularioCeina->datosRecibidos['nombre'],
        //     $FormularioCeina->datosRecibidos['apellido'],
        //     $FormularioCeina->datosRecibidos['dni'],
        //     $idLocalizacion
        //     //$FormularioCeina->datosRecibidos['foto'] //we should have the id here?
        // );

        // if (!empty($idVendedor)) {
        //     echo '<p>Gracias, hemos recibido y guardado los datos del vendedor</p>';
        // }
    //}


        
    
?>

<script>
function showModel(str) {
  var xhttp;    
  if (str == "") {
    document.getElementById("modelsList").innerHTML = "";
    return;
  }
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("modelsList").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "get-model2.php?q="+str, true);
  xhttp.send();
}
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" src="ajax-script.js"></script>

<?php include "./templates/footer.php";


// $sql = "SELECT customerid, companyname, contactname, address, city, postalcode, country
// FROM customers WHERE customerid = ?";

// $stmt = $mysqli->prepare($sql);
// $stmt->bind_param("s", $_GET['q']);
// $stmt->execute();
// $stmt->store_result();
// $stmt->bind_result($cid, $cname, $name, $adr, $city, $pcode, $country);
// $stmt->fetch();
// $stmt->close();

// echo "<table>";
// echo "<tr>";
// echo "<th>CustomerID</th>";
// echo "<td>" . $cid . "</td>";
// echo "<th>CompanyName</th>";
// echo "<td>" . $cname . "</td>";
// echo "<th>ContactName</th>";
// echo "<td>" . $name . "</td>";
// echo "<th>Address</th>";
// echo "<td>" . $adr . "</td>";
// echo "<th>City</th>";
// echo "<td>" . $city . "</td>";
// echo "<th>PostalCode</th>";
// echo "<td>" . $pcode . "</td>";
// echo "<th>Country</th>";
// echo "<td>" . $country . "</td>";
// echo "</tr>";
// echo "</table>";
?> 
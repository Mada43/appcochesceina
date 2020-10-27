<?php
include "./templates/header.php"; //includes also ajax-script.js 
include "./classes/class.forms.php";
include "./classes/class.db.php";
$page_title = "Añadir Modelo";
?>
<?php
//creating the necessary objects
//instantiating the class that builds the form
$FormularioCeina = new CeinaForms();
//instantiating the class that manages the db
$coche = new DBforms();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title ?></title>
</head>
<body>
    <?php

    function printVar ($var){
        echo '<pre>';
        print_r($var);
        echo '</pre>';
        return;
    }


        //get all the car makes and models
        $marcas_modelos = $coche -> obtenerMarcasModelos2(); //returns the result as an assoc array 
        //get all the makes
        $marcas = $coche->obtenerMarcas();
        //$marcas = asort($marcas); //not needed anymore for ordering in select statement
        echo "Resultado marcas:</br> ";
        printVar($marcas);
        //get only the car brands
        //$nombres_marcas = array_values($marcas);//see if I really need it
        //order the brands alphabetically
        //sort($nombres_marcas); //?? i get 1 instead of the sorted array => yes, bec sort() returns true, that is 1, not the sorted array
        //solved this problem by adding ORDER BY marca in the SELECT statement, so that the result from above is already sorted

        //get the brands from the array $marcas_modelos
        $r_marcas = array();
        function getMarcas($r_db){
            foreach($r_db as $mm){ //for each arr el
                $r_marcas[] = $mm['marca']; //add element to the array
            }
            //return the array of car brands without duplicate elements
            return array_unique($r_marcas);
        }

        $r_marcas_unique = getMarcas($marcas_modelos);

        printVar(getMarcas($marcas_modelos));

        // foreach($marcas_modelos as $mm){ //for each arr el
        //     $r_marcas[] = $mm['marca']; //add element to the array
        // }
        
        $fruits = array("1"=>"banana", "2"=>"apple", "3"=>"dog", "4"=>"cat");
 
        // Sorting the array by value
        asort($fruits);
        print_r($fruits);

        //print content of vars
        echo '<pre>';
        print_r($marcas_modelos);
        //print_r($marcas_modelos[0]['id_marca']).PHP_EOL;
        echo '<br/>';
        //print_r($marcas_modelos[0]['marca']).PHP_EOL;
        echo '<br/>';
        //echo "DB result for marcas: ";
        //print_r($marcas);
        echo '<br/>';
        //print_r($nombres_marcas);
        //print_r($_POST);
        echo '</pre>';
       
        //define the array to associate each car make with its models 
        //bidim assoc arr: Marca = arr of models ex: [Dacia] => Array([0] => Duster [1] => Sandero)
        $infoMarcas = array(); 
        //trying to get the car brands from the db result
        
        foreach ($marcas as $key => $value) {
            foreach($marcas_modelos as $mm){
                if ($value == $mm['marca']) {
                    $infoMarcas[$value][] = $mm['modelo'];
                    //$infoMarcas[$key][] = $mm['modelo'];
                }
            }
        }

        // foreach($marcas_modelos as $mm){
        //     switch ($mm['marca']) {
        //         case 'Dacia':
        //             $arr_marcas['Dacia'][] = $mm['modelo'];
        //             break;
        //         case 'Nissan':
        //             $arr_marcas['Nissan'][] = $mm['modelo'];
        //             break;
        //         case 'Opel':
        //             $arr_marcas['Opel'][] = $mm['modelo'];
        //             break;
        //         case 'Seat':
        //             $arr_marcas['Seat'][] = $mm['modelo'];
        //             break;
        //         case 'Skoda':
        //             $arr_marcas['Skoda'][] = $mm['modelo'];
        //             break;              
        //         default:
        //             # code...
        //             break;
        //     }
            //$arr_marcas[] = $mm['marca'];
        //}

        //we construct the bidim array by iterating through the assoc array from the db
        // foreach($marcas_modelos as $mm){
        //     switch ($mm['marca']) {
        //         case 'Dacia':
        //             $arr_marcas['Dacia'][] = $mm['modelo'];
        //             break;
        //         case 'Nissan':
        //             $arr_marcas['Nissan'][] = $mm['modelo'];
        //             break;
        //         case 'Opel':
        //             $arr_marcas['Opel'][] = $mm['modelo'];
        //             break;
        //         case 'Seat':
        //             $arr_marcas['Seat'][] = $mm['modelo'];
        //             break;
        //         case 'Skoda':
        //             $arr_marcas['Skoda'][] = $mm['modelo'];
        //             break;       
        //         default:
        //             # code...
        //             break;
        //     }
        //     //$arr_marcas[] = $mm['marca'];
        // }

        echo "Array marcas updated is: </br>";
        //var_dump($arr_marcas);
        printVar($infoMarcas);


        // $infoMarcas = array(
        //     'mercedes' => ['mercedes-1', 'mercedes-2', 'mercedes-3'],
        //     'seat' => ['leon-1', 'leon-2', 'leon-3']
        // );
        //printVar($infoMarcas);


    ?>
    <!-- select input for marcas -->
    <select name="marcas" id="marcas">
        <option value="" disabled selected>-- Escoge una marca</option>
        <?php foreach ($infoMarcas as $marca => $models) : ?>
            <option value="<?php echo $marca ?>" ><?php echo $marca ?></option>
        <?php endforeach; ?>
    </select>

    <!-- select input for modelos -->
    <select name="modelos" id="modelos" style="visibility: hidden">
    </select>
    
    <script id="marcas_coches" type="application/json"><?php echo json_encode($infoMarcas); ?></script>
    <script>
        var marcas_modelos = JSON.parse(document.getElementById("marcas_coches").innerHTML);
        var SELECT_MARCAS = document.getElementById("marcas");
        var SELECT_MODELOS = document.getElementById("modelos");

        SELECT_MARCAS.addEventListener('change', function() {
            var SMval = SELECT_MARCAS.value;
            if (SMval !== '') {
                SELECT_MODELOS.innerHTML = ''; //reset model select options
                SELECT_MODELOS.style.visibility = 'visible';
                for (let i = 0; i < marcas_modelos[SMval].length; i++) {
                    const el = marcas_modelos[SMval][i];
                    var option = document.createElement('option');
                    option.appendChild(document.createTextNode(marcas_modelos[SMval][i]));
                    option.value = marcas_modelos[SMval][i];
                    SELECT_MODELOS.appendChild(option);                   
                }
            }
        });
    </script>
</body>
</html>
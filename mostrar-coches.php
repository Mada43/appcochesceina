<?php
include "./templates/header.php";
include "./classes/class.forms.php";
include "./classes/class.db.php";
$page_title = "Mostrar coches";
?>
<?php
//creating the necessary objects
//instantiating the class that builds the form
$FormularioCeina = new CeinaForms();
//instantiating the class that manages the db
$enviarCoche = new DBforms();
?>

<button id="showData">Show User Data</button>
<div id="table-container"></div>




<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" src="ajax-script.js"></script>

<?php include "./templates/footer.php";
<?php
include "./templates/header.php";
include "./classes/class.forms.php";
include "./classes/class.db.php";
$page_title = "Vista coches";
?>
<?php
//creating the necessary objects
//instantiating the class that builds the form
$FormularioCeina = new CeinaForms();
//instantiating the class that manages the db
$enviarCoche = new DBforms();
?>

<div class="container">
    <!-- <h2>Show data from database on page load using php, ajax and jquery</h2> -->
    <h2>Coches - Vendedores</h2>
 
    <div id="customer-data">
    <img src="./assets/img/ajax-loader.gif">
</div>
<!-- <button id="showSeller">Mostrar vendedores</button> -->
<!-- <button id="showCars">Mostrar coches</button> -->
<div id="table-container"></div>
<div id="table-container2"></div>




<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- <script type="text/javascript" src="ajax-script.js"></script> -->
<script>
	$(document).ready(function(){
		
		$.ajax({
			url: 'ajax_get_data.php',
			success: function(data){
				
				$("#customer-data").html(data);
			}
		})
	});
</script>

<?php include "./templates/footer.php";
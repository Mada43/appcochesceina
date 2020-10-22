<?php

$page_title = "Get Model2 Test";

include "./templates/header.php";

$mysqli = new mysqli("localhost", "root", "", "bd_coches_v2");
if($mysqli->connect_error) {
  exit('Could not connect');
}

$sql = "SELECT id, modelo 
        FROM modelos
        WHERE marcas_id = ?";

$stmt = $mysqli->prepare($sql);
$stmt->bind_param("s", $_GET['q']);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($mid, $modelo);
$stmt->fetch();
$stmt->close();


?>

<div class="caja-contenedora">
    <h3 style="margin-top: 30px;"><?php echo $page_title ?></h3> 
    
    <hr> 
    
    
    <?php

        echo "<table>";
        echo "<tr>";
        echo "<th>CustomerID</th>";
        echo "<td>" . $mid . "</td>";
        echo "<th>CompanyName</th>";
        echo "<td>" . $modelo . "</td>";
        echo "</tr>";
        echo "</table>";
        
    ?>

<script>
// function showModel(str) {
//   var xhttp;    
//   if (str == "") {
//     document.getElementById("modelo").innerHTML = "";
//     return;
//   }
//   xhttp = new XMLHttpRequest();
//   xhttp.onreadystatechange = function() {
//     if (this.readyState == 4 && this.status == 200) {
//       document.getElementById("modelo").innerHTML = this.responseText;
//     }
//   };
//   xhttp.open("GET", "getcustomer.asp?q="+str, true);
//   xhttp.send();
// }
</script>

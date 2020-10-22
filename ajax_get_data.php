<?php
include "./classes/class.db.php";
//instantiating the class that manages the db
$coche = new DBforms();
echo ($coche->mostrarCochesVendedores());
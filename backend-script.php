<?php
$hostname     = "localhost";
$username     = "root";
$password     = "";
$databasename = "bd_coches_v2";
// Create connection
$conn = mysqli_connect($hostname, $username, $password,$databasename);
// Check connection
if (!$conn) {
    die("Unable to Connect database: " . mysqli_connect_error());
}
$db=$conn;
// fetch query - sellers
function fetch_data(){
    global $db;
     $query="SELECT id, modelos_id, combustible_id, dni from vendedores ORDER BY apellido_vendedor";
     $query2 =
              "SELECT bd_coches_v2.coches.id, 
                      bd_coches_v2.coches.modelos_id, 
                      bd_coches_v2.coches.combustible_id,
                      bd_coches_v2.coches.fecha_fabricacion,
                      bd_coches_v2.coches.precio,
                      bd_coches_v2.coches.vendedores_id,
                      bd_coches_v2.modelos.modelo,
                      bd_coches_v2.modelos.marcas_id,
                      bd_coches_v2.combustible.gasolina,
                      bd_coches_v2.combustible.diesel,
                      bd_coches_v2.combustible.electrico,
                      bd_coches_v2.combustible.hibrido,
                      bd_coches_v2.vendedores.nombre_vendedor,
                      bd_coches_v2.vendedores.apellido_vendedor,
                      bd_coches_v2.vendedores.dni,
                      bd_coches_v2.vendedores.localizacion_id,
                      bd_coches_v2.localizacion.direccion,
                      bd_coches_v2.localizacion.codigo_postal,
                      bd_coches_v2.localizacion.ciudades_id
                      bd_coches_v2.ciudades.ciudad,
                      bd_coches_v2.ciudades.pais
                FROM bd_coches_v2.coches
                  LEFT JOIN bd_coches_v2.modelos 
                    ON coches.modelos_id = modelos.id
                  LEFT JOIN bd_coches_v2.marcas
                    ON bd_coches_v2.modelos.marcas_id = bd_coches_v2.marcas.id
                  LEFT JOIN bd_coches_v2.combustible 
                    ON coches.combustible_id = combustible.id
                  LEFT JOIN bd_coches_v2.vendedores 
                    ON coches.vendedores_id = vendedores.id
                  LEFT JOIN bd_coches_v2.localizacion 
                    ON bd_coches_v2.vendedores.localizacion_id = bd_coches_v2.localizacion.id
                  LEFT JOIN bd_coches_v2.ciudades
                  ON bd_coches_v2.localizacion.ciudades_id = bd_coches_v2.ciudades.id
                      ";
     $exec=mysqli_query($db, $query);
     if(mysqli_num_rows($exec)>0){
       $row= mysqli_fetch_all($exec, MYSQLI_ASSOC);
       return $row;  
           
     }else{
       return $row=[];
     }
   }
   $fetchData= fetch_data();
   show_data($fetchData);
   ?>
   <?php
   function show_data($fetchData){
        echo '<table border="1">
           <tr>
               <th>S.N</th>
               <th>Apellidos</th>
               <th>Nombre</th>
               <th>DNI</th>
               <th>Edit</th>
               <th>Delete</th>
           </tr>';
        if(count($fetchData)>0){
         $sn=1;
         foreach($fetchData as $data){ 
        echo "<tr>
             <td>".$sn."</td>
             <td>".$data['apellido_vendedor']."</td>
             <td>".$data['nombre_vendedor']."</td>
             <td>".$data['dni']."</td>
             <td><a href='crud-form.php?edit=".$data['id']."'>Edit</a></td>
             <td><a href='crud-form.php?delete=".$data['id']."'>Delete</a></td>
          </tr>";
          
        $sn++; 
        }
      }else{
        
        echo "<tr>
           <td colspan='7'>No Data Found</td>
          </tr>"; 
      }
        echo "</table>";
   }
   ?>
   
   
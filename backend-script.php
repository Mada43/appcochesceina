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
// fetch query
function fetch_data(){
    global $db;
     $query="SELECT id, apellido_vendedor, nombre_vendedor, dni from vendedores ORDER BY apellido_vendedor";
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
   
   
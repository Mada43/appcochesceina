<?php

class DBforms {
    public $servername;
    public $username;
    public $password;
    public $myDB;
    //public $tablaVendedor = "vendedores";
    //public $tablaComprador = "compradores";
    //public $tablaPersona; //the person will be either seller or buyer

    public function __construct(
        $servername = 'localhost',
        $username = 'root',
        $password = '',
        $myDB = 'bd_coches_v2'
    ) {
        $this->servername = $servername;
        $this->username = $username;
        $this->password = $password;
        $this->myDB = $myDB;
    }

    //create the DB connection
    public function crearConexion()
    {
        return new mysqli(
            $this->servername,
            $this->username,
            $this->password,
            $this->myDB
        );
    }

    //test for connection errors
    public function hayError($conexion)
    {
        if ($conexion->connect_error) {
            die("La conexion ha fallado: " . $conexion->connect_error);
        }
    }

    //fct to display variable content
    public function displayVar($varToDisplay){
        echo '<pre>';
        print_r($varToDisplay);
        echo '</pre>';
        //echo '<pre>';
        //print_r($_FILES);
        //echo '</pre>';
    }

    //insert data into the db and keep/return the last inserted id 
    public function enviarCiudad(
        $datos, 
        $ciudad,
        $pais
        )
    {
        $miConexion = $this->crearConexion();
        $enviarCiudad = $miConexion->prepare(
            "INSERT INTO ciudades (
                ciudad,
                pais) 
            VALUES (?, ?)");
        if ($enviarCiudad === false) {
            die('La función prepare() no ha funcionado' . htmlspecialchars($miConexion->error));
        }
        
        //fct to bind the params - args: data types + the values to be put in the db record
        $bind_param = $enviarCiudad->bind_param(
            $datos,
            $ciudad,
            $pais
        );
        if ($bind_param === false) {
            // throw new Exception($miConexion->error_list);
            die('La función bind_param() no ha funcionado' . htmlspecialchars($enviarCiudad->error));
        }

        // Ejecute la query
        $execute = $enviarCiudad->execute();
        if ($execute === false) {
            // throw new Exception($miConexion->error_list);
            die('La función bind_param() no ha funcionado' . htmlspecialchars($enviarCiudad->error));
        }

        // Devuelvo el último valor añadido
        $id = $enviarCiudad->insert_id;

        // Cierro conexión
        $enviarCiudad->close();

        // Devuevlo el ID
        return $id;

    }

    //insert data into the db and keep/return the last inserted id 
    public function enviarLocalizacion(
        $datos, 
        $direccion,
        $codigo_postal,
        $ciudades_id
        )
    {
        $miConexion = $this->crearConexion();
        $enviarLocalizacion = $miConexion->prepare(
            "INSERT INTO localizacion (
                direccion,
                codigo_postal,
                ciudades_id) 
        VALUES (?, ?, ?)");
        
        //fct to bind the params - args: data types + the values to be put in the db record
        $enviarLocalizacion->bind_param(
            $datos,
            $direccion,
            $codigo_postal,
            $ciudades_id
        );

        // Compruebo si la conexión se establece bien
        if (!$enviarLocalizacion) {
            throw new Exception($miConexion->error_list);
        }

        // Ejecute la query
        $enviarLocalizacion->execute();
        
        // Compruebo si se envia y no hay error
        if (!$enviarLocalizacion) {
            throw new Exception($miConexion->error_list);
        }

        // Devuelvo el último valor añadido
        $id = $enviarLocalizacion->insert_id;

        // Cierro conexión
        $enviarLocalizacion->close();

        // Devuevlo el ID
        return $id;

    }

    
    //insert data into the db and keep/return the last inserted id 
    public function enviarVendedor(
        $datos, 
        $nombre,
        $apellidos,
        $dni,
        $localizacion_id
        )
    {
        $miConexion = $this->crearConexion();
        $enviarVendedor = $miConexion->prepare(
            "INSERT INTO vendedores (
                nombre_vendedor,
                apellido_vendedor,
                dni,
                localizacion_id) 
        VALUES (?, ?, ?, ?)");
        
        //fct to bind the params - args: data types + the values to be put in the db record
        $enviarVendedor->bind_param(
            $datos,
            $nombre,
            $apellidos,
            $dni,
            $localizacion_id
        );

        // Compruebo si la conexión se establece bien
        if (!$enviarVendedor) {
            throw new Exception($miConexion->error_list);
        }

        // Ejecute la query
        $enviarVendedor->execute();
        
        // Compruebo si se envia y no hay error
        if (!$enviarVendedor) {
            throw new Exception($miConexion->error_list);
        }

        // Devuelvo el último valor añadido
        $id = $enviarVendedor->insert_id;

        // Cierro conexión
        $enviarVendedor->close();

        // Devuevlo el ID
        return $id;
    }

    public function enviarComprador(
        $datos, 
        $nombre,
        $apellidos,
        $dni,
        $localizacion_id
        )
    {
        $miConexion = $this->crearConexion();
        $enviarComprador = $miConexion->prepare(
            "INSERT INTO compradores (
                nombre_comprador,
                apellido_comprador,
                dni,
                localizacion_id) 
        VALUES (?, ?, ?, ?)");
        
        //fct to bind the params - args: data types + the values to be put in the db record
        $enviarComprador->bind_param(
            $datos,
            $nombre,
            $apellidos,
            $dni,
            $localizacion_id
        );

        // Compruebo si la conexión se establece bien
        if (!$enviarComprador) {
            throw new Exception($miConexion->error_list);
        }

        // Ejecute la query
        $enviarComprador->execute();
        
        // Compruebo si se envia y no hay error
        if (!$enviarComprador) {
            throw new Exception($miConexion->error_list);
        }

        // Devuelvo el último valor añadido
        $id = $enviarComprador->insert_id;

        // Cierro conexión
        $enviarComprador->close();

        // Devuevlo el ID
        return $id;
    }

    //insert data into the db and keep/return the last inserted id 
    public function enviarCombustible(
        $datos, 
        $gasolina,
        $diesel,
        $electrico,
        $hibrido
        )
    {
        $miConexion = $this->crearConexion();
        $enviarCombustible = $miConexion->prepare(
            "INSERT INTO combustible (
                gasolina
                diesel,
                electrico,
                hibrido) 
            VALUES (?, ?, ?, ?)");
        
        //fct to bind the params - args: data types + the values to be put in the db record
        $enviarCombustible->bind_param(
            $gasolina,
            $diesel,
            $electrico,
            $hibrido
        );

        // Compruebo si la conexión se establece bien
        if (!$enviarCombustible) {
            throw new Exception($miConexion->error_list);
        }

        // Ejecute la query
        $enviarCombustible->execute();
        
        // Compruebo si se envia y no hay error
        if (!$enviarCombustible) {
            throw new Exception($miConexion->error_list);
        }

        // Devuelvo el último valor añadido
        $id = $enviarCombustible->insert_id;

        // Cierro conexión
        $enviarCombustible->close();

        // Devuevlo el ID
        return $id;
    }

    //insert data into the db and keep/return the last inserted id 
    public function enviarMarca(
        $datos, 
        $marca
        )
    {
        $miConexion = $this->crearConexion();
        $enviarMarca = $miConexion->prepare(
            "INSERT INTO marcas (
                marca) 
            VALUES (?)");
        
        //fct to bind the params - args: data types + the values to be put in the db record
        $enviarMarca->bind_param(
            $datos,
            $marca
        );

        // Compruebo si la conexión se establece bien
        if (!$enviarMarca) {
            throw new Exception($miConexion->error_list);
        }

        // Ejecute la query
        $enviarMarca->execute();
        
        // Compruebo si se envia y no hay error
        if (!$enviarMarca) {
            throw new Exception($miConexion->error_list);
        }

        // Devuelvo el último valor añadido
        $id = $enviarMarca->insert_id;

        // Cierro conexión
        $enviarMarca->close();

        // Devuevlo el ID
        return $id;
    }

    //insert data into the db and keep/return the last inserted id 
    public function enviarModelo(
        $datos, 
        $modelo,
        $id_marcas
        )
    {
        $miConexion = $this->crearConexion();
        $enviarModelo = $miConexion->prepare(
            "INSERT INTO modelos (
                modelo,
                marcas_id) 
            VALUES (?, ?)");
        
        //fct to bind the params - args: data types + the values to be put in the db record
        $enviarModelo->bind_param(
            $datos,
            $modelo,
            $id_marcas
        );

        // Compruebo si la conexión se establece bien
        if (!$enviarModelo) {
            throw new Exception($miConexion->error_list);
        }

        // Ejecute la query
        $enviarModelo->execute();
        
        // Compruebo si se envia y no hay error
        if (!$enviarModelo) {
            throw new Exception($miConexion->error_list);
        }

        // Devuelvo el último valor añadido
        $id = $enviarModelo->insert_id;

        // Cierro conexión
        $enviarModelo->close();

        // Devuevlo el ID
        return $id;
    }

    //insert data into the db and keep/return the last inserted id 
    public function enviarCoche(
        $datos, 
        $fabricacion, 
        $precio, 
        $id_vendedor, 
        //$id_comprador, 
        $id_combustible, 
        $id_modelo
        )
    {
        $miConexion = $this->crearConexion();
        $enviarCoche = $miConexion->prepare(
            "INSERT INTO coches ( 
                fecha_fabricacion,
                precio, 
                vendedores_id, 
                
                combustible_id,
                modelos_id
               ) 
        VALUES (?, ?, ?, ?, ?)");
        
        //fct to bind the params - args: data types + the values to be put in the db record
        $enviarCoche->bind_param(
            $datos,
            $fabricacion,
            $precio, 
            $id_vendedor, 
            //$id_comprador, 
            $id_combustible, 
            $id_modelo
        );

        // Compruebo si la conexión se establece bien
        if (!$enviarCoche) {
            throw new Exception($miConexion->error_list);
        }

        // Ejecute la query
        if (!$enviarCoche->execute()) {
            echo "Execute failed: (" . $enviarCoche->errno . ") " . $enviarCoche->error;
        }
        
        // Compruebo si se envia y no hay error
        if (!$enviarCoche) {
            throw new Exception($miConexion->error_list);
        }


        // Devuelvo el último valor añadido
        $id = $enviarCoche->insert_id;

        // Cierro conexión
        $enviarCoche->close();

        // Devuevlo el ID
        return $id;

    }

    //insert data into the db and keep/return the last inserted id 
    public function enviarCoche2( 
        $fabricacion, 
        $precio, 
        $id_vendedor, 
        $id_comprador, 
        $id_combustible, 
        $id_modelo
        )
    {
        $conn = $this->crearConexion();
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 
        $sql = "INSERT INTO coches (
                anio_produccion, 
                precio, 
                vendedores_id, 
                compradores_id, 
                combustible_id,
                modelos_id
               ) 
        VALUES ($fabricacion, 
                $precio, 
                $id_vendedor, 
                $id_comprador, 
                $id_combustible, 
                $id_modelo)";
        
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
          } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
          }

          // Devuelvo el último valor añadido
            $id = $conn->insert_id;
          
          $conn->close();
        

        
        // Devuevlo el ID
        return $id;

    }

    //insert data into the db and keep/return the last inserted id 
    public function enviarMedia(
        $datos, 
        $path, 
        $mime_type, 
        $file_size =null 
        )
    {
        $miConexion = $this->crearConexion();
        $enviarMedia = $miConexion->prepare(
            "INSERT INTO MEDIA (
                path_media, 
                mime_type, 
                file_size
                )
            VALUES (?, ?, ?)");
        //fct to bind the params - args: data types + the values to be put in the db record
        $enviarMedia->bind_param(
            $datos,
            $path,
            $mime_type,
            $file_size
        );

        // Compruebo si la conexión se establece bien
        if (!$enviarMedia) {
            throw new Exception($miConexion->error_list);
        }

        // Ejecute la query
        $enviarMedia->execute();
        
        // Compruebo si se envia y no hay error
        if (!$enviarMedia) {
            throw new Exception($miConexion->error_list);
        }

        // Devuelvo el último valor añadido
        $id = $enviarMedia->insert_id;

        // Cierro conexión
        $enviarMedia->close();

        // Devuevlo el ID
        return $id;

    }

    //insert the ids into the many-to-many TABLE1_HAS_TABLE2 table
    public function enviarCochesMedia($datos, 
        $idCoche, 
        $idMedia)
    {
        $msg = "Expecting result...";
        $miConexion = $this->crearConexion();
        $enviarCocheMedia = $miConexion->prepare("INSERT INTO coches_media (coches_id, media_id) VALUES (?, ?)");
        $enviarCocheMedia->bind_param(
            $datos,
            $idCoche,
            $idMedia
        );

        // Compruebo si la conexión se establece bien
        if (!$enviarCocheMedia) {
            throw new Exception($miConexion->error_list);
        }

        // Ejecute la query
        $enviarCocheMedia->execute();

        // Compruebo si se envia y no hay error
        if (!$enviarCocheMedia) {
            throw new Exception($miConexion->error_list);
        } else {
            $msg = "Successfully inserted data into coches_media";
        }

        // Devuelvo el último valor añadido para el id (autoincremented primary key)
        //$id = $enviarOficinaMedia->insert_id;

        // Cierro conexión
        $enviarCocheMedia->close();
        return $msg;
    }


    //insert data into the db and keep/return the last inserted id 
    public function enviarTransaccion(
        $datos, 
        $created_at
        )
    {
        $miConexion = $this->crearConexion();
        $enviarTransaccion = $miConexion->prepare(
            "INSERT INTO transacciones (
                created_at) 
            VALUES (?)");
        
        //fct to bind the params - args: data types + the values to be put in the db record
        $enviarTransaccion->bind_param(
            $datos,
            $created_at
        );

        // Compruebo si la conexión se establece bien
        if (!$enviarTransaccion) {
            throw new Exception($miConexion->error_list);
        }

        // Ejecute la query
        $enviarTransaccion->execute();
        
        // Compruebo si se envia y no hay error
        if (!$enviarTransaccion) {
            throw new Exception($miConexion->error_list);
        }

        // Devuelvo el último valor añadido
        $id = $enviarTransaccion->insert_id;

        // Cierro conexión
        $enviarTransaccion->close();

        // Devuevlo el ID
        return $id;

    }

    //insert data into the db and keep/return the last inserted id 
    public function enviarCochesTransacciones(
        $datos, 
        $id_coche,
        $id_transaccion
        )
    {
        $miConexion = $this->crearConexion();
        $enviarCochesTransacciones = $miConexion->prepare(
            "INSERT INTO coches_transacciones (
                coches_id,
                transacciones_id) 
            VALUES (?, ?)");
        
        //fct to bind the params - args: data types + the values to be put in the db record
        $enviarCochesTransacciones->bind_param(
            $datos,
            $id_coche,
            $id_transaccion
        );

        // Compruebo si la conexión se establece bien
        if (!$enviarCochesTransacciones) {
            throw new Exception($miConexion->error_list);
        }

        // Ejecute la query
        $enviarCochesTransacciones->execute();
        
        // Compruebo si se envia y no hay error
        if (!$enviarCochesTransacciones) {
            throw new Exception($miConexion->error_list);
        }

        // Devuelvo el último valor añadido
        $id = $enviarCochesTransacciones->insert_id;

        // Cierro conexión
        $enviarCochesTransacciones->close();

        // Devuevlo el ID
        return $id;

    }

    //get data from DB
     public function obtenerCiudades()
    {
        // ESTABLECER CONEXION
        $miConexion = $this->crearConexion();

        // PREPARAR QUERY
        $prepare = $miConexion->prepare("SELECT id, ciudad, pais FROM ciudades");

        // COMPROBAR SI HAY ERROR
        if (!$prepare) {
            var_dump($miConexion->error_list);
        }

        // EJECUTAR
        $prepare->execute();

        // BIND RESULT
        $prepare->bind_result($id, $ciudad, $pais);

        // FETCH RESULT
        $miArray = array();
        while ($prepare->fetch()) {
            $miArray[$id] = $ciudad . " - " . $pais;
        }
       
        // CLOSE CONNECTION
        $miConexion->close();

        return $miArray;
    }
    
    //get data from DB
    public function obtenerMarcas()
    {
        // ESTABLECER CONEXION
        $miConexion = $this->crearConexion();

        // PREPARAR QUERY
        $prepare = $miConexion->prepare("SELECT id, marca FROM marcas ORDER BY marca");

        // COMPROBAR SI HAY ERROR
        if (!$prepare) {
            var_dump($miConexion->error_list);
        }

        // EJECUTAR
        $prepare->execute();

        // BIND RESULT
        $prepare->bind_result($id, $marca);

        // FETCH RESULT
        $miArray = array();
        while ($prepare->fetch()) {
            $miArray[$id] = $marca;
        }
       
        // CLOSE CONNECTION
        $miConexion->close();

        return $miArray;
    }
    
    //get data from DB - modelos
    public function obtenerModelos()
    {
        // ESTABLECER CONEXION
        $miConexion = $this->crearConexion();

        // PREPARAR QUERY
        $prepare = $miConexion->prepare(
            "SELECT id, modelo 
            FROM modelos
            ");

        // COMPROBAR SI HAY ERROR
        if (!$prepare) {
            var_dump($miConexion->error_list);
        }

        // EJECUTAR
        $prepare->execute();

        // BIND RESULT
        $prepare->bind_result($id, $modelo);

        // FETCH RESULT
        $miArray = array();
        while ($prepare->fetch()) {
            $miArray[$id] = $modelo;
        }
       
        // CLOSE CONNECTION
        $miConexion->close();

        return $miArray;
    }
    
    //get data from DB - modelos
    public function obtenerModelos2()
    {
        // ESTABLECER CONEXION
        $miConexion = $this->crearConexion();

        // PREPARAR QUERY
        $prepare = $miConexion->prepare(
            "SELECT id, modelo 
            FROM modelos
            WHERE marcas_id = ?");
        
        //
        $prepare->bind_param("s", $_GET['q']);

        // COMPROBAR SI HAY ERROR
        if (!$prepare) {
            var_dump($miConexion->error_list);
        }

        // EJECUTAR
        $prepare->execute();

        //
        $prepare->store_result();

        // BIND RESULT
        $prepare->bind_result($id, $modelo);

        // FETCH RESULT
        $miArray = array();
        while ($prepare->fetch()) {
            $miArray[$id] = $modelo;
        }
       
        // CLOSE CONNECTION
        $miConexion->close();

        return $miArray;
    }   

    public function obtenerCombustible()
    {
        // ESTABLECER CONEXION
        $miConexion = $this->crearConexion();

        // PREPARAR QUERY
        $prepare = $miConexion->prepare("SELECT id, gasolina, diesel, electrico, hibrido FROM combustible");

        // COMPROBAR SI HAY ERROR
        if (!$prepare) {
            var_dump($miConexion->error_list);
        }

        // EJECUTAR
        $prepare->execute();

        // BIND RESULT
        $prepare->bind_result($id, $gasolina, $diesel, $electrico, $hibrido);

        // FETCH RESULT
        $miArray = array();
        while ($prepare->fetch()) {
            // switch ($id) {
            //     case '1':
            //         $miArray[$id] = "gasolina";
            //         break;

            //     case '2':
            //         $miArray[$id] = "diesel";
            //         break;
                    
            //     case '3':
            //         $miArray[$id] = "electrico";
            //         break;

            //     case '4':
            //         $miArray[$id] = "hibrido";
            //         break;
                
            //     default:
            //         # code...
            //         break;
            // }
            if($gasolina == 1){
                $miArray[$id] = "gasolina";
            }
            else if($diesel == 1){
                $miArray[$id] = "diesel";
            }
            else if($electrico == 1){
                $miArray[$id] = "electrico";
            }
            else//($electrico = 1)
            {
                $miArray[$id] = "hibrido";
            }
            //$miArray[$id] = $id . $gasolina . $diesel . $electrico . $hibrido; //here we need only the ids, we will have a switch statement in the form??
            
        }

        //$columns = array_keys($miArray[1]);//here it is an INT, not an array!!

        //echo '<pre>';
        //print_r($miArray);
        //print_r($columns);
        echo '</pre>';
        // CLOSE CONNECTION
        $miConexion->close();

        

        return $miArray;
    }

    //get data from DB
    public function obtenerVendedores()
    {
        // ESTABLECER CONEXION
        $miConexion = $this->crearConexion();

        // PREPARAR QUERY
        $prepare = $miConexion->prepare("SELECT id, nombre_vendedor, apellido_vendedor, dni FROM vendedores");
        if ($prepare === false) {
            die('La función prepare() no ha funcionado' . htmlspecialchars($miConexion->error));
        }
        
        // EJECUTAR
        $success_prepare = $prepare->execute();
        if ($success_prepare === false) {
            die('La función execute() no ha funcionado' . htmlspecialchars($miConexion->error));
        }

        // BIND RESULT
        $Success_prepare = $prepare->bind_result($id, $nombre, $apellidos, $dni);
        if ($Success_prepare === false) {
            die('La función bind() no ha funcionado' . htmlspecialchars($miConexion->error));
        }

        // FETCH RESULT
        $miArray = array();
        while ($prepare->fetch()) {
            $miArray[$id] = $nombre . " - " . $apellidos . " - DNI: " . $dni;
        }
       
        // CLOSE CONNECTION
        $miConexion->close();

        return $miArray;
    }

    //get data from DB
    public function obtenerCompradores()
    {
        // ESTABLECER CONEXION
        $miConexion = $this->crearConexion();

        // PREPARAR QUERY
        $prepare = $miConexion->prepare(
            "SELECT id, nombre_comprador, apellido_comprador, dni 
            FROM compradores");

        // COMPROBAR SI HAY ERROR
        if (!$prepare) {
            var_dump($miConexion->error_list);
        }

        // EJECUTAR
        $prepare->execute();

        // BIND RESULT
        $prepare->bind_result($id, $nombre, $apellidos, $dni);

        // FETCH RESULT
        $miArray = array();
        while ($prepare->fetch()) {
            $miArray[$id] = $nombre . " - " . $apellidos . " - DNI: " . $dni;
        }
       
        // CLOSE CONNECTION
        $miConexion->close();

        return $miArray;
    }

    //get data from DB VIEW coches_vendedores
    public function mostrarCochesVendedores()
    {
        // ESTABLECER CONEXION
        $miConexion = $this->crearConexion();

        // PREPARAR QUERY - we select all columns from a VIEW created in the DB
        $prepare = $miConexion->prepare(
            "SELECT *
            FROM coches_vendedores");

        // COMPROBAR SI HAY ERROR
        if (!$prepare) {
            var_dump($miConexion->error_list);
        }

        // EJECUTAR
        $prepare->execute();

        // BIND RESULT
        $prepare->bind_result($id, 
            $marca,
            $modelo, 
            $combustible, 
            $fecha_fabricacion, 
            $precio,
            $id_vendedor,
            $nombre,
            $apellido,
            $dni,
            $direccion,
            $codigo_postal,
            $ciudad,
            $pais
        );

        // FETCH RESULT
        // $miArray = array();
        // while ($prepare->fetch()) { //fetch results from a prepared statement into the bound variables
        //     $miArray[$id] = $nombre . " - " . $apellidos . " - DNI: " . $dni;
        // }
       
        $r = $prepare->get_result();
        //$res = $prepare->fetch();
        $fetchAllData = $r->fetch_all(MYSQLI_ASSOC);

        $createTable = '<table>';
        $createTable.='<tr>';
        //table header
        $createTable .= '<th>ID Coche</th>';
        $createTable .= '<th>Marca</th>';
        $createTable .= '<th>Modelo</th>';
        $createTable .= '<th>Combustible</th>';
        $createTable .= '<th>Año fabricación</th>';
        $createTable .= '<th>Precio</th>';
        $createTable .= '<th>ID Vendedor</th>';
        $createTable .= '<th>Nombre Vendedor</th>';
        $createTable .= '<th>Apellidos Vendedor</th>';
        $createTable .= '<th>DNI</th>';
        $createTable .= '<th>Direccion</th>';
        $createTable .= '<th>Codigo postal</th>';
        $createTable .= '<th>Ciudad</th>';
        $createTable .= '<th>Pais</th>';
        $createTable .= '</tr>';

        foreach($fetchAllData as $customerData) {
            $createTable .= '<tr>';
            $createTable .= '<td>'.$customerData['id'].'</td>';
            $createTable .= '<td>'.$customerData['marca'].'</td>';
            $createTable .= '<td>'.$customerData['modelo'].'</td>';
            $createTable .= '<td>'.$customerData['Combustible'].'</td>';
            $createTable .= '<td>'.$customerData['fecha_fabricacion'].'</td>';
            $createTable .= '<td>'.$customerData['precio'].'</td>';
            $createTable .= '<td>'.$customerData['vendedores_id'].'</td>';
            $createTable .= '<td>'.$customerData['nombre_vendedor'].'</td>';
            $createTable .= '<td>'.$customerData['apellido_vendedor'].'</td>';
            $createTable .= '<td>'.$customerData['dni'].'</td>';
            $createTable .= '<td>'.$customerData['direccion'].'</td>';
            $createTable .= '<td>'.$customerData['codigo_postal'].'</td>';
            $createTable .= '<td>'.$customerData['ciudad'].'</td>';
            $createTable .= '<td>'.$customerData['pais'].'</td>';
            $createTable .= '</tr>';
        }
 
        $createTable .= '</table>';
 
        //echo $createTable;

        // CLOSE CONNECTION
        //$r->close();
        $miConexion->close();
            //var_dump($r); object(mysqli_result)#4 (5) 
            //{ ["current_field"]=> int(0) ["field_count"]=> int(14) ["lengths"]=> NULL ["num_rows"]=> int(4) ["type"]=> int(0) } 
    
        return $createTable;
    }


    public function show_data($fetchData)
    {
        echo '<table border="1">
           <tr>
               <th>ID Coche</th>
               <th>Año fabricación</th>
               <th>Precio</th>
               <th>Modelo</th>
               <th>Marca</th>
               <th>Combustible</th>
               <th>ID Vendedor</th>
               <th>Nombre Vendedor</th>
               <th>Apellidos Vendedor</th>
               <th>DNI</th>
               <th>Direccion</th>
               <th>Codigo postal</th>
               <th>Ciudad</th>
               <th>Pais</th>
               <th>Edit</th>
               <th>Delete</th>
           </tr>';
        if(count($fetchData)>0){
         //$sn=1;
         foreach($fetchData as $data){ 
        echo "<tr>
                    <td>".$data['id']."</td>
                    <td>".$data['fecha_fabricacion']."</td>
                    <td>".$data['precio']."</td>
                    <td>".$data['modelo']."</td>
                    <td>".$data['marca']."</td>
                    <td>".$data['Combustible']."</td>
                    <td>".$data['vendedores_id']."</td>
                    <td>".$data['nombre_vendedor']."</td>
                    <td>".$data['apellido_vendedor']."</td>
                    <td>".$data['dni']."</td>
                    <td>".$data['direccion']."</td>
                    <td>".$data['codigo_postal']."</td>
                    <td>".$data['ciudad']."</td>
                    <td>".$data['pais']."</td>
            </tr>";
          
        //$sn++; 
        }
      }else{
        
        echo "<tr>
           <td colspan='7'>No Data Found</td>
          </tr>"; 
      }
        echo "</table>";
    }

   //get data from DB VIEW coches_vendedores
   public function obtenerMarcasModelos($choice)
   {
       // ESTABLECER CONEXION
       $miConexion = $this->crearConexion();

       // PREPARAR QUERY - we select all columns from a VIEW created in the DB
       $prepare = $miConexion->prepare(
           "SELECT *
           FROM marca_modelo
           WHERE id='$choice'");

       // COMPROBAR SI HAY ERROR
       if (!$prepare) {
           var_dump($miConexion->error_list);
       }

       // EJECUTAR
       $prepare->execute();

       // BIND RESULT
       $prepare->bind_result($id, 
                               $marca,
                               $modelo
                            );

       // FETCH RESULT
       // $miArray = array();
       // while ($prepare->fetch()) { //fetch results from a prepared statement into the bound variables
       //     $miArray[$id] = $nombre . " - " . $apellidos . " - DNI: " . $dni;
       // }
      
       $r = $prepare->get_result();
       //$res = $prepare->fetch();
       $fetchAllData = $r->fetch_all(MYSQLI_ASSOC);

 
        //echo $createTable;

        // CLOSE CONNECTION
        //$r->close();
        $miConexion->close();
           //var_dump($r); object(mysqli_result)#4 (5) 
           //{ ["current_field"]=> int(0) ["field_count"]=> int(14) ["lengths"]=> NULL ["num_rows"]=> int(4) ["type"]=> int(0) } 
   
        //while ($row = mysql_fetch_array($result)) {
        //echo "<option>" . $row{'dd_val'} . "</option>";
        return $fetchAllData;
    }


    //get data from DB VIEW coches_vendedores
   public function obtenerMarcasModelos2()
   {
       // ESTABLECER CONEXION
       $miConexion = $this->crearConexion();

       // PREPARAR QUERY - we select all columns from a VIEW created in the DB
       $prepare = $miConexion->prepare(
           "SELECT *
           FROM marca_modelo
           ");

       // COMPROBAR SI HAY ERROR
       if (!$prepare) {
           var_dump($miConexion->error_list);
       }

       // EJECUTAR
       $prepare->execute();

       // BIND RESULT
       $prepare->bind_result($id_marca, 
                               $marca,
                               $id_modelo,
                               $modelo
                            );

       // FETCH RESULT
       // $miArray = array();
       // while ($prepare->fetch()) { //fetch results from a prepared statement into the bound variables
       //     $miArray[$id] = $nombre . " - " . $apellidos . " - DNI: " . $dni;
       // }
      
       $r = $prepare->get_result();
       //$res = $prepare->fetch();
       $fetchAllData = $r->fetch_all(MYSQLI_ASSOC);

 
        //echo $createTable;

        // CLOSE CONNECTION
        //$r->close();
        $miConexion->close();
           //var_dump($r); object(mysqli_result)#4 (5) 
           //{ ["current_field"]=> int(0) ["field_count"]=> int(14) ["lengths"]=> NULL ["num_rows"]=> int(4) ["type"]=> int(0) } 
   
        //while ($row = mysql_fetch_array($result)) {
        //echo "<option>" . $row{'dd_val'} . "</option>";
        return $fetchAllData;
    }
       
   


}
   





//TO DELETE AFTER



    // public function obtenerTrabajadores()
    // {
    //     // ESTABLECER CONEXION
    //     $miConexion = $this->crearConexion();

    //     // PREPARAR QUERY
    //     $prepare = $miConexion->prepare("SELECT id, nombre, apellidos FROM TRABAJADORES");

    //     // COMPROBAR SI HAY ERROR
    //     if (!$prepare) {
    //         var_dump($miConexion->error_list);
    //     }

    //     // EJECUTAR
    //     $prepare->execute();

    //     // BIND RESULT
    //     $prepare->bind_result($id, $nombre, $apellidos);

    //     // FETCH RESULT
    //     $miArray = array();
    //     while ($prepare->fetch()) {
    //         $miArray[$id] = $nombre . " " . $apellidos;
    //     }
       
    //     // CLOSE CONNECTION
    //     $miConexion->close();

    //     return $miArray;
    // }




    //get data from DB
    // public function obtenerOficinas()
    // {
    //     // ESTABLECER CONEXION
    //     $miConexion = $this->crearConexion();

    //     // PREPARAR QUERY
    //     $prepare = $miConexion->prepare("SELECT id, nombre FROM OFICINA");

    //     // COMPROBAR SI HAY ERROR
    //     if (!$prepare) {
    //         var_dump($miConexion->error_list);
    //     }

    //     // execute the prepared sql query
    //     $prepare->execute();

    //     // BIND RESULT
    //     $prepare->bind_result($id, $nombre);

    //     // FETCH RESULT
    //     $miArray = array();
    //     while ($prepare->fetch()) {
    //         $miArray[$id] = $nombre;
    //     }
       
    //     // CLOSE CONNECTION
    //     $miConexion->close();

    //     return $miArray;
    // }

    
//}

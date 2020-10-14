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
        $myDB = 'bd_coches'
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
        
        //fct to bind the params - args: data types + the values to be put in the db record
        $enviarCiudad->bind_param(
            $datos,
            $ciudad,
            $pais
        );

        // Compruebo si la conexión se establece bien
        if (!$enviarCiudad) {
            throw new Exception($miConexion->error_list);
        }

        // Ejecute la query
        $enviarCiudad->execute();
        
        // Compruebo si se envia y no hay error
        if (!$enviarCiudad) {
            throw new Exception($miConexion->error_list);
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
            "INSERT INTO marca (
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
        $marca, 
        $modelo, 
        $combustible, 
        $precio, 
        $vendedores_id, 
        $compradores_id,
        $combustible_id,
        $modelos_id
        )
    {
        $miConexion = $this->crearConexion();
        $enviarCoche = $miConexion->prepare(
            "INSERT INTO coches (
                marca, 
                modelo, 
                combustible, 
                precio, 
                vendedores_id,
                compradores_id,
                combustible_id,
                modelos_id) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        
        //fct to bind the params - args: data types + the values to be put in the db record
        $enviarCoche->bind_param(
            $datos,
            $marca,
            $modelo, 
            $combustible, 
            $precio, 
            $vendedores_id, 
            $compradores_id,
            $combustible_id,
            $modelos_id
        );

        // Compruebo si la conexión se establece bien
        if (!$enviarCoche) {
            throw new Exception($miConexion->error_list);
        }

        // Ejecute la query
        $enviarCoche->execute();
        
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
    public function enviarMedia(
        $datos, 
        $path, 
        $mime_type = null, 
        $file_size =null, 
        $id_coche)
    {
        $miConexion = $this->crearConexion();
        $enviarMedia = $miConexion->prepare(
            "INSERT INTO MEDIA (
                path_media, 
                mime_type, 
                file_size,
                coches_id)
            VALUES (?, ?, ?, ?)");
        //fct to bind the params - args: data types + the values to be put in the db record
        $enviarMedia->bind_param(
            $datos,
            $path,
            $mime_type,
            $file_size,
            $id_coche
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
        $enviarCocheMedia = $miConexion->prepare("INSERT INTO coches_has_media (coches_id, media_id) VALUES (?, ?)");
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
            $msg = "Successfully inserted data into coches_has_media";
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
        $id_vendedor,
        $id_comprador,
        $id_transaccion
        )
    {
        $miConexion = $this->crearConexion();
        $enviarCochesTransacciones = $miConexion->prepare(
            "INSERT INTO coches_has_transacciones (
                coches_id,
                coches_vendedores_id,
                coches_compradores_id,
                transacciones_id) 
            VALUES (?, ?, ?, ?)");
        
        //fct to bind the params - args: data types + the values to be put in the db record
        $enviarCochesTransacciones->bind_param(
            $datos,
            $id_coche,
            $id_vendedor,
            $id_comprador,
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

    
}

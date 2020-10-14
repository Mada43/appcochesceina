<?php

class CeinaForms {
    public $errores;
    public $mensajes_error;
    public $datosRecibidos;
    public $fotoRecibida;
    public $path_media;
    public $dir_subida;
    public $dir_proyecto;

    public $fichero_subido;

    public $array_mime_types;
    public $array_extensiones_permitidas;

    public function __construct()
    {
        $this->errores = false;
        $this->dir_subida = getcwd() . '/tmp/';
        $this->dir_proyecto = '/tmp/';
        $this->array_mime_types = array('image/png', 'image/jpeg', 'image/jpg', 'image/gif');
        $this->array_extensiones_permitidas = array('png', 'jpeg', 'jpg', 'gif');

        $this->fichero_subido = null;
    }

    public function enviarFormulario($datos, $files = null)
    {
        $this->datosRecibidos = $datos;
        // Utilizar la función reset(); me permite coger el primer valor de un
        // array asociativo.
        if($files == null){} else {$this->fotoRecibida = reset($files);}

        
    }

    // private function validarTipo($type)
    // {
    //     if (in_array($type, ['text', 'number', 'checkbox', 'select'])) {
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }

    public function showInput($type, $id, $name, $placeholder, $label, $validacion, $options = null, $multiple = null)
    {
        
        switch ($type) {
            case 'text':
                return $this->getTypeInput($type, $id, $name, $placeholder, $label, $validacion);
                break;
            
            case 'number':
                return $this->getTypeInputNumber($type, $id, $name, $placeholder, $label, $validacion);
                break;

            case 'checkbox':
                return $this->getTypeCheckbox($type, $id, $name, $placeholder, $label, $validacion);
                break;

            case 'select':
                return $this->getTypeSelect($type, $id, $name, $placeholder, $label, $validacion, $options, $multiple);
                break;

            case 'file':
                return $this->getTypeFile($type, $id, $name, $placeholder, $label, $validacion);
                break;


            default:
                # code...
                break;
        }
    }

    //TEXT input
    private function getTypeInput($type, $id, $name, $placeholder, $label, $validacion)
    {
        $classes = "input input-text";
        $miDato = "";
        $esValido = null;
        if ($validacion) {
            $miDato = $this->sanitizacion($this->datosRecibidos[$name], $type);
            $esValido = $this->validacion($miDato, $type);

            if ($esValido) {
                $classes .= " valid-input";
            } else {
                $classes .= " error-input";
                $this->errores = true;
            }
        }

        $textInput = '<div class="grupo">';
        $textInput .= '<label class="label" for="' . $id . '">';
        $textInput .= $label;
        $textInput .= '</label>';
        $textInput .= '<input value="' . $miDato . '" type="text" name="' . $name . '" id="' . $id . '" placeholder="' . $placeholder . '" class="' . $classes . '" />';
        if ($miDato && $esValido) {
            $textInput .= '<p class="success small">Datos validos.</p>';
        }
        if ($esValido === false) {
            $textInput .= '<p class="error small">Por favor, revisa el campo. El dato esta vacio o no es valido.</p>';
        }
        $textInput .= '</div>';
        echo $textInput;
    }

    //NUMBER input
    private function getTypeInputNumber($type, $id, $name, $placeholder, $label, $validacion)
    {
        $classes = "input input-number";
        $miDato = "";
        $esValido = null;
        if ($validacion) {
            $miDato = $this->sanitizacion($this->datosRecibidos[$name], $type);
            $esValido = $this->validacion($miDato, $type);

            if ($esValido) {
                $classes .= " valid-input";
            } else {
                $classes .= " error-input";
                $this->errores = true;
            }
        }

        $textInput = '<div class="grupo">';
        $textInput .= '<label class="label" for="' . $id . '">';
        $textInput .= $label;
        $textInput .= '</label>';
        $textInput .= '<input value="' . $miDato . '" type="number" name="' . $name . '" id="' . $id . '" placeholder="' . $placeholder . '" class="' . $classes . '" />';
        if ($miDato && $esValido) {
            $textInput .= '<p class="success small">Datos validos.</p>';
        }
        if ($esValido === false) {
            $textInput .= '<p class="error small">Por favor, revisa el campo. El dato esta vacio o no es valido.</p>';
        }
        $textInput .= '</div>';
        echo $textInput;
    }

    //FILE UPLOAD input
    private function getTypeFile($type, $id, $name, $placeholder=null, $label=null, $validacion)
    {
        $classes = "input input-file";
        $miDato = "";
        $esValido = null;
        //$fichero_subido = null;
        if ($validacion && $this->fotoRecibida) {

            //$fichero_subido = $this->dir_subida . basename($this->fotoRecibida['name']);
            $this->fichero_subido = $this->dir_subida . basename($this->fotoRecibida['name']);
            $this->path_media = $this->dir_proyecto . basename($this->fotoRecibida['name']);
            //$fichero_extension = pathinfo($fichero_subido, PATHINFO_EXTENSION);
            $fichero_extension = pathinfo($this->fichero_subido, PATHINFO_EXTENSION);
            if (
                !in_array($this->fotoRecibida['type'], $this->array_mime_types) ||
                !in_array($fichero_extension, $this->array_extensiones_permitidas)
            ) {
                $classes .= " error-input";
                $this->errores = true;
                // throw new Exception("Hay un error de validación con el fichero que has seleccionado");
                // return "";
            }

            $nuevoNombre = $this->escanearDirectorio(basename($this->fotoRecibida['name']));


            //move_uploaded_file($this->fotoRecibida['tmp_name'], $fichero_subido);
            if (move_uploaded_file($this->fotoRecibida['tmp_name'], $this->fichero_subido)){
                $classes .= " valid-input";
                //return $this->fichero_subido;
            }
        }

        $textInput = '<div class="grupo">';
        $textInput .= '<label class="label" for="' . $id . '">';
        $textInput .= $label;
        $textInput .= '</label>';
        $textInput .= '<input type="file" name="' . $name . '" id="' . $id . '" placeholder="' . $placeholder . '" class="' . $classes . '" accept="image/png, image/jpeg, image/jpeg, image/gif"/>';
        if ($miDato && $esValido) {
            $textInput .= '<p class="success small">Datos validos.</p>';
        }
        if ($esValido === false) {
            $textInput .= '<p class="error small">Por favor, revisa el campo. El dato esta vacio o no es valido.</p>';
        }
        $textInput .= '</div>';
        echo $textInput;
    }

    //CHECKBOX input
    private function getTypeCheckbox($type, $id, $name, $placeholder, $label, $validacion)
    {
        $classes = "input input-checkbox";
        $isChecked = "";
        if ($validacion && in_array($name, array_keys($this->datosRecibidos))) {
                $isChecked = "checked";
                $classes .= " valid-input";
        }

        $checkBox = '<div class="grupo grupo-checkbox">';
        $checkBox .= '<input ' . $isChecked . ' type="checkbox" name="' . $name . '" id="' . $id . '" placeholder="' . $placeholder . '" class="' . $classes . '"/>';
        $checkBox .= '<label class="label" for="' . $id . '">';
        $checkBox .= $label;
        $checkBox .= '</label>';
        // if ($esValido) {
        //     $checkBox .= '<p class="success small">Datos validos.</p>';
        // } else {
        //     $checkBox .= '<p class="error small">Por favor, revisa el campo. El dato esta vacio o no es valido.</p>';
        // }
        $checkBox .= '</div>';
        echo $checkBox;
    }

    //simple (not multiple) SELECT input
    private function getTypeSelect($type, $id, $name, $placeholder, $label, $validacion, $options, $multiple = false)
    {
        $classes = "input input-select";
        $mensaje_validacion = "";
        $isSelected = false;
        $valor_seleccionado = "";
        
        if ($multiple) {
            $valor_seleccionado = array();
        }

        if ($validacion && in_array($name, array_keys($this->datosRecibidos))) {
            $valor_seleccionado = $this->datosRecibidos[$name];//store the selected option

            if ($multiple) {
                $arrayValoresSeleccionados = array_values($valor_seleccionado);//take the values and store them
                $arrayEnviado = array_keys($options);
                $resultado = array_intersect($arrayValoresSeleccionados, $arrayEnviado);
                
                if (count($resultado) === count($arrayValoresSeleccionados)) {
                    $classes .= " valid-input";
                    $mensaje_validacion = '<p class="success small">Datos validos.</p>';
                    $isSelected = true;
                } else {
                    $classes .= " error-input";
                    $mensaje_validacion = '<p class="error small">Alguno de los datos esta mal, por favor revisa los datos seleccionados.</p>';
                    $this->errores = true;
                }
            } else {
                if (in_array($valor_seleccionado, array_keys($options))) {
                    $classes .= " valid-input";
                    $mensaje_validacion = '<p class="success small">Datos validos.</p>';
                    $isSelected = true;
                } else {
                    $classes .= " error-input";
                    $mensaje_validacion = '<p class="error small">Alguno de los datos esta mal, por favor revisa los datos seleccionados.</p>';
                    $this->errores = true;
                }
            }
        }

        $select = '<div class="grupo grupo-select">';
        //the label
        $select .= '<label class="label" for="' . $id . '">';
        $select .= $label; //text for the label
        $select .= '</label>';
        //the select element
        $select .= '<select ' . ($multiple ? 'multiple' : '') . ' id="' . $id . '" name="' . $name . '" class="' . $classes . '">';
        $select .= '<option disabled' . ($isSelected === false ? ' selected' : "") . '>-- Por favor seleccionar una opción</option>';
        foreach ($options as $key => $value) {
            if ($multiple) {
                $select .= '<option value="' . $key . '"' . (in_array($key, array_values($valor_seleccionado)) ? ' selected' : "") . '>' . $value . '</option>';
            } else {
                $select .= '<option value="' . $key . '"' . ($valor_seleccionado === $key ? ' selected' : "") . '>' . $value . '</option>';
            }
        }
        $select .= '</select>';
        $select .= $mensaje_validacion;
        $select .= '</div>';
        echo $select;
    }

    //MULTIPLE SELECT input
    // private function getTypeSelect($type, $id, $name, $placeholder, $label, $validacion, $options, $multiple)
    // {
    //     $classes = "input input-select";
    //     $mensaje_validacion = "";
    //     $isSelected = false;
    //     $valor_seleccionado = "";
        
    //     if ($multiple) {
    //         $valor_seleccionado = array();
    //     }

    //     if ($validacion && in_array(str_replace('[]', '', $name), array_keys($this->datosRecibidos))) {
    //         $valor_seleccionado = $this->datosRecibidos[str_replace('[]', '', $name)];

    //         if ($multiple) {
    //             $arrayValoresSeleccionados = array_values($valor_seleccionado);
    //             $arrayEnviado = array_keys($options);
    //             $resultado = array_intersect($arrayValoresSeleccionados, $arrayEnviado);
                
    //             if (count($resultado) === count($arrayValoresSeleccionados)) {
    //                 $classes .= " valid-input";
    //                 $mensaje_validacion = '<p class="success small">Datos validos.</p>';
    //                 $isSelected = true;
    //             } else {
    //                 $classes .= " error-input";
    //                 $mensaje_validacion = '<p class="error small">Alguno de los datos esta mal, por favor revisa los datos seleccionados.</p>';
    //                 $this->errores = true;
    //             }
    //         } else {
    //             if (in_array($valor_seleccionado, array_keys($options))) {
    //                 $classes .= " valid-input";
    //                 $mensaje_validacion = '<p class="success small">Datos validos.</p>';
    //                 $isSelected = true;
    //             } else {
    //                 $classes .= " error-input";
    //                 $mensaje_validacion = '<p class="error small">Alguno de los datos esta mal, por favor revisa los datos seleccionados.</p>';
    //                 $this->errores = true;
    //             }
    //         }
    //     }

    //     $select = '<div class="grupo grupo-select">';
    //     $select .= '<label class="label" for="' . $id . '">';
    //     $select .= $label;
    //     $select .= '</label>';
    //     $select .= '<select ' . ($multiple ? 'multiple' : '') . ' id="' . $id . '" name="' . $name . '" class="' . $classes . '">';
    //     $select .= '<option disabled' . ($isSelected === false ? ' selected' : "") . '>-- Por favor seleccionar una opción</option>';
    //     foreach ($options as $key => $value) {
    //         if ($multiple) {
    //             $select .= '<option value="' . $key . '"' . (in_array($key, array_values($valor_seleccionado)) ? ' selected' : "") . '>' . $value . '</option>';
    //         } else {
    //             $select .= '<option value="' . $key . '"' . ($valor_seleccionado === $key ? ' selected' : "") . '>' . $value . '</option>';
    //         }
    //     }
    //     $select .= '</select>';
    //     $select .= $mensaje_validacion;
    //     $select .= '</div>';
    //     echo $select;
    // }

    //SANITIZACION
    private function sanitizacion($valor, $tipo)
    {
        switch ($tipo) {
            case 'text':
                $filter = FILTER_SANITIZE_STRING;
                break;

            case 'number':
                $filter = FILTER_SANITIZE_NUMBER_INT;
                break;

            case 'file':
                $filter = FILTER_SANITIZE_STRING;
                break;
            
            default:
                # code...
                break;
        }
        return filter_var($valor, $filter);
    }

    //VALIDACION
    private function validacion($valor, $tipo)
    {
        switch ($tipo) {
            case 'text':
                return $valor !== '' ? true : false;
                break;

            case 'number':
                return $valor !== '' ? true : false;
                break;

            case 'file':
                return $valor !== '' ? true : false;
                break;
            
            default:
                # code...
                break;
        }
    }

    //CHECK ERRORS VARIABLE
    public function hayErrores()
    {
        return $this->errores;
    }

    //SCAN FOLDER TO SEE IF A FILE EXISTS
    private function escanearDirectorio($nombreArchivo)
    {
        $ficherosDirectorio = scandir($this->dir_subida);
        echo '<pre>';
        print_r($ficherosDirectorio);
        print_r($nombreArchivo);
        echo '</pre>';

        if (in_array($nombreArchivo, $ficherosDirectorio)) {
            echo "ESTOY EN EL DIRECTORIO NO ME GUARDES";
        } else {
            echo "GUARDAMEEEEE";
        }
    }
}
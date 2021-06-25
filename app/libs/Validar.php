<?php

/**
 * Clase para realizar validaciones en el modelo
 * Es utilizada para realizar validaciones en el modelo de nuestras clases.
 *
 */

class Validar
{

    protected $_atributos;

    protected $_error;

    public $mensaje;

    /**
     * Metodo para indicar la regla de validacion
     * El método retorna un valor verdadero si la validación es correcta, de lo contrario retorna el objeto
     * actual, permitiendo acceder al atributo Validacion::$mensaje ya que es publico
     */
    public function rules($rule = array(), $data)
    {
        
        if (! is_array($rule)) {
            $this->mensaje = "las reglas deben de estar en formato de arreglo";
            return $this;
        }
        foreach ($rule as $key => $rules) {
            $reglas = explode(',', $rules['regla']);
            if (array_key_exists($rules['name'], $data)) {
                foreach ($data as $indice => $valor) {
                    if ($indice === $rules['name']) {
                        foreach ($reglas as $clave => $valores) {
                            $validator = $this->_getInflectedName($valores);
                            if (! is_callable(array(
                                $this,
                                $validator
                            ))) {
                                throw new BadMethodCallException("No se encontro el metodo $valores");
                            }
                            $respuesta = $this->$validator($rules['name'], $valor);
                        }
                        break;
                    }
                }
            } else {
                
                $this->mensaje[$rules['name']] = "el campo {$rules['name']} no esta dentro de la regla de validación o en el formulario";
            }
        }
        if (!empty($this->mensaje)) {
            return $this;
        } else {
            return true;
        }
    }

    /*
     * Metodo inflector de la clase
     * por medio de este metodo llamamos a las reglas de validacion que se generen
     */
    private function _getInflectedName($text)
    {
        $validator = "";
        $_validator = preg_replace('/[^A-Za-z0-9]+/', ' ', $text);
        $arrayValidator = explode(' ', $_validator);
        if (count($arrayValidator) > 1) {
            foreach ($arrayValidator as $key => $value) {
                if ($key == 0) {
                    $validator .= "_" . $value;
                } else {
                    $validator .= ucwords($value);
                }
            }
        } else {
            $validator = "_" . $_validator;
        }
        
        return $validator;
    }

    /**
     * Metodo de verificacion de que el dato no este vacio o NULL
     * El metodo retorna un valor verdadero si la validacion es correcta de lo contrario retorna un valor falso
     * y llena el atributo validacion::$mensaje con un arreglo indicando el campo que mostrara el mensaje y el
     * mensaje que visualizara el usuario
     */
    protected function _noEmpty($campo, $valor)
    {
        if (isset($valor) && ! empty($valor)) {
            return true;
        } else {
            $this->mensaje[$campo][] = "el campo $campo debe de estar lleno";
            return false;
        }
    }

    /**
     * Metodo de verificacion de tipo numerico
     * El metodo retorna un valor verdadero si la validacion es correcta de lo contrario retorna un valor falso
     * y llena el atributo validacion::$mensaje con un arreglo indicando el campo que mostrara el mensaje y el
     * mensaje que visualizara el usuario
     */
    protected function _numeric($campo, $valor)
    {
        if (is_numeric($valor)) {
            return true;
        } else {
            $this->mensaje[$campo][] = "el campo $campo debe de ser numerico";
            return false;
        }
    }

    /**
     * Metodo de verificacion de tipo email
     * El metodo retorna un valor verdadero si la validacion es correcta de lo contrario retorna un valor falso
     * y llena el atributo validacion::$mensaje con un arreglo indicando el campo que mostrara el mensaje y el
     * mensaje que visualizara el usuario
     */
    protected function _email($campo, $valor)
    {
        if (filter_var($valor,FILTER_VALIDATE_EMAIL)) {
            return true;
        } else {
            $this->mensaje[$campo][] = "el campo $campo debe estar en el formato de email usuario@servidor.com";
            return false;
        }
    }
    /*
     * VALIDAR FORMULARIO DE REGISTRO 
     */
    protected function _usuario($campo, $valor)
    {
        if(cUsuario($valor)){
            return true;
        }else{
            $this->mensaje[$campo][] = "El campo $campo está mal escrito";
        }
    }
    
    protected function _clave($campo, $valor){
        if(cClave($valor)){
            return true;
        }else{
            $this->mensaje[$campo][] = "El campo $campo está mal escrito";
        }
    }
    
    protected function _nombreUsuario($campo, $valor){
        if(cNombre($valor)){
            return true;
        }else{
            $this->mensaje[$campo][] = "El campo $campo está mal escrito";
        }
    }
    
    protected function _apellidosUsuario($campo, $valor){
        if(cApellidos($valor)){
            return true;
        }else{
            $this->mensaje[$campo][] = "El campo $campo está mal escrito";
        }
    }
    
    protected function _fecha($campo, $valor){
        if(cFecha($valor)){
            return true;
        }else{
            $this->mensaje[$campo][] = "El campo $campo está mal escrito";
        }
    }
    
    protected function _bio($campo, $valor){
        if(cBio($valor)){
            return true;
        }else{
            $this->mensaje[$campo][] = "El campo $campo está mal escrito";
        }
    }
    
    protected function _permiso($campo, $valor){
        if($valor == 1 || $valor == 2 || $valor == 3){
            return true;
        }else{
            $this->mensaje[$campo][] = "El campo $campo está mal escrito";
        }
    }
    
    protected function _titulo($campo, $valor)
    {
        if(cTitulo($valor)){
            return true;
        }else{
            $this->mensaje[$campo][] = "El campo $campo está mal escrito";
        }
    }
    
    protected function _texto($campo, $valor){
        if(cTexto($valor)){
            return true;
        }else{
            $this->mensaje[$campo][] = "El campo $campo está mal escrito";
        }
    }
}

/*
 * Ejemplo de uso de la clase, es muy sencillo.  
 */ 
/*
$datos['campo1'] = "d";
$datos['campo2'] = "usuario@gmail.com";
$datos['nombre'] = "Aj3424dsf asdaskj";

$validacion = new Validar();
$regla = array(

    array(
        'name' => 'nombre',
        'regla' => 'no-empty,usuario'
    )
    
);
$validaciones = $validacion->rules($regla, $datos);

if(!isset($validacion->mensaje)){
    echo "NO HAY ERROR";
}else{
    foreach ($validaciones->mensaje as $mensaje=>$i){
        echo $validaciones->mensaje[$mensaje][0].'<br>';
    }
}



*/

?>

<?php
namespace App;
class ActiveRecord {
    protected static $db;
    protected static $columnasDB = [];
    protected static $errores = [];
    protected static $tabla = '';
    
    public static function setDB($db) {
        self::$db = $db;
    }
    
    public function guardar() {
        if(!is_null($this->id)) {
            $this->actualizar();
        } else {
            $this->crear();
        }
    }
    public function actualizar() {
        $atributos = $this->sanitizarDatos();
        $valores = [];
        foreach($atributos as $key => $value) {
            $valores[] = "{$key}='{$value}'";
        }
        $query = "UPDATE ". static::$tabla ." SET ";// 
        $query .= join(', ',$valores);
        $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
        $query .= " LIMIT 1;"; 
        $resultado = self::$db->query($query);
        if($resultado) {
            //Redireccionar
            header('Location: /admin?resultado=2');
        }
    } 
    public function crear() {
        $atributos = $this->sanitizarDatos();
        $query = "INSERT INTO ". static::$tabla ." ( ";
        $query .= join(', ', array_keys($atributos));
        $query .= " ) VALUES (' "; 
        $query .= join("', '", array_values($atributos));
        $query .= " ');"; 
        $resultado = self::$db->query($query);
        if($resultado) {
            //Redireccionar
            header('Location: /admin?resultado=1');
        }
    }
    public function eliminar() {
        $query = "DELETE FROM ". static::$tabla ." WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1;";
        $resultado = self::$db->query($query);
        if($resultado){
            $this->borrarImagen();
            header('Location: /admin?resultado=3');
        }
    }
    //une atributos
    public function atributos() {
        $atributos = [];
        foreach(static::$columnasDB as $columna) {
            if($columna === 'id') continue;
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }
    public function sanitizarDatos() {
        $atributos = $this->atributos();
        $sanitizado = [];
        foreach($atributos as $key => $value) {
            $sanitizado[$key] = self::$db->escape_string($value);
        }
        return $sanitizado;
    }
    //subir archivos
    public function setImagen($imagen) {
        //eliminar si es actualizar
        if(!is_null($this->id)) {
            $this->borrarImagen();
        }
        if($imagen) {
            $this->imagen = $imagen;
        }
    }
    public function borrarImagen() {
        //comprobar si existe el archivo
        $existe = file_exists(CARPETA_IMG . $this->imagen);
        if($existe) {
            unlink(CARPETA_IMG . $this->imagen);
        }
    }
    //validacion
    public static function getErrores() {
        return static::$errores;
    }
    public function validar() {
        static::$errores = [];
        return static::$errores;
    }
    //select propiedades
    public static function all() {
        $query = "SELECT * FROM " . static::$tabla;
        $res = self::consultarSQL($query);
        return $res;
    }
    public static function get($cantidad) {
        $query = "SELECT * FROM " . static::$tabla . " LIMIT " . $cantidad;
        $res = self::consultarSQL($query);
        return $res;
    }
    //buscar por id
    public static function find($id) {
        $query = "SELECT * FROM " . static::$tabla ." WHERE id = $id;";
        $resultado = self::consultarSQL($query);
        return array_shift($resultado);
    }
    public static function consultarSQL($query) {
        $resultado = self::$db->query($query);
        $array = [];
        while($registro = $resultado->fetch_assoc()) {
            $array[] = static::crearObjeto($registro);
        }
        //liberar memoria
        $resultado->free();
        return $array;
    }
    protected static function crearObjeto($registro) {
        $objeto = new static;
        foreach($registro as $key => $value) {
            if(property_exists($objeto, $key)) {
                $objeto->$key = $value; 
            }
        }
        return $objeto;
    }
    public function sincronizar($args) {
        foreach($args as $key => $value) {
            if(property_exists($this, $key) && !is_null($value)){
                $this->$key = $value;
            }
        }
    }
}
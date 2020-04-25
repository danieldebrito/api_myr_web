<?php
class cards {
    public static function readAll(){
        try {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
            $consulta = $objetoAccesoDato->RetornarConsulta
            (
                "SELECT * FROM `cards` WHERE 1"
        );
            $consulta->execute();
            $ret = $consulta->fetchAll(PDO::FETCH_CLASS);

        } catch (Exception $e) {
            $mensaje = $e->getMessage();
            $respuesta = array("Estado" => "ERROR", "Mensaje" => "$mensaje");
        } finally {
            return $ret;
        }
    }

    public function readParams($linea, $marca, $combustible, $motor, $modelo, $cilindrada, $competicion, $producto, $aplicacion){

        $instruccionSQL = 'SELECT * FROM `cards` WHERE 1';

        if ($linea != null) {
            $instruccionSQL = $instruccionSQL . ' AND ' . 'linea = ' . "'" . $linea . "'";
        }

        if ($marca != null) {
            $instruccionSQL = $instruccionSQL . ' AND ' . ' marca = ' . "'" . $marca . "'";
        }

        if ($combustible != null) {
            $instruccionSQL = $instruccionSQL . ' AND ' . 'combustible = ' . "'" . $combustible . "'";
        }

        if ($motor != null) {
            $instruccionSQL = $instruccionSQL . ' AND ' . 'motor = ' . "'" . $motor . "'";
        }

        if ($modelo != null) {
            $instruccionSQL = $instruccionSQL . ' AND ' . 'modelo = ' . "'" . $modelo . "'";
        }

        if ($cilindrada != null) {
            $instruccionSQL = $instruccionSQL . ' AND ' . 'cilindrada = ' . "'" . $cilindrada . "'";
        }

        if ($competicion != null) {
            $instruccionSQL = $instruccionSQL . ' AND ' . 'competicion = ' . "'" . $competicion . "'";
        }

        if ($producto != null) {
            $instruccionSQL = $instruccionSQL . ' AND ' . 'producto = ' . "'" . $producto . "'";
        }

        if ($aplicacion != null) {
            $instruccionSQL = $instruccionSQL . ' AND ' . 'aplicacion = ' . "'" . $aplicacion . "'";
        }


        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("
			$instruccionSQL
		");
        $consulta->execute();

        return $consulta->fetchAll(PDO::FETCH_CLASS);
    }

    public static function readById ($id_articulo){
        try {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
            $consulta = $objetoAccesoDato->RetornarConsulta
            (
                "SELECT * FROM `cards` WHERE `id_articulo` LIKE "."'%"."$id_articulo"."%'"
        );

            $consulta->execute();
            $ret = $consulta->fetchAll(PDO::FETCH_CLASS);

        } catch (Exception $e) {
            $mensaje = $e->getMessage();
            $respuesta = array("Estado" => "ERROR", "Mensaje" => "$mensaje");
        } finally {
            return $ret;
        }
    }

    public static function buscarPorFrase ($frase){

        $fraseArray = explode(" ", $frase);

       $instruccionSQL = 'SELECT * FROM `cards` WHERE 1';

        foreach ($fraseArray  as &$item ) {
            $instruccionSQL = $instruccionSQL.
            " AND CONCAT(`marca`,`modelo`,`motor`,`cilindrada`,`producto`,`aplicacion`,`aplicacionEspecifica`) 
            LIKE "."'"."%".$item.'%'."'";
        } try {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
            $consulta = $objetoAccesoDato->RetornarConsulta
            ("$instruccionSQL");

            // var_dump($instruccionSQL);

            $consulta->execute();
            $ret = $consulta->fetchAll(PDO::FETCH_CLASS);

        } catch (Exception $e) {
            $mensaje = $e->getMessage();
            $respuesta = array("Estado" => "ERROR", "Mensaje" => "$mensaje");
        } finally {
            return $ret;
        }
        

    }
}



/*

SELECT * 
FROM `cards` 
WHERE CONCAT(`marca`,`modelo`,`cilindrada`,`producto`,`aplicacion`,`aplicacionEspecifica`) LIKE '%FORD%'
AND CONCAT(`marca`,`modelo`,`cilindrada`,`producto`,`aplicacion`,`aplicacionEspecifica`)
LIKE '%FOCUS%'
AND CONCAT(`marca`,`modelo`,`cilindrada`,`producto`,`aplicacion`,`aplicacionEspecifica`)
LIKE '%5%'


*/
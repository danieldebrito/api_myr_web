<?php
class art_mar_mod_mot{
    public static function readAll(){
        try {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
            $consulta = $objetoAccesoDato->RetornarConsulta
            (
                "SELECT * FROM `artmarmodmot` WHERE 1"
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

        $instruccionSQL = 'SELECT * FROM `artmarmodmot` WHERE 1';

        if ($linea != null) {
            $instruccionSQL = $instruccionSQL . ' AND ' . 'id_linea = ' . "'" . $linea . "'";
        }

        if ($marca != null) {
            $instruccionSQL = $instruccionSQL . ' AND ' . ' id_marca = ' . "'" . $marca . "'";
        }

        if ($combustible != null) {
            $instruccionSQL = $instruccionSQL . ' AND ' . 'id_combustible = ' . "'" . $combustible . "'";
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
            $instruccionSQL = $instruccionSQL . ' AND ' . 'id_producto = ' . "'" . $producto . "'";
        }

        if ($aplicacion != null) {
            $instruccionSQL = $instruccionSQL . ' AND ' . 'id_aplicacion = ' . "'" . $aplicacion . "'";
        }

        $instruccionSQL = $instruccionSQL . ' LIMIT 1000';

        // var_dump('</br></br> <b>INSTRUCCION SQL: </b>'.$instruccionSQL);

        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("
			$instruccionSQL
		");
        $consulta->execute();

        return $consulta->fetchAll(PDO::FETCH_CLASS);
    }
}

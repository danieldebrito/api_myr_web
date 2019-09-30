<?php
class art_mar_mod_mot{
    public static function readAll(){
        try {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
            $consulta = $objetoAccesoDato->RetornarConsulta
            ("SELECT art.id_articulo, mar.id_linea, mar.id_marca, mot.id_combustible, 
            mot.motor , mam.modelo, mot.cilindrada, art.competicion, art.id_producto, 
            art.id_aplicacion
            FROM art_mar_mod_mot amo, mar_mod_mot mmm, articulos art, mar_mod mam, motores mot, marcas mar
            WHERE amo.id_motor = mmm.id_motor
            AND mam.id_mar_mod = mmm.id_mar_mod
            AND mot.id_motor = mmm.id_motor
            AND mar.id_marca = mam.id_marca
            AND amo.id_articulo = SUBSTRING(art.id_articulo, 1, 7)
            LIMIT 1000
			");
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

        $instruccionSQL =
        'SELECT art.id_articulo, mar.id_linea, mar.id_marca, mot.id_combustible, 
        mot.motor , mam.modelo, mot.cilindrada, art.competicion, art.id_producto, 
        art.id_aplicacion
        FROM art_mar_mod_mot amo, mar_mod_mot mmm, articulos art, mar_mod mam, motores mot, marcas mar
        WHERE amo.id_motor = mmm.id_motor
        AND mam.id_mar_mod = mmm.id_mar_mod
        AND mot.id_motor = mmm.id_motor
        AND mar.id_marca = mam.id_marca
        AND amo.id_articulo = SUBSTRING(art.id_articulo, 1, 7)';

        if ($linea != null) {
            $instruccionSQL = $instruccionSQL . ' AND ' . 'mar.id_linea = ' . "'" . $linea . "'";
        }

        if ($marca != null) {
            $instruccionSQL = $instruccionSQL . ' AND ' . ' mar.id_marca = ' . "'" . $marca . "'";
        }

        if ($combustible != null) {
            $instruccionSQL = $instruccionSQL . ' AND ' . 'mot.id_combustible = ' . "'" . $combustible . "'";
        }

        if ($motor != null) {
            $instruccionSQL = $instruccionSQL . ' AND ' . 'mot.motor = ' . "'" . $motor . "'";
        }

        if ($modelo != null) {
            $instruccionSQL = $instruccionSQL . ' AND ' . 'mam.modelo = ' . "'" . $modelo . "'";
        }

        if ($cilindrada != null) {
            $instruccionSQL = $instruccionSQL . ' AND ' . 'mot.cilindrada = ' . "'" . $cilindrada . "'";
        }

        if ($competicion != null) {
            $instruccionSQL = $instruccionSQL . ' AND ' . 'art.competicion = ' . "'" . $competicion . "'";
        }

        if ($producto != null) {
            $instruccionSQL = $instruccionSQL . ' AND ' . 'art.id_producto = ' . "'" . $producto . "'";
        }

        if ($aplicacion != null) {
            $instruccionSQL = $instruccionSQL . ' AND ' . 'art.id_aplicacion = ' . "'" . $aplicacion . "'";
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

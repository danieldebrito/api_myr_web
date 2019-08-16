<?php
class art_mar_mod_mot
{

    public static function readAll()
    {
        try {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
            $consulta = $objetoAccesoDato->RetornarConsulta
            ("SELECT art.id_articulo, mar.marca, mot.id_combustible, amo.id_motor, mam.modelo, mot.cilindrada, mar.id_linea, art.competicion, art.id_producto, art.id_aplicacion
            FROM art_mar_mod_mot amo, mar_mod_mot mmm, articulos art, mar_mod mam, motores mot, marcas mar
            WHERE amo.id_motor = mmm.id_motor
            AND mam.id_mar_mod = mmm.id_mar_mod
            AND mot.id_motor = mmm.id_motor
            AND mar.id_marca = mam.id_marca
            AND amo.id_articulo = SUBSTRING(art.id_articulo, 1, 7)
            LIMIT 30
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

    public function readParams($id_linea, $id_marca, $id_combustible, $id_motor, $modelo, $cilindrada, $competicion, $id_producto, $id_aplicacion)
    {

        $instruccionSQL =
        'SELECT art.id_articulo, mar.id_linea, mar.id_marca, mot.id_combustible, amo.id_motor, 
        mam.modelo, mot.cilindrada, art.competicion, art.id_producto, art.id_aplicacion
        FROM art_mar_mod_mot amo, mar_mod_mot mmm, articulos art, mar_mod mam, motores mot, marcas mar
        WHERE amo.id_motor = mmm.id_motor
        AND mam.id_mar_mod = mmm.id_mar_mod
        AND mot.id_motor = mmm.id_motor
        AND mar.id_marca = mam.id_marca
        AND amo.id_articulo = SUBSTRING(art.id_articulo, 1, 7)';

        if ($id_linea != null) {
            $instruccionSQL = $instruccionSQL . ' AND ' . 'mar.id_linea = ' . "'" . $id_linea . "'";
        }

        if ($id_marca != null) {
            $instruccionSQL = $instruccionSQL . ' AND ' . ' mar.id_marca = ' . "'" . $id_marca . "'";
        }

        if ($id_combustible != null) {
            $instruccionSQL = $instruccionSQL . ' AND ' . 'mot.id_combustible = ' . "'" . $id_combustible . "'";
        }

        if ($id_motor != null) {
            $instruccionSQL = $instruccionSQL . ' AND ' . 'amo.id_motor = ' . "'" . $id_motor . "'";
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

        if ($id_producto != null) {
            $instruccionSQL = $instruccionSQL . ' AND ' . 'art.id_producto = ' . "'" . $id_producto . "'";
        }

        if ($id_aplicacion != null) {
            $instruccionSQL = $instruccionSQL . ' AND ' . 'art.id_aplicacion = ' . "'" . $id_aplicacion . "'";
        }

        $instruccionSQL = $instruccionSQL . ' LIMIT 30';

        var_dump('</br></br> <b>INSTRUCCION SQL: </b>'.$instruccionSQL);

        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("
			$instruccionSQL
		");
        $consulta->execute();

        return $consulta->fetchAll(PDO::FETCH_CLASS);
    }
}

/*

public static function read($id_producto){
try {
$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
$consulta = $objetoAccesoDato->RetornarConsulta("
SELECT *
FROM `productos`
WHERE `id_producto` = '$id_producto'
");
$consulta->execute();
$ret = $consulta->fetchObject('producto');
} catch (Exception $e) {
$mensaje = $e->getMessage();
$respuesta = array("Estado" => "ERROR", "Mensaje" => "$mensaje");
} finally {
return $ret;
}
}

public function create()
{
try {
$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
$consulta = $objetoAccesoDato->RetornarConsulta("
INSERT INTO `productos`
(`id_producto`,
`id_sector`,
`producto`,
`tiempo_preparacion`,
`precio`)
VALUES (
:id_producto,
:id_sector,
:producto,
:tiempo_preparacion,
:precio)
");

$consulta->bindValue(':id_producto', $this->id_producto, PDO::PARAM_STR);
$consulta->bindValue(':id_sector', $this->id_sector, PDO::PARAM_STR);
$consulta->bindValue(':producto', $this->producto, PDO::PARAM_STR);
$consulta->bindValue(':tiempo_preparacion', $this->tiempo_preparacion, PDO::PARAM_INT);
$consulta->bindValue(':precio', $this->precio, PDO::PARAM_INT);

$consulta->execute();
} catch (Exception $e) {
$mensaje = $e->getMessage();
$respuesta = array("Estado" => "ERROR", "Mensaje" => "$mensaje");
} finally {
return $objetoAccesoDato->RetornarUltimoIdInsertado();
}
}

public static function delete($id_producto){
try {
$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
$consulta = $objetoAccesoDato->RetornarConsulta("
DELETE FROM `productos`
WHERE `id_producto` = '$id_producto'
");
$consulta->bindValue(':id_producto', $id_producto, PDO::PARAM_STR);
$consulta->execute();
$respuesta = array("Estado" => true, "Mensaje" => "Eliminado Correctamente");

} catch (Exception $e) {
$mensaje = $e->getMessage();
$respuesta = array("Estado" => false, "Mensaje" => "$mensaje");

} finally {
return $respuesta;
}
}

public function update()
{
$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
$consulta = $objetoAccesoDato->RetornarConsulta("
UPDATE `productos`
SET
`id_sector`=:id_sector,
`producto`=:producto,
`tiempo_preparacion`=:tiempo_preparacion,
`precio`=:precio
WHERE id_producto=:id_producto");

$consulta->bindValue(':id_producto', $this->id_producto, PDO::PARAM_STR);
$consulta->bindValue(':id_sector', $this->id_sector, PDO::PARAM_STR);
$consulta->bindValue(':producto', $this->producto, PDO::PARAM_STR);
$consulta->bindValue(':tiempo_preparacion', $this->tiempo_preparacion, PDO::PARAM_INT);
$consulta->bindValue(':precio', $this->precio, PDO::PARAM_INT);

return $consulta->execute();
}
 */

<?php

declare (strict_types=1);

namespace Com\Daw2\Models;

class ProveedoresModel extends \Com\Daw2\Core\BaseModel {

    //Devuelve todos los proveedores
    function allProveedor(): array {
        $stmt = $this->pdo->query('SELECT * FROM proveedor');
        return $stmt->fetchAll();
    }
    
    function proveedores(): array {
        $stmt = $this->pdo->query('SELECT cif, nombre FROM proveedor');
        return $stmt->fetchAll();
    }

    //Funcion que borra proveedores
    function borrar($get): array {
        //Creamos un array que contiene si hay errores y un mensaje;
        $mensaje = [];
        //preparamos la query
        $query = $this->pdo->prepare("DELETE FROM proveedor where cif like :cif");

        //Iniciamos el try catch
        try {
            $query->execute(
                    [
                        'cif' => $get['borrado'],
                    ]
            );
        } catch (\PDOException $ex) {
            //Si obtenemos algun error lo capturamos y mostramos  returnamos el error
            $mensaje['error'] = true;
            $mensaje['mensaje'] = "No se ha podido borrar el proveedor";
            return $mensaje;
        }
        //Todo ha salido bien y returnamos el mensaje
        $mensaje['error'] = false;
        $mensaje['mensaje'] = "Se ha borrado el proveedor correctamente";
        return $mensaje;
    }

    //Funcion para insertar proveedores
    function insert($get): array {
        $mensaje = [];
        $vacio = false;
        //comprobamos que se introduzcan todos los datos. Si no es asi enviamos el mensaje de error
        foreach ($get as $key => $value) {
            if (empty($value)) {
                $vacio = true;
                $mensaje['error'] = true;
                $mensaje['mensaje'] = "Faltan datos en el update";
                return $mensaje;
            }
        }


        //Realizamos una consulta para saber cuantos si ya hay algun cif igual al que se ingresa.
        //Si esto es asi se devuelve un mensaje de error
        $aux = $this->pdo->prepare("SELECT count(cif) FROM proveedor where cif like :cif");
        $aux->execute([
            'cif' => $get['cif']
        ]);
        $consulta = $aux->fetchAll();

        if ($consulta[0]['count(cif)'] > 0) {
            $mensaje['error'] = true;
            $mensaje['mensaje'] = "El cif esta duplicado";
            return $mensaje;
        }

        //Realizamos la consulta si todo ha salido bien
        $query = $this->pdo->prepare("INSERT INTO proveedor (cif,codigo,nombre,direccion,website,pais,email) values(:cif,:codigo,:nombre,:direccion,:website,:pais,:email)");
        try {
            $query->execute(
                    [
                        'cif' => $get['cif'],
                        'codigo' => $get['codigo'],
                        'nombre' => $get['nombre'],
                        'direccion' => $get['direccion'],
                        'website' => $get['website'],
                        'pais' => $get['pais'],
                        'email' => $get['email']
                    ]
            );
        } catch (\PDOException $ex) {
            //returnamos un mensaje si es que ha habido algun erro inesperado
            $mensaje['error'] = true;
            $mensaje['mensaje'] = "Ha ocurrido un error inesperado";
            return $mensaje;
        }

        $mensaje['error'] = false;
        $mensaje['mensaje'] = "Se ha insertado correctamente";
        return $mensaje;
    }

    //Funcion que obtiene los datos de un usuario con respecto a un cif
    function datos($get) {
        $query = $this->pdo->prepare('SELECT *  FROM proveedor where cif = :cif');
        $query->execute(
                [
                    'cif' => $get['editar'],
                ]
        );
        return $query->fetchAll();
    }

    //Funcion para cambiar los datos de un proveedor
    function cambios($get): array {
        $mensaje = [];

        //comprobacionesDatos($get);
        //Intentamos realizar los cambios, si esto da error returnamos un mensaje de error, si no returnamos que todo se ha realizado correctamente
        $query = $this->pdo->prepare('UPDATE proveedor
                SET cif = :cif, codigo = :codigo, nombre = :nombre, direccion = :direccion, website = :website, pais = :pais, email = :email
                WHERE cif = :cifAntiguo');
        try {
            $query->execute(
                    [
                        'cif' => $get['cif'],
                        'codigo' => $get['codigo'],
                        'nombre' => $get['nombre'],
                        'direccion' => $get['direccion'],
                        'website' => $get['website'],
                        'pais' => $get['pais'],
                        'email' => $get['email'],
                        'cifAntiguo' => $get['cifAntiguo']
                    ]
            );
        } catch (\PDOException $ex) {
            $mensaje['error'] = true;
            $mensaje['mensaje'] = "Los cambios no se han podido realizar";
            return $mensaje;
        }
        $mensaje['error'] = false;
        $mensaje['mensaje'] = "Los cambios se ha realizado con exito";
        return $mensaje;
    }

}

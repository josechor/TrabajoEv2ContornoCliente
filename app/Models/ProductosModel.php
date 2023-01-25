<?php

declare (strict_types=1);

namespace Com\Daw2\Models;

class ProductosModel extends \Com\Daw2\Core\BaseModel {

    //Devuelve todos los proveedores
    function allProductos(): array {
        $stmt = $this->pdo->query('SELECT * FROM producto');
        return $stmt->fetchAll();
    }

    function insertar($post) {
        $errores = [];
        $codigo = $post['codigo'];
        try {
            $this->pdo->beginTransaction();
            $query = $this->pdo->prepare("INSERT INTO producto (codigo,nombre,descripcion,proveedor,coste,margen,stock,iva,id_categoria) values(:codigo,:nombre,:descripcion,:proveedor,:coste,:margen,:stock,:iva,:id_categoria)");
            $query->execute(
                    [
                        'codigo' => $post['codigo'],
                        'nombre' => $post['nombre'],
                        'descripcion' => $post['descripcion'],
                        'proveedor' => $post['proveedor'],
                        'coste' => $post['coste'],
                        'margen' => $post['margen'],
                        'stock' => $post['stock'],
                        'iva' => $post['iva'],
                        'id_categoria' => $post['id_categoria']
                    ]
            );

            $insert = $query->rowCount();
            if ($insert > 0) {
                $log = new \Com\Daw2\Helpers\Log(NULL, 'insert', 'producto', "Se he insertado un producto con codigo $codigo");
                $stmLog = $this->pdo->prepare('INSERT INTO log (operacion, tabla, detalle) VALUES (:operacion, :tabla, :detalle)');
                $stmLog->execute(
                        [
                            'operacion' => $log->getOperacion(),
                            'tabla' => $log->getTabla(),
                            'detalle' => $log->getDetalle()
                        ]
                );
            }
            $this->pdo->commit();
        } catch (\Exception $ex) {
            $this->pdo->rollback();
            $errores['error'] = true;
            $errores['mensaje'] = "Ha ocurrido un error en la ejecucion";
            return $errores;
        }




        $errores['error'] = false;
        $errores['mensaje'] = "Se ha añadido correctamente un nuevo producto";
        return $errores;
    }

    function borrar($get): bool {
        $error = false;
        try {
            $this->pdo->beginTransaction();
            $query = $this->pdo->prepare("DELETE FROM producto where codigo like :codigo");
            $query->execute(
                    [
                        'codigo' => $get['codigo'],
                    ]
            );
            $borrar = $query->rowCount();
            if ($borrar > 0) {
                $stmLog = $this->pdo->prepare('INSERT INTO log (operacion, tabla, detalle) VALUES (:operacion, :tabla, :detalle)');
                $stmLog->execute(
                        [
                            'operacion' => 'Delete',
                            'tabla' => 'Producto',
                            'detalle' => "Se ha borrado el producto con codigo " . $get['codigo']
                        ]
                );
            }
            $this->pdo->commit();
        } catch (\PDOException $ex) {
            $this->pdo->rollback();
            $error = true;
            return $error;
        }
        return $error;
    }

    function obtenerDatos($codigo) {
        $stmt = $this->pdo->prepare('SELECT * FROM producto where codigo like :codigo');
        $stmt->execute([
            'codigo' => $codigo
        ]);
        return $stmt->fetchAll();
    }

    function editar($post) {
        $mensaje = [];
        try {
            $this->pdo->beginTransaction();
            $query = $this->pdo->prepare("UPDATE producto SET codigo = :codigo,nombre = :nombre,descripcion =:descripcion,proveedor=:proveedor,coste=:coste,margen=:margen,stock=:stock,iva=:iva,id_categoria=:id_categoria WHERE codigo like :cod");
            try {
                $query->execute(
                        [
                            'codigo' => $post['codigo'],
                            'nombre' => $post['nombre'],
                            'descripcion' => $post['descripcion'],
                            'proveedor' => $post['proveedor'],
                            'coste' => $post['coste'],
                            'margen' => $post['margen'],
                            'stock' => $post['stock'],
                            'iva' => $post['iva'],
                            'id_categoria' => $post['id_categoria'],
                            'cod' => $post['cod']
                        ]
                );
            } catch (\PDOException $ex) {
                $this->pdo->rollback();
                $mensaje['error'] = true;
                $mensaje['mensaje'] = "Algun dato ha sido introducido de forma incorrecta";
                return $mensaje;
            }

            $stmtLog = $this->pdo->prepare('INSERT INTO log (operacion,tabla,detalle) VALUES (?,?,?)');
            $stmtLog->execute([
                'update', 'producto', 'Editado el producto con codigo=' . $post['cod'] . ' a los siguientes valores: codigo=' . $post['codigo'] .
                ', nombre=' . $post['nombre'] . ', descripcion=' . $post['descripcion'] . ', coste=' . $post['coste'] . ', margen=' . $post['margen'] . ', stock=' .
                $post['stock'] . ', iva=' . $post['iva'] . ', id_categoria' . $post['id_categoria']
            ]);

            $this->pdo->commit();
        } catch (Exception $ex) {
            $this->pdo->rollback();
            $mensaje['error'] = true;
            $mensaje['mensaje'] = "Ha ocurrido un error inesperado";
            return $mensaje;
        }


        $mensaje['error'] = false;
        $mensaje['mensaje'] = "Se ha insertado correctamente";
        return $mensaje;
    }

    function buscaDinamica($filtros, int $n) {
        $conditions = [];
        $parameters = [];

        if (!empty($filtros['codigo'])) {
            $conditions[] = 'codigo LIKE ?';
            $parameters[] = '%' . $filtros['codigo'] . "%";
        }
        
        if (isset($filtros['categorias'])) {
            if (count($filtros['categorias'])>0) {
                $cadena = implode(",", $filtros['categorias']);
                $conditions[] = "id_categoria IN ($cadena)";
            }
        }

        if (isset($filtros['proveedores'])) {
            if (count($filtros['proveedores'])>0) {
                $cadena = implode(",", $filtros['proveedores']);
                $conditions[] = "proveedor IN ($cadena)";
            }
        }

        $sqlWhere = implode(" AND ", $conditions);

        if (count($conditions) > 0) {
            $sql = "SELECT * FROM producto WHERE $sqlWhere ORDER BY codigo";
        } else {
            $sql = "SELECT * FROM producto ORDER By codigo";
        }
        var_dump($sql);
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($parameters);
        return $stmt->fetchAll();
    }

    
}

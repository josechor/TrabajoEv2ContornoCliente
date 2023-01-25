<?php

declare (strict_types=1);

namespace Com\Daw2\Models;

define("SENTENCIA", "SELECT usuario.*, aux_rol.nombre_rol  from usuario
left join aux_rol on usuario.id_rol  = aux_rol.id_rol");

class UsuarioModel extends \Com\Daw2\Core\BaseModel {

    private const FIELDS_ORDER = ['username', 'nombre_rol', 'salarioBruto', 'retencionIRPF'];
    private const ORDER_DEFECTO = 0;

    function mostrarTodo(): array {
        $stmt = $this->pdo->query(SENTENCIA);
        return $stmt->fetchAll();
    }

    function filtrarUsuario(string $user): array {
        $search = "%" . $user . "%";
        $stmt = $this->pdo->prepare('SELECT * FROM usuario WHERE username LIKE ?');
        $stmt->execute([$search]);
        return $stmt->fetchAll();
    }

    function filtrarRol(string $rol): array {
        $stmt = $this->pdo->prepare('SELECT * FROM usuario WHERE rol = ?');
        $stmt->execute([$rol]);
        return $stmt->fetchAll();
    }

    function filtrarRetencion(string $salario): array {

        $stmt = $this->pdo->prepare('SELECT * FROM usuario WHERE salarioBruto >= ? ORDER BY salarioBruto DESC');
        $stmt->execute([$salario]);
        return $stmt->fetchAll();
    }

    function filtrarSalarioMayorMenor(string $salarioMenor, string $salarioMayor): array {

        $stmt = $this->pdo->prepare('SELECT * FROM usuario WHERE salarioBruto >= ? && salarioBruto <= ? ORDER BY salarioBruto DESC');
        $stmt->execute([$salarioMenor, $salarioMayor]);
        return $stmt->fetchAll();
    }

    function nombresOrdenadosSalario(): array {
        $stmt = $this->pdo->query('SELECT * FROM usuario ORDER BY salarioBruto DESC');
        return $stmt->fetchAll();
    }

    function usuariosEstandar(): array {
        $stmt = $this->pdo->query('SELECT * FROM usuario WHERE rol = "standard"');
        return $stmt->fetchAll();
    }

    function empiezaCarlos(): array {
        $stmt = $this->pdo->query('SELECT * FROM usuario WHERE username LIKE "Carlos%"');
        return $stmt->fetchAll();
    }

    function roles(): array {
        $stmt = $this->pdo->query('SELECT DISTINCT  aux_rol.nombre_rol  from usuario
left join aux_rol on usuario.id_rol  = aux_rol.id_rol');
        return $stmt->fetchAll();
    }

    function filtrarDinamico($get): array {

        $conditions = [];
        $parameters = [];

        if (isset($get['roles'])) {

            foreach ($get['roles'] as $key => $value) {
                if ($value == 0) {
                    unset($get['roles'][$key]);
                }
            }
            if (count($get['roles']) > 0) {
                $cadena = implode(",", $get['roles']);
                $conditions[] = "usuario.id_rol IN ($cadena)";
            }
        }



        if (!empty($get['usuario'])) {

            $conditions[] = 'username LIKE ?';
            $parameters[] = '%' . $get['usuario'] . "%";
        }

        if (!empty($get['menor']) || !empty($get['mayor'])) {

            empty($get['mayor']) ? $get['mayor'] = "999999" : '';
            empty($get['menor']) ? $get['menor'] = "0" : '';

            $conditions[] = 'salarioBruto >= ? && salarioBruto <= ?';
            $parameters[] = $get['menor'];
            $parameters[] = $get['mayor'];
        }

        if (!empty($get['retencion'])) {

            $conditions[] = 'retencionIRPF = ?';
            $parameters[] = $get['retencion'];
        }

        $fieldOrder = self::FIELDS_ORDER[self::ORDER_DEFECTO];
        if (isset($get['order']) && filter_var($get['order'], FILTER_VALIDATE_INT)) {
            if ($get['order'] <= count(self::FIELDS_ORDER)) {

                $fieldOrder = self::FIELDS_ORDER[$get['order'] - 1];
            }
        }
        var_dump($fieldOrder);

        $sqlWhere = implode(" AND ", $conditions);

        if (!isset($get['limit']) || $get['limit'] <= 0) {
            $get['limit'] = 25;
        }
        if (!isset($get['page']) || $get['page'] <= 0) {
            $get['page'] = 1;
        }

        $limit = "LIMIT " . ($get['page'] - 1) * $get['limit'] . ", " . $get['limit'];
        if (count($conditions) > 0) {
            $sql = SENTENCIA . " WHERE $sqlWhere ORDER BY usuario.$fieldOrder " . $limit;
        } else {
            $sql = SENTENCIA . " order by $fieldOrder " . $limit;
        }
        var_dump($sql);

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($parameters);
        return $stmt->fetchAll();
    }

}

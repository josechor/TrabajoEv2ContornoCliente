<?php

declare (strict_types=1);

namespace Com\Daw2\Models;

class CategoriaModel extends \Com\Daw2\Core\BaseModel {

    function categorias(): array {
        $stmt = $this->pdo->query('SELECT * FROM categoria ORDER BY id_categoria');
        return $stmt->fetchAll();
    }

}

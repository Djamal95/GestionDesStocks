<?php

namespace Epaphrodites\database\requests\typeRequest\sqlRequest\delete;

use Epaphrodites\database\requests\typeRequest\noSqlRequest\delete\delete as DeleteDelete;

class delete extends DeleteDelete
{

    /**
     * Delete product
     * @param int $idProduct
     * @return bool
     */

    public function deleteProduct(int $idProduct): bool
    {

        $result = $this->table('product')
            ->where('idproduct')
            ->param([$idProduct])
            ->sdb(3)
            ->DQuery();
        return $result == 1 ? true : false;
    }
}

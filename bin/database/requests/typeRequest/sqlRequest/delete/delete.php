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

    /**
     * Delete category by her id
     * @param int $idcategory
     * @return bool
     */
    public function deleteCategory($idcategory): bool
    {
        $result = $this->table('category')
            ->where('idcategory')
            ->param([$idcategory])
            ->sdb(3)
            ->DQuery();
        return $result == 1 ? true : false;
    }

    /**
     * Delete supplier by her id
     * @param  int idfounisseur
     * @return bool
     */
    public function deleteSupplier(int $idfournisseur): bool
    {
        $result = $this->table('fournisseur')
            ->where('idfournisseur')
            ->param([$idfournisseur])
            ->sdb(3)
            ->DQuery();
        return $result == 1 ? true : false;
    }

    /**
     * Delete entreprise by her id
     * @param int $identreprise
     * @return bool
     */

    public function deleteEntreprise(int $identreprise): bool
    {
        $result = $this->table('entreprise')
            ->where('identreprise')
            ->param([$identreprise])
            ->sdb(3)
            ->DQuery();
        return $result == 1 ? true : false;
    }

    /**
     * Delete client by her id
     * @param int $idclient
     * @return bool
     */

    public function deleteClient(int $idclient): bool
    {
        $result = $this->table('client')
            ->where('idclient')
            ->param([$idclient])
            ->sdb(3)
            ->DQuery();
        return $result == 1 ? true : false;
    }
}

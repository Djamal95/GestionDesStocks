<?php

namespace Epaphrodites\database\requests\typeRequest\sqlRequest\select;

use Epaphrodites\database\requests\typeRequest\noSqlRequest\select\select as SelectSelect;

class select extends SelectSelect
{

    /**
     * Request to get users list
     *
     * @param integer $page
     * @param integer $numLines
     * @return array
     */
    public function defaultSqlListeOfAllUsers(
        int $page,
        int $numLines
    ): array {

        $result = $this->table('useraccount')
            ->orderBy('usersgroup', 'ASC')
            ->limit((($page - 1) * $numLines), $numLines)
            ->SQuery();

        return $result;
    }

    /**
     * Request to get users list
     *
     * @param integer $page
     * @param integer $numLines
     * @return array
     */
    public function sqlServerListeOfAllUsers(
        int $page,
        int $numLines
    ): array {

        $result = $this->table('useraccount')
            ->orderBy('usersgroup', 'ASC')
            ->offset((($page - 1) * $numLines), $numLines)
            ->SQuery();

        return $result;
    }

    /**
     * Request to get users list
     *
     * @param integer $page
     * @param integer $numLines
     * @return array
     */
    public function sqlListOfRecentActions(
        int $page,
        int $numLines
    ): array {

        return match (_FIRST_DRIVER_) {

            'sqlserver' => $this->sqlServerListOfRecentActions($page, $numLines),

            default => $this->defaultSqlListOfRecentActions($page, $numLines)
        };
    }

    /**
     * Request to get list of users recents actions
     *
     * @param integer $page
     * @param integer $numLines
     * @return array
     */
    public function defaultSqlListOfRecentActions(
        int $page,
        int $numLines
    ): array {

        $result = $this->table('recentactions')
            ->orderBy('dateactions', 'ASC')
            ->limit((($page - 1) * $numLines), $numLines)
            ->SQuery();
        return $result;
    }

    /**
     * Request to get list of users recents actions
     *
     * @param integer $page
     * @param integer $numLines
     * @return array
     */
    public function sqlServerListOfRecentActions(
        int $page,
        int $numLines
    ): array {

        $result = $this->table('recentactions')
            ->orderBy('dateactions', 'ASC')
            ->offset((($page - 1) * $numLines), $numLines)
            ->SQuery();

        return $result;
    }

    /**
     * Request to get list of all category
     * @return array
     */
    public function listOfAllCategory(): array
    {

        $result = $this->table('category')
            ->sdb(3)
            ->SQuery('idcategory ,nameCategory');

        return $result;
    }

    /**
     * Request to get list of all product
     * @return array
     */
    public function listOfAllProduct(): array
    {

        $result = $this->table('product')
            ->join(['category|idCategoryProduct=idcategory'])
            ->sdb(3)
            ->SQuery();
        //var_dump($result);die;
        return $result;
    }
    /**
     * Request to get list of all stock
     * @return array
     */

    public function listOfAllStock(): array
    {
        $result = $this->table('stock')
            ->join(['product|idproductstock=idproduct','fournisseur|idfournisseurstock=idfournisseur'])
            ->sdb(3)
            ->SQuery();
        return $result;
    }

    /**
     * Request to get list of all supplier
     * @return array
     */

    public function listOfAllSupplier(): array
    {
        $result = $this->table('fournisseur')
            ->join(['entreprise|idEntreprisefour=identreprise'])
            ->sdb(3)
            ->SQuery();
        return $result;
    }

    /**
     * Request to get list of all entreprise
     * @return array
     */

    public function listOfAllEntreprise(): array
    {
        $result = $this->table('entreprise')
            ->sdb(3)
            ->SQuery();
        return $result;
    }

    /**
     * Request to get list of all client
     * @return array
     */

    public function listOfAllClient(): array
    {
        $result = $this->table('client')
            ->sdb(3)
            ->SQuery();
        return $result;
    }

    /**
     * Request to find one stock by her id
     * @param int $idstock
     * @return array
     */

    public function findStockById(int $idstock): array
    {
        $result = $this->table('stock')
            ->join(['product|idproductstock=idproduct'])
            ->join(['fournisseur|idfournisseurstock=idfournisseur'])
            ->where('idstock')
            ->param([$idstock])
            ->sdb(3)
            ->SQuery();
        return $result;
    }

    /**
     * Request to find one client by her id
     * @param int $idclient
     * @return array
     */

    public function findClientById(int $idclient): array
    {
        $result = $this->table('client')
            ->where('idclient')
            ->sdb(3)
            ->param([$idclient])
            ->SQuery();
        return $result;
    }
    /**
     * Request to find one entreprise by her id
     * @param int $identreprise
     * @return array
     */
    public function findEntrepriseById(int $identreprise): array
    {
        $result = $this->table('entreprise')
            ->where('identreprise')
            ->sdb(3)
            ->param([$identreprise])
            ->SQuery();
        return $result;
    }
    /**
     * Request to find one fournisseur by her id
     * @param int $idfournisseur
     * @return array
     */
    public function findSupplierById(int $idfournisseur): array
    {
        $result = $this->table('fournisseur')
            ->where('idfournisseur')
            ->param([$idfournisseur])
            ->sdb(3)
            ->SQuery();
        return $result;
    }
    /**
     * Request to find product by her id
     * @param int $id
     * @return array
     */
    public function findProductById(int $id): array
    {

        $result = $this->table('product')
            ->join(['category|idCategoryProduct=idcategory'])
            ->where('idproduct')
            ->param([$id])
            ->sdb(3)
            ->SQuery();
        return $result;
    }
    /**
     * Method to find one category by her id
     * @param int $id
     * @return array
     */
    public function findCategoryById(int $id): array
    {
        $result = $this->table('category')
            ->where('idcategory')
            ->param([$id])
            ->sdb(3)
            ->SQuery();
        return $result;
    }
}

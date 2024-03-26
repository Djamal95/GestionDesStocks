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
     * @param string $value
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
     * @param string $value
     * @return array
     */
    public function listOfAllProduct(): array
    {

        $result = $this->table('product')
            ->join(['category|idCategoryProduct=idcategory'])
            ->limit(1, 10)
            ->sdb(3)
            ->SQuery();
            //var_dump($result);die;
        return $result;
    }

    /**
     * Request to find product by her id
     * @param string $value
     * @return bool
     */
    public function findProductById(int $id)
    {

        $result = $this->table('product')
            ->join(['category|idCategoryProduct=idcategory'])
            ->where('idProduct')
            ->param([$id])
            ->sdb(3)
            ->SQuery();

        return $result;
    }
}

<?php

namespace Epaphrodites\database\requests\typeRequest\sqlRequest\insert;

use DateTime;
use Epaphrodites\database\requests\typeRequest\noSqlRequest\insert\insert as InsertInsert;

class insert extends InsertInsert
{

    /**
     * Add users to the system from the console
     *
     * @param string|null $login
     * @param string|null $password
     * @param int|null $UserGroup
     * @return bool
     */
    public function sqlConsoleAddUsers(
        ?string $login = null,
        ?string $password = null,
        ?int $UserGroup = null
    ): bool {

        $UserGroup = $UserGroup !== NULL ? $UserGroup : 1;

        if (!empty($login) && count(static::initQuery()['getid']->sqlGetUsersDatas($login)) < 1) {

            $this->table('useraccount')
                ->insert(' loginusers , userspwd , usersgroup ')
                ->values(' ? , ? , ? ')
                ->param([static::initNamespace()['env']->no_space($login), static::initConfig()['guard']->CryptPassword($password), $UserGroup])
                ->IQuery();

            return true;
        } else {
            return false;
        }
    }

    /**
     * Add chats
     * 
     * @param string|null $emitter
     * @param string|null $recipient
     * @param int|null $type
     * @param string|null $content
     * @return bool
     */
    public function addUserChats(
        ?string $emitter = null,
        ?string $recipient = null,
        ?int $type = null,
        ?string $content = null
    ): bool {

        if (!empty($content) && !empty($recipient)) {

            $this->table('chatsmessages')
                ->insert(' emetteur , destinataire , typemessages , datemessages , contentmessages ')
                ->values(' ? , ? , ? , ? , ? ')
                ->param([static::initNamespace()['env']->no_space($emitter), static::initNamespace()['env']->no_space($recipient), $type, date("Y-m-d H:i:s"), $content])
                ->IQuery();

            return true;
        } else {
            return false;
        }
    }

    /**
     * Add users to the system
     *
     * @param string|null $login
     * @param int|null $usersgroup
     * @return bool
     */
    public function sqlAddUsers(
        ?string $login = null,
        ?int $usersgroup = null
    ): bool {

        if (!empty($login) && !empty($usersgroup) && count(static::initQuery()['getid']->sqlGetUsersDatas($login)) < 1) {

            $this->table('useraccount')
                ->insert(' loginusers , userspwd , usersgroup ')
                ->values(' ? , ? , ? ')
                ->param([static::initNamespace()['env']->no_space($login), static::initConfig()['guard']->CryptPassword($login . '@'), $usersgroup])
                ->IQuery();

            $actions = "Add a User : " . $login;
            static::initQuery()['setting']->ActionsRecente($actions);

            return true;
        } else {
            return false;
        }
    }

    /**
     * Request to save informations of one product in database
     * @param string $name
     * @param string $description
     * @param string $price
     * @param string $category
     * @param string $source
     * @return string
     * 
     */
    public function addProduct(string $name, string $description, string $price, string $category, string $source): string
    {
        $result = $this->table("product")
            ->insert("libelleProduct, descriptionProduct, priceProduct, idCategoryProduct, imageProduct")
            ->values('?,?,?,?,?')
            ->sdb(3)
            ->param([$name, $description, $price, $category, $source])
            ->IQuery();
        return $result;
    }
    /**
     * Request to insert informations of one category
     * @param string $nameCategory
     * @return string
     */
    public function addCategory($nameCategory): string
    {

        $result = $this->table('category')
            ->insert('nameCategory')
            ->values('?')
            ->sdb(3)
            ->param([$nameCategory])
            ->IQuery();

        return $result;
    }

    /**
     * Request ton insert informations of one supplier
     * @param string $nameFournisseur
     * @param string $surnameFournisseur
     * @param string $emailFournisseur
     * @param string $contactFournisseur
     * @param string $idEntreprisefour
     * @return string
     */

    public function addSupplier($nameFournisseur, $surnameFournisseur, $emailFournisseur, $contactFournisseur, $idEntreprisefour): string
    {

        $result = $this->table('fournisseur')
            ->insert('nameFourni, surnameFourni,emailFourni, contactFourni, idEntreprisefour')
            ->values('?, ?, ?, ?, ?')
            ->param([$nameFournisseur, $surnameFournisseur, $emailFournisseur, $contactFournisseur, $idEntreprisefour])
            ->sdb(3)
            ->IQuery();
        return $result;
    }

    /**
     * Request ton insert all informations of one entreprise
     * @param string $nameEntreprise 
     * @param string $contactEntreprise
     * @param string $emailEntreprise
     * @return string
     */

    public function addEntreprise(string $nameEntreprise, string $contactEntreprise, string $emailEntreprise): string
    {
        $result = $this->table('entreprise')
            ->insert('nameEntreprise, contactEntreprise, emailEntreprise')
            ->values('?,?,?')
            ->param([$nameEntreprise, $contactEntreprise, $emailEntreprise])
            ->sdb(3)
            ->IQuery();
        return $result;
    }

    /**
     * Request to insert all informations of one client
     * @param string $nameClient
     * @param string $surnameClient
     * @param string $emailClient
     * @param string $passwordClient
     * @return string
     */

    public function addClient(string $nameClient, string $surnameClient, string $emailClient, string $passwordClient): string
    {
        $result = $this->table("client")
            ->insert("nameClient, surnameClient, emailClient, passwordClient")
            ->values('?,?,?,?')
            ->sdb(3)
            ->param([$nameClient, $surnameClient, $emailClient, $passwordClient])
            ->IQuery();
        return $result;
    }

    /**
     * Method to register procurement
     * @param string $dateApprovisionnement
     * @param int  $idproductstock
     * @param int $idfournisseurstock
     * @param int $quantityProduct
     * @return string
     */
    public function addStock(string $dateApprovisionnement, int $idproductstock, int $idfournisseurstock, int $quantityProduct):string{

        $result = $this->table("stock")
            ->insert("dateApprovisionnement,etatStock,idproductstock,idfournisseurstock,quantityProduct")
            ->values("?,1,?,?,?")
            ->param([$dateApprovisionnement,$idproductstock,$idfournisseurstock,$quantityProduct])
            ->sdb(3)
            ->IQuery();
        return $result;
    }
}

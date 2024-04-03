<?php

namespace Epaphrodites\database\requests\typeRequest\sqlRequest\update;

use Epaphrodites\database\requests\typeRequest\noSqlRequest\update\update as UpdateUpdate;

class update extends UpdateUpdate
{

    /**
     * Request to update chat messages
     * 
     * @param string $users
     * @return bool
     */
    public function chat_messages(
        string $users
    ): bool
    {
        $this->table('chatsmessages')
            ->set(['etatmessages'])
            ->where('emetteur')
            ->and(['destinataire', 'etatmessages'])
            ->param([0, $users, static::initNamespace()['session']->login(), 1])
            ->UQuery();

        return true;
    }

    /**
     * Request to update users password
     *
     * @param string $OldPassword
     * @param string $NewPassword
     * @param string $confirmdp
     * @return int|bool
     */
    public function sqlChangeUsersPassword(
        string $OldPassword, 
        string $NewPassword, 
        string $confirmdp
    ):int|bool
    {

        if (static::initConfig()['guard']->GostCrypt($NewPassword) === static::initConfig()['guard']->GostCrypt($confirmdp)) {

            $result = static::initQuery()['auth']->findSqlUsers(static::initNamespace()['session']->login());

            if (!empty($result)) {

                if (static::initConfig()['guard']->AuthenticatedPassword($result[0]["userspwd"], $OldPassword) === true) {

                    $this->table('useraccount')
                        ->set(['userspwd'])
                        ->where('idusers')
                        ->param([static::initConfig()['guard']->CryptPassword($NewPassword), static::initNamespace()['session']->id()])
                        ->UQuery();

                    $actions = "Change password : " . static::initNamespace()['session']->login();
                    static::initQuery()['setting']->ActionsRecente($actions);

                    $this->desconnect = static::initNamespace()['paths']->logout();

                    header("Location: $this->desconnect ");
                    exit;
                } else {
                    return 3;
                }
            } else {

                return 2;
            }
        } else {
            return 1;
        }
    }

    /**
     * Update user password and user group
     *
     * @param string|NULL $login
     * @param string|NULL $password
     * @param int|NULL $UserGroup
     * @return bool
     */
    public function sqlConsoleUpdateUsers(
        ?string $login = NULL, 
        ?string $password = NULL, 
        ?int $UserGroup = NULL
    ): bool
    {
        $GetDatas = static::initQuery()['getid']->sqlGetUsersDatas($login);

        if (!empty($GetDatas)) {

            $password = $password !== NULL ? $password : $login;
            $UserGroup = $UserGroup !== NULL ? $UserGroup : $GetDatas[0]['usersgroup'];

            $this->table('useraccount')
                ->set(['userspwd', 'usersgroup'])
                ->where('loginusers')
                ->param([static::initConfig()['guard']->CryptPassword($password), $UserGroup, "$login"])
                ->UQuery();

            return true;
        } else {
            return false;
        }
    }

    /**
     * Request to initialize user password
     *
     * @param integer $UsersLogin
     * @return bool
     */
    public function sqlInitUsersPassword(
        string $UsersLogin
    ): bool
    {

        $this->table('useraccount')
            ->set(['userspwd'])
            ->where('loginusers')
            ->param([static::initConfig()['guard']->CryptPassword($UsersLogin), $UsersLogin])
            ->UQuery();

        $actions = "Reset user password : " . $UsersLogin;
        static::initQuery()['setting']->ActionsRecente($actions);

        return true;
    }

    /**
     * Request to switch user connexion state
     *
     * @param integer $login
     * @return bool
     */
    public function sqlUpdateEtatsUsers(
        string $login
    ): bool
    {
        
        $GetUsersDatas = static::initQuery()['getid']->sqlGetUsersDatas($login);

        if (!empty($GetUsersDatas)) {

            $state = !empty($GetUsersDatas[0]['usersstat']) ? 0 : 1;

            $etatExact = "Close";

            if ($state == 1) {
                $etatExact = "Open";
            }

            $this->table('useraccount')
                ->set(['usersstat'])
                ->like('loginusers')
                ->param([$state, $GetUsersDatas[0]['loginusers']])
                ->UQuery();
              
            $actions = $etatExact . " of the user's account : " . $GetUsersDatas[0]['loginusers'];
            static::initQuery()['setting']->ActionsRecente($actions);
           
            return true;
        } else {
            return false;
        }
    }

    /**
     * Request to update user datas
     *
     * @param string $usersname
     * @param string $email
     * @param string $number
     * @return mixed
     */
    public function sqlUpdateUserDatas(
        string $usersname, 
        string $email, 
        string $number
    ):mixed
    {
        
        if (static::initNamespace()['verify']->onlyNumber($number, 11) === false) {
            $this->table('useraccount')
                ->set(['contactusers', 'emailusers', 'usersname', 'usersstat'])
                ->where('idusers')
                ->param([$number, $email, $usersname, 1, static::initNamespace()['session']->id()])
                ->UQuery();

            $_SESSION["usersname"] = $usersname;

            $_SESSION["contact"] = $number;

            $_SESSION["email"] = $email;

            $actions = "Edit Personal Information : " . static::initNamespace()['session']->login();
            static::initQuery()['setting']->ActionsRecente($actions);

            $this->desconnect = static::initNamespace()['paths']->dashboard();

            header("Location: $this->desconnect ");
            exit;
        } else {
            return false;
        }
    }

        /**
     * Request to save informations of one product in database
     * @param string $name
     * @param string $description
     * @param string $quantity
     * @param int $price
     * @param int $category
     * @param string $source
     * @param int $idProduct
     * @return bool
     * 
     */
    public function updateProduct(string $name, string $description, string $quantity, string $price, string $category, string $source, int $idProduct): bool
    {

        $this->table('product')
            ->set(['libelleProduct', 'descriptionProduct', 'quantityProduct', 'priceProduct', 'idCategoryProduct', 'imageProduct'])
            ->where('idproduct')
            ->param([$name, $description, $quantity, $price, $category, $source, $idProduct])
            ->UQuery();

        return true;
    }
    /**
     * Method to update informations of one category
     * @param int $idcategory
     * @param string $nameCategory
     * @return bool
     */
    public function updateCategory(
        int $idcategory,
        string $nameCategory,
    ): bool {
        
        $result = $this->table('category')
            ->set(['nameCategory'])
            ->where('idcategory')
            ->sdb(3)
            ->param([$nameCategory, $idcategory])
            ->UQuery();
        return $result;
    }
    /**
     * Method to update informations of one client
     * @param int $idclient
     * @param string $nameClient
     * @param string $surnameClient
     * @param string $emailClient
     * @param string $passwordClient
     * @return bool
     */

    public function updateClient(
        int $idclient,
        string $nameClient,
        string $surnameClient,
        string $emailClient,
        string $passwordClient,
    ): bool {
        $result = $this->table('client')
            ->set(['nameClient,surnameClient,emailClient,passwordClient'])
            ->where('idclient')
            ->sdb(3)
            ->param([$nameClient,$surnameClient,$emailClient,$passwordClient, $idclient])
            ->UQuery();
        return $result;
    }

    /**
     * Method to update informatios of one entreprise
     * @param int $identreprise
     * @param string $nameEntreprise
     * @param string $contactEntreprise
     * @param string $emailEntreprise
     * @return bool
     */

     public function updateEntreprise(
        int $identreprise,
        string $nameEntreprise,
        string $contactEntreprise,
        string $emailEntreprise,
    ): bool {
        $result = $this->table('entreprise')
            ->set(['nameEntreprise,contactEntreprise,emailEntreprise'])
            ->where('identreprise')
            ->sdb(3)
            ->param([$nameEntreprise,$contactEntreprise,$emailEntreprise, $identreprise])
            ->UQuery();
        return $result;
    }
    
    /**
     * Method to update informations of one fournisseur
     * @param int $idfournisseur
     * @param string $nameFourni
     * @param string $surnameFourni
     * @param string $emailFourni
     * @param string $contactFourni
     * @param int $idEntreprisefour
     * @return bool
     */
     public function updateSupplier(
        int $idfournisseur,
        string $nameFourni,
        string $surnameFourni,
        string $emailFourni,
        string $contactFourni,
        int $idEntreprisefour
    ): bool {
        $result = $this->table('fournisseur')
            ->set(['nameFourni,surnameFourni,emailFourni,contactFourni,idEntreprisefour'])
            ->where('idfournisseur')
            ->sdb(3)
            ->param([$nameFourni,$surnameFourni,$emailFourni, $contactFourni,$idEntreprisefour,$idfournisseur])
            ->UQuery();
        return $result;
    }
    /**
     * Method to update informations of one entreprise
     * @param int $idfournisseur
     * @param string $nameFourni
     * @param string $surnameFourni
     * @param string $emailFourni
     * @param string $contactFourni
     * @param int $idEntreprisefour
     * @return bool
     */
     public function updateStock(
        int $idstock,
        string $dateApprovisionnement,
        int $idproductstock,
        string $idfournisseurstock,
        string $quantityProduct,
    ): bool {
        $result = $this->table('stock')
            ->set(['dateApprovisionnement,idproductstock,idfournisseurstock,quantityProduct'])
            ->where('idstock')
            ->sdb(3)
            ->param([$dateApprovisionnement,$idproductstock,$idfournisseurstock, $quantityProduct,$idstock])
            ->UQuery();
        return $result;
    }
}

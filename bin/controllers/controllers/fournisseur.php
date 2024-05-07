<?php

namespace Epaphrodites\controllers\controllers;

use Epaphrodites\controllers\switchers\MainSwitchers;

final class fournisseur extends MainSwitchers
{
    private object $msg;
    private object $insert;
    private object $select;
    private object $delete;
    private object $update;
    private string $alert = '';
    private string $ans = '';

    /**
     * Initialize object properties when an instance is created
     * @return void
     */
    public final function __construct()
    {
        $this->initializeObjects();
    }

    /**
     * Initialize each property using values retrieved from static configurations
     * @return void
     */
    private function initializeObjects(): void
    {
        $this->msg = $this->getFunctionObject(static::initNamespace(), 'msg');
        $this->select = $this->getFunctionObject(static::initQuery(), 'select');
        $this->insert = $this->getFunctionObject(static::initQuery(), 'insert');
        $this->delete = $this->getFunctionObject(static::initQuery(), 'delete');
        $this->update = $this->getFunctionObject(static::initQuery(), 'update');
    }

    /**
     * Start exemple page
     * @param string $html
     * @return void
     */
    public final function exemplePages(string $html): void
    {
        $this->views($html, [], false);
    }


    /**
     * start view function
     * 
     * @param string $html
     * @return void
     */
    public final function addFournisseur(string $html): void
    {

        if (static::isValidMethod(true) && static::arrayNoEmpty(['__name__', '__surname__', '__email__', '__contact__', '__entreprise__'])) {
            $result = $this->insert->addSupplier(
                static::getPost('__name__'),
                static::getPost('__surname__'),
                static::getPost('__email__'),
                static::getPost('__contact__'),
                static::getPost('__entreprise__'),
            );
            if ($result) {
                $this->alert = "alert-success";
                $this->ans = $this->msg->answers("succes");
            }else{
                $this->alert = "alert-danger";
                $this->ans = $this->msg->answers("error");
            }
        }

        $this->views($html, [
            'entreprise' => $this->select->listOfAllEntreprise(),
            'alert' => $this->alert,
            'reponse' => $this->ans
        ], true);
    }

    /**
     * start view function
     * 
     * @param string $html
     * @return void
     */
    public final function listOfAllFournisseur(string $html): void
    {

        if (static::isValidMethod(true)) {
            if (static::isSelected('_sendselected_', 1)) {
                foreach (static::isArray('suppliers') as $idfournisseur) {
                    $result = $this->delete->deleteSupplier($idfournisseur);
                }
                if ($result == true) {
                    $this->alert = "alert-success";
                    $this->ans = $this->msg->answers("succes");
                }else{
                    $this->alert = "alert-danger";
                    $this->ans = $this->msg->answers("error");
                }
            }
        }
        $listEntreprise = $this->select->listOfAllEntreprise();
        $listOfAllSupplier = $this->select->listOfAllSupplier();
        $this->views($html, [
            'supplier' => $listOfAllSupplier,
            'listEntreprise' => $listEntreprise,
            'alert' => $this->alert,
            'reponse' => $this->ans
        ], true);
    }

    /**
    * start view function
    * @param string $html
    * @return void
    */
     public final function updateFournisseur(string $html): void{
        $idfournisseur = static::isGet('_see', 'int') ? static::getGet('_see') : 0;
        if (static::isValidMethod(true) && static::arrayNoEmpty(['__name__', '__surname__', '__email__', '__contact__', '__entreprise__'])) {
            $result = $this->update->updateSupplier(
                $idfournisseur,
                static::getPost('__name__'),
                static::getPost('__surname__'),
                static::getPost('__email__'),
                static::getPost('__contact__'),
                static::getPost('__entreprise__')
            );
            
            if ($result) {
                $this->alert = "alert-success";
                $this->ans = $this->msg->answers("succes");
            }else{
                $this->alert = "alert-danger";
                $this->ans = $this->msg->answers("error");
            }
        }
        $listEntreprise = $this->select->listOfAllEntreprise();
        $supplier = $this->select->findSupplierById($idfournisseur);
        $this->views($html, [
            'supplier' => $supplier,
            'entreprise' => $listEntreprise,
            'alert' => $this->alert,
            'reponse' => $this->ans
        ], true);
    }
}
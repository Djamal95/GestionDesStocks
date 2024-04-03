<?php

namespace Epaphrodites\controllers\controllers;

use Epaphrodites\controllers\switchers\MainSwitchers;

final class client extends MainSwitchers
{
    private object $msg;
    private object $insert;
    private object $select;
    private object $delete;
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
        $this->insert = $this->getFunctionObject(static::initQuery(), 'insert');
        $this->select = $this->getFunctionObject(static::initQuery(), 'select');
        $this->delete = $this->getFunctionObject(static::initQuery(), 'delete');
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
    public final function addClient(string $html): void
    {
        if (static::isValidMethod(true) && static::arrayNoEmpty(['__name__', '__surname__', '__email__', '__password__'])) {
            $result = $this->insert->addClient(
                static::getPost('__name__'),
                static::getPost('__surname__'),
                static::getPost('__email__'),
                static::getPost('__password__'),
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
            'alert'=>$this->alert,
            'reponse' => $this->ans
        ], true);
    }

    /**
     * start view function
     * 
     * @param string $html
     * @return void
     */
    public final function listOfAllClient(string $html): void
    {
        if(static::isValidMethod(true)){
            if(static::isSelected('_sendselected_',1)){
                foreach(static::isArray('clients') as $idclient){
                    $result = $this->delete->deleteClient($idclient);
                }
                if($result == true){
                    $this->alert = "alert-success";
                    $this->ans = $this->msg->answers("succes");
                }else{
                    $this->alert = "alert-danger";
                    $this->ans = $this->msg->answers("error");
                }
            }
        }
        $result = $this->select->listOfAllClient();
        $this->views($html, [
            'client' => $result,
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
    public final function updateClient(string $html): void
    {
        if (static::isValidMethod(true) && static::arrayNoEmpty(['__name__', '__surname__', '__email__', '__password__'])) {
            $result = $this->insert->addClient(
                static::getPost('__name__'),
                static::getPost('__surname__'),
                static::getPost('__email__'),
                static::getPost('__password__'),
            );
            if ($result) {
                $this->alert = "alert-success";
                $this->ans = $this->msg->answers("succes");
            }else{
                $this->alert = "alert-danger";
                $this->ans = $this->msg->answers("error");
            }
        }
        $idclient = static::isGet('_see', 'int') ? static::getGet('_see') : 0;
        $Client = $this->select->findClientById($idclient);
        $this->views($html, [
            'client' => $Client,
            'alert' => $this->alert,
            'reponse' => $this->ans
        ], true);
    }
}

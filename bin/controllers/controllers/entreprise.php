<?php

namespace Epaphrodites\controllers\controllers;

use Epaphrodites\controllers\switchers\MainSwitchers;

final class entreprise extends MainSwitchers
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
    public final function addEntreprise(string $html): void
    {

        if (static::isValidMethod(true) && static::arrayNoEmpty(['__name__', '__contact__', '__email__'])) {
            $result = $this->insert->addEntreprise(
                static::getPost('__name__'),
                static::getPost('__contact__'),
                static::getPost('__email__'),
            );
            if ($result) {
                $this->alert = "alert-success";
                $this->ans = $this->msg->answers("succes");
            } else {
                $this->alert = "alert-danger";
                $this->ans = $this->msg->answers("error");
            }
        }
        $this->views($html, [
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
    public final function listOfAllEntreprise(string $html): void
    {

        if (static::isValidMethod(true)) {
            if (static::isSelected('_sendselected_', 1)) {
                foreach (static::isArray('entreprises') as $identreprise) {
                    $result = $this->delete->deleteEntreprise($identreprise);
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
        $result = $this->select->listOfAllEntreprise();
        $this->views($html, [
            'entreprise' => $result,
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
    public final function updateEntreprise(string $html): void
    {
        if (static::isValidMethod(true) && static::arrayNoEmpty(['__name__', '__contact__', '__email__'])) {
            $result = $this->insert->addEntreprise(
                static::getPost('__name__'),
                static::getPost('__contact__'),
                static::getPost('__email__'),
            );
            if ($result) {
                $this->alert = "alert-success";
                $this->ans = $this->msg->answers("succes");
            } else {
                $this->alert = "alert-danger";
                $this->ans = $this->msg->answers("error");
            }
        }

        $identreprise = static::isGet('_see', 'int') ? static::getGet('_see') : 0;
        $entreprise = $this->select->findEntrepriseById($identreprise);
        $this->views($html, [
            'entreprise' => $entreprise,
            'alert' => $this->alert,
            'reponse' => $this->ans
        ], true);
    }
}

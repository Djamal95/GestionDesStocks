<?php
namespace Epaphrodites\controllers\controllers;
        
use Epaphrodites\controllers\switchers\MainSwitchers;
        
final class category extends MainSwitchers
{
    private object $msg;
    private object $select;
    private object $insert;
    private string $alert =  '';
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
        $this->select = $this->getFunctionObject(static::initNamespace(), 'select');
        $this->insert = $this->getFunctionObject(static::initNamespace(), 'insert');
    }       
        
    /**
     * Start exemple page
     * @param string $html
     * @return void
    */      
    public final function exemplePages(string $html): void
    {
        $this->views( $html, [], false );
    }     
        

    /**
    * start view function
    * 
    * @param string $html
    * @return void
    */
     public final function addCategory(string $html): void{
        if(static::isValidMethod(true) && static::arrayNoEmpty(['__name__'])){
            $result = $this->insert->addCategory(static::getPost('__name__'));
            if($result){
                $this->alert = "alert-success";
                $this->ans = $this->msg->answers('succes');
            }
        }
        $this->views( $html, [
            'alert' => $this->alert,
            'reponse' => $this->ans
        ], true );
    }
}
<?php
namespace Epaphrodites\controllers\controllers;
        
use Epaphrodites\controllers\switchers\MainSwitchers;
        
final class product extends MainSwitchers
{
    private object $msg;

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
    }       
        
    /**
    * start view function
    * @param string $html
    * @return void
    */
     public final function addProduct(string $html): void{
    
        if(static::isValidMethod(true) && static::arrayNoEmpty(['__label__'])){
            var_dump(static::getPost('__label__'));die;
        }

        $this->views( $html, [], true );
    }
}
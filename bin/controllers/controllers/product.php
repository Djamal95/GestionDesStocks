<?php
namespace Epaphrodites\controllers\controllers;
        
use Epaphrodites\controllers\switchers\MainSwitchers;
        
final class product extends MainSwitchers
{
    private object $msg;
    private object $insert;

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
        $this->insert = $this->getFunctionObject(static::initQuery(), 'insert');
        $this->msg = $this->getFunctionObject(static::initNamespace(), 'msg');
    }       
        
    /**
    * add product
    * @param string $html
    * @return void
    */
     public final function addProduct(string $html): void{
    
        if(static::isValidMethod(true) && static::arrayNoEmpty(['__label__'])){
            $this->insert->addProduct(static::getPost('__label__'));
        }

        $this->views( $html, [ ], true );
    }
}
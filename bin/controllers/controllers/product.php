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
    
        if(static::isValidMethod(true) && static::arrayNoEmpty(['__name__','__description__','__quantity__','__price__','__Category__'])){
            $this->insert->addProduct(
                static::getPost('__name__'),
                static::getPost('__description__'),
                static::getPost('__quantity__'),
                static::getPost('__price__'),
                static::getPost('__Category__'),
            );
        }
        $this->views( $html, [ ], true );
    }


    /**
    * start view function
    * 
    * @param string $html
    * @return void
    */
     public final function updateProduct(string $html): void{
    
        $this->views( $html, [], true );
    }

    /**
    * start view function
    * 
    * @param string $html
    * @return void
    */
     public final function listOfAllProduct(string $html): void{
    
        $this->views( $html, [], true );
    }
}
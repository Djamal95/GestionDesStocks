<?php
namespace Epaphrodites\controllers\controllers;
        
use Epaphrodites\controllers\switchers\MainSwitchers;
        
final class stock extends MainSwitchers
{
    private object $msg;
    private object $select;

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
     public final function listOfStock(string $html): void{
        $result = $this->select->listOfAllStock();
        $this->views( $html, [
            'stock' => $result
        ], true );
    }
}
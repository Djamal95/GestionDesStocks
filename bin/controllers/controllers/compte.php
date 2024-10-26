<?php
namespace Epaphrodites\controllers\controllers;
        
use Epaphrodites\controllers\switchers\MainSwitchers;
        
final class compte extends MainSwitchers
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
     public final function loginCompt(string $html): void{
    
        $this->views( $html, [], false );
    }

    /**
    * start view function
    * 
    * @param string $html
    * @return void
    */
     public final function logoutCompt(string $html): void{
    
        $this->views( $html, [], false );
    }

    /**
    * start view function
    * 
    * @param string $html
    * @return void
    */
     public final function signIn(string $html): void{
    
        $this->views( $html, [], false );
    }
}
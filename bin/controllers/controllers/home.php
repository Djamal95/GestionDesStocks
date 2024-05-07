<?php
namespace Epaphrodites\controllers\controllers;
        
use Epaphrodites\controllers\switchers\MainSwitchers;
        
final class home extends MainSwitchers
{
    private object $msg;
    private object $layout;

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
        $this->layout = $this->getFunctionObject(static::initNamespace(), 'layout');
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
     public final function index(string $html): void{
        $this->views( $html, [
            'layout' => $this->layout->main()
        ], false );
    }
    /**
    * start view function
    * 
    * @param string $html
    * @return void
    */
     public final function show(string $html): void{
    
        $this->views( $html, [
            'layout' => $this->layout->main()
        ], false );
    }
}
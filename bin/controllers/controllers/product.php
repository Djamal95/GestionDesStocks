<?php
namespace Epaphrodites\controllers\controllers;
        
use Epaphrodites\controllers\switchers\MainSwitchers;
        
final class product extends MainSwitchers
{
    private object $msg;
    private object $insert;
    private object $select;
    private object $update;
    private object $delete;
    private object $env;
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
        $this->insert = $this->getFunctionObject(static::initQuery(), 'insert');
        $this->select = $this->getFunctionObject(static::initQuery(), 'select');
        $this->delete = $this->getFunctionObject(static::initQuery(), 'delete');
        $this->update = $this->getFunctionObject(static::initQuery(), 'update');
        $this->msg = $this->getFunctionObject(static::initNamespace(), 'msg');
        $this->env = $this->getFunctionObject(static::initNamespace(), 'env');
    }       
        
    /**
    * add product
    * @param string $html
    * @return void
    */
     public final function addProduct(
        string $html
    ): void{
        if(static::isValidMethod(true) && static::arrayNoEmpty(['__name__','__description__','__quantity__','__price__','__Category__'])){
            
            $source = static::getFileName('image');

            $this->env->uploadFiles([_DIR_IMG_, 'image']);

            $result = $this->insert->addProduct(
                static::getPost('__name__'),
                static::getPost('__description__'),
                static::getPost('__quantity__'),
                static::getPost('__price__'),
                static::getPost('__Category__'),
                $source
            );
            if($result){
                
               
                $this->alert = "alert-success";
                $this->ans = $this->msg->answers("succes");
            }
        }

        $this->views( $html, [
            'select'=>$this->select->listOfAllCategory(),
            'alert'=>$this->alert,
            'answers' => $this->ans
        ], true );
    }


    /**
    * start view function
    * 
    * @param string $html
    * @return void
    */
     public final function updateProduct(
        string $html
    ): void{

        $idProduct = static::isGet('_product','int')? static::getGet('_product'): 0;

        if(static::isValidMethod(true) && static::arrayNoEmpty(['__name__','__description__','__quantity__','__price__','__Category__'])){

            $source = static::getFileName('image');

           var_dump($source);die;

            $result = $this->update->updateProduct(
                        static::getPost('__name__'),
                        static::getPost('__description__'),
                        static::getPost('__quantity__'),
                        static::getPost('__price__'),
                        static::getPost('__Category__'),
                        $source,
                        $idProduct
            );

            if($result){
                
                $this->env->uploadFiles([_DIR_MEDIA_, 'image']);
                $this->alert = "alert-success";
                $this->ans = $this->msg->answers("succes");
            }

        }

        $listCategory = $this->select->listOfAllCategory();
        $listProduct = $this->select->findProductById($idProduct);

        $this->views( $html, [
            'product' => $listProduct,
            'listCategory' => $listCategory,
            'alert'=>$this->alert,
            'answers' => $this->ans
        ], true );
    }
    /**
    * start view function
    * 
    * @param string $html
    * @return void
    */
     public final function listOfAllProduct(
        string $html
    ): void{
        
        if(static::isValidMethod(true)){
            if(static::isSelected('_sendselected_',1)){
                foreach(static::isArray('products') as $idproduct){
                    $result = $this->delete->deleteProduct($idproduct);
                }
                if($result == true){
                    $this->alert = "alert-success";
                    $this->ans = $this->msg->answers("succes");
                }
            }
        }

        $listCategory = $this->select->listOfAllCategory();
        $listOfAllProduct = $this->select->listOfAllProduct();

        $this->views( $html, [
            'select' =>$listOfAllProduct,
            'listCategory' => $listCategory,
            'alert'=>$this->alert,
            'reponse' => $this->ans
        ], true );
    }
}
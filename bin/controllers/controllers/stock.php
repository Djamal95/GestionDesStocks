<?php
namespace Epaphrodites\controllers\controllers;
        
use Epaphrodites\controllers\switchers\MainSwitchers;
        
final class stock extends MainSwitchers
{
    private object $msg;
    private object $select;
    private object $delete;
    private object $insert;
    private object $update;
    private string $alert = "";
    private string $ans = "";

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
        $this->insert = $this->getFunctionObject(static::initQuery(), 'insert');
        $this->delete = $this->getFunctionObject(static::initQuery(), 'delete');
        $this->update = $this->getFunctionObject(static::initQuery(), 'update');
    }            

    /**
    * start view function
    * 
    * @param string $html
    * @return void
    */
     public final function listOfStock(
        string $html
    ): void{

        if (static::isValidMethod(true)) {
            if (static::isSelected('_sendselected_', 1)) {
                foreach (static::isArray('stocks') as $idstock) {
                    $result = $this->delete->deleteStock($idstock);
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
        
        $stockList = $this->select->listOfAllStock();
        $this->views($html, [
            'stock' => $stockList,
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
     public final function addStock(
        string $html
    ): void{
    
        if (static::isValidMethod(true) && static::arrayNoEmpty(['__date__', '__product__', '__supplier__','__quantity__'])) {
           
            $result = $this->insert->addStock(
                static::getPost('__date__'),
                static::getPost('__product__'),
                static::getPost('__supplier__'),
                static::getPost('__quantity__'),
            );

            if ($result) {
                $this->alert = "alert-success";
                $this->ans = $this->msg->answers("succes");
            } else {
                $this->alert = "alert-danger";
                $this->ans = $this->msg->answers("error");
            }
        }

        $listSupplier = $this->select->listOfAllSupplier();
        $listProduct = $this->select->listOfAllProduct();

        $this->views($html, [
            'supplier' => $listSupplier,
            'product' => $listProduct,
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
     public final function updateStock(
        string $html
    ): void{
        $idstock = static::isGet('_see','int')? static::getGet('_see'): 0;

        if (static::isValidMethod(true) && static::arrayNoEmpty(['__date__', '__product__', '__supplier__','__quantity__'])) {
           
            $result = $this->update->updateStock(
                $idstock,
                static::getPost('__date__'),
                static::getPost('__product__'),
                static::getPost('__supplier__'),
                static::getPost('__quantity__')
            );
            if ($result) {
                $this->alert = "alert-success";
                $this->ans = $this->msg->answers("succes");
            } else {
                $this->alert = "alert-danger";
                $this->ans = $this->msg->answers("error");
            }
        }
        $listProduct = $this->select->listOfAllProduct();
        $listSupplier = $this->select->listOfAllSupplier();
        $listStock = $this->select->findStockById($idstock);
        //var_dump($listStock);die;
        $this->views( $html, [
            'stock' => $listStock,
            'product' => $listProduct,
            'supplier' => $listSupplier,
            'alert' => $this->alert,
            'reponse' => $this->ans
        ], true );
    }
}
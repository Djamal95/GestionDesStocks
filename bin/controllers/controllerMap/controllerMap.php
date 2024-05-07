<?php

namespace Epaphrodites\controllers\controllerMap;

use Epaphrodites\controllers\controllers\api;
use Epaphrodites\controllers\controllers\main;
use Epaphrodites\controllers\controllers\users;
use Epaphrodites\controllers\controllers\chats;
use Epaphrodites\controllers\controllers\setting;
use Epaphrodites\controllers\controllers\dashboard;
use Epaphrodites\controllers\controllers\category;
use Epaphrodites\controllers\controllers\product;
use Epaphrodites\controllers\controllers\stock;
use Epaphrodites\controllers\controllers\client;
use Epaphrodites\controllers\controllers\entreprise;
use Epaphrodites\controllers\controllers\fournisseur;
use Epaphrodites\controllers\controllers\compte;
use Epaphrodites\controllers\controllers\commande;
use Epaphrodites\controllers\controllers\home;

trait controllerMap
{

    /**
     * Returns an instance of the 'main' controller.
     *
     * @return object An instance of the 'main' controller.
     */
    private function mainController():object
    {
        return new main;
    }    

    /**
     * Returns an array mapping controllers to their respective instances and methods.
     *
     * @return array The mapping of controllers with their instances and methods.
     */
    private function controllerMap(): array
    {
        return [
			'compte' => [ new compte, 'SwitchControllers', true , _DIR_ADMIN_TEMP_ ],
			'commande' => [ new commande, 'SwitchControllers', true , _DIR_ADMIN_TEMP_ ],
			'home' => [ new home, 'SwitchControllers', true , _DIR_ADMIN_TEMP_ ],
			'client' => [ new client, 'SwitchControllers', true , _DIR_ADMIN_TEMP_ ],
			'entreprise' => [ new entreprise, 'SwitchControllers', true , _DIR_ADMIN_TEMP_ ],
			'fournisseur' => [ new fournisseur, 'SwitchControllers', true , _DIR_ADMIN_TEMP_ ],
			'stock' => [ new stock, 'SwitchControllers', true , _DIR_ADMIN_TEMP_ ],
			'category' => [ new category, 'SwitchControllers', true , _DIR_ADMIN_TEMP_ ],
			'product' => [ new product, 'SwitchControllers', true , _DIR_ADMIN_TEMP_ ],
            "api" => [ new api, 'SwitchApiControllers', false ],
            "chats" => [ new chats, 'SwitchControllers', true, _DIR_ADMIN_TEMP_ ],
            "users" => [ new users, 'SwitchControllers', true, _DIR_ADMIN_TEMP_ ],
            "setting" => [ new setting, 'SwitchControllers', true, _DIR_ADMIN_TEMP_ ],
            "dashboard" => [ new dashboard, 'SwitchControllers' , true, _DIR_ADMIN_TEMP_ ],
        ];
    }
}

<?php

namespace Epaphrodites\controllers\controllerMap;

use Epaphrodites\controllers\controllers\api;
use Epaphrodites\controllers\controllers\main;
use Epaphrodites\controllers\controllers\users;
use Epaphrodites\controllers\controllers\chats;
use Epaphrodites\controllers\controllers\setting;
use Epaphrodites\controllers\controllers\dashboard;
use Epaphrodites\controllers\controllers\product;

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
			'product' => [ new product, 'SwitchControllers', true , _DIR_ADMIN_TEMP_ ],
			'product' => [ new product, 'SwitchControllers', true , _DIR_ADMIN_TEMP_ ],
            "api" => [ new api, 'SwitchApiControllers', false ],
            "chats" => [ new chats, 'SwitchControllers', true, _DIR_ADMIN_TEMP_ ],
            "users" => [ new users, 'SwitchControllers', true, _DIR_ADMIN_TEMP_ ],
            "setting" => [ new setting, 'SwitchControllers', true, _DIR_ADMIN_TEMP_ ],
            "dashboard" => [ new dashboard, 'SwitchControllers' , true, _DIR_ADMIN_TEMP_ ],
        ];
    }
}

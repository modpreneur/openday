<?php

namespace App;

use Nette;
use Nette\Application\Routers\Route;
use Nette\Application\Routers\RouteList;

/**
 * Class RouterFactory
 * @package App
 */
class RouterFactory
{
    use Nette\StaticClass;


    /**
     * @return Nette\Application\IRouter
     */
    public static function createRouter()
    {
        $router = new RouteList;

        $router[] = new Route('[<locale=cz cz|en>/]', 'Homepage:default');

        $router[] = new Route('[<locale=cs cs|en>/]<presenter>/<action>', "Homepage:");

        $router[] = new Route('[<locale=cz cz|en>/]list', 'Page:list');

        $router[] = new Route('[<locale=cz cz|en>/]remove[/<id>]', 'Page:remove');

        $router[] = new Route('[<locale=cz cz|en>/]edit[/<id>]', 'Page:edit');

        $router[] = new Route('[<locale=cz cz|en>/]<pageName>/', 'Page:page');


        return $router;
    }
}

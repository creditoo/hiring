<?php

namespace App;


use Find\Init\Initial;
/**
* 
*/
class Route extends Initial{

	protected function initRoutes(){
		$routes['find'] = array('routes' => '/dist/core', 'controller' =>'indexController', 'action' => 'find');
		$this->setRoutes($routes);
	} 
}
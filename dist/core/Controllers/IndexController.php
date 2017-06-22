<?php

namespace App\Controllers;

use Find\Controller\Action;
use Find\DI\APIContainer;

class IndexController extends Action{

	public function find(){	
		$url = "https://api.github.com/users/".$_POST['user_account'];
		$user = APIContainer::getModel("User");
		$this->view->user = json_decode($user->find($url));
		$this->render("user");		
	}
}
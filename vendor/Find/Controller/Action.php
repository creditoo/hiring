<?php

namespace Find\Controller;

abstract class Action{

	protected $view;
	private $action;

	public function __construct(){
		$this->view = new \stdClass;
	}

	protected function render($action,$layout = true){
		$this->action = $action;
		if($layout && file_exists("Views/layout.phtml")){
			include_once "Views/layout.phtml";
		}else{
			$this->content();
		}
	}

	protected function content(){		
		$current = get_class($this);
		$singleClassName = strtolower((str_replace("Controller","",str_replace("App\\Controllers\\","",$current))));
		include_once "Views/".$singleClassName."/".$this->action.".phtml";
	}

}
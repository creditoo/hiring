<?php

namespace Find\DI;


class APIContainer{
	public static function getModel($model){
		$class = "\\App\\Models\\".ucfirst($model);
		return new $class();
	}
}

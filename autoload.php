<?php

spl_autoload_register(
	function ($className)
	{
		include '.' . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $className) . '.php';
	});
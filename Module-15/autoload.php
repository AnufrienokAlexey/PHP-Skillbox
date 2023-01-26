<?php

function autoloader ($class)
{
	if (file_exists('entities/' . $class . '.php')) {
		include 'entities/' . $class . '.php';
	}

	if (file_exists('vendor/autoload.php')) {
		include 'vendor/autoload.php';
	}

}

spl_autoload_register('autoloader');


<?php

function autoloader ($class)
{
	if (file_exists('entities/' . $class . '.php')) {
		include 'entities/' . $class . '.php';
	}
}

spl_autoload_register('autoloader');


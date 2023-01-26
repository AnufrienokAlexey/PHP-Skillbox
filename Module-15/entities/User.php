<?php

require_once '../interfaces/LoggerInterface.php';
require_once '../interfaces/EventListenerInterface.php';

abstract class User {
	protected int $id;
	protected string $name, $role;

	abstract function getTextToEdit();
}
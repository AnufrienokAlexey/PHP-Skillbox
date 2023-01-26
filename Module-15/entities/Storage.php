<?php

require_once 'interfaces/LoggerInterface.php';
require_once 'interfaces/EventListenerInterface.php';

abstract class Storage implements LoggerInterface, EventListenerInterface {
	abstract function create(object $object);
	abstract function read($id, string $slug);
	abstract function update($id, string $slug, object $object);
	abstract function delete($id, string $slug);
	abstract function list();

	public function logMessage() {}
	public function lastMessages() {}
	public function attachEvent() {}
	public function detouchEvent() {}
}
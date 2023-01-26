<?php

namespace App\Models;

use App\Models\Helpers\Contracts\EventListenerInterface;
use App\Models\Helpers\Contracts\LoggerInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

require_once 'Helpers/Contracts/LoggerInterface.php';
require_once 'Helpers/Contracts/EventListenerInterface.php';

abstract class Storage extends Model implements LoggerInterface, EventListenerInterface
{
    use HasFactory;

    abstract function create(object $object);
    abstract function read($id, string $slug);
    abstract function updateObject(string $slug, object $object);
    abstract function deleteSlug(string $slug);
    abstract function list();

    public function logMessage() {}
    public function lastMessages() {}
    public function attachEvent() {}
    public function detouchEvent() {}

}

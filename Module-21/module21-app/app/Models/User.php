<?php

namespace App\Models;

use App\Models\Helpers\Contracts\EventListenerInterface;
use App\Models\Helpers\Contracts\LoggerInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

require_once 'Helpers/Contracts/LoggerInterface.php';
require_once 'Helpers/Contracts/EventListenerInterface.php';


abstract class User extends Model implements LoggerInterface, EventListenerInterface
{
    use HasFactory;

    protected int $id;
    protected string $name, $role;

    abstract function getTextToEdit();

}

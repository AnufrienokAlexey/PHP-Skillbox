<?php

namespace App\Models\Helpers\Contracts;

interface LoggerInterface
{
    public function logMessage();

    public function lastMessages();
}

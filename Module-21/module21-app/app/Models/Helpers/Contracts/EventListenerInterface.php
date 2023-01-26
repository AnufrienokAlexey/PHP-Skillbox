<?php

namespace App\Models\Helpers\Contracts;

interface EventListenerInterface
{
    public function attachEvent();

    public function detouchEvent();
}

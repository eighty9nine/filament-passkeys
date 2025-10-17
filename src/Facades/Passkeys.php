<?php

namespace EightyNine\Passkeys\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \EightyNine\Passkeys\Passkeys
 */
class Passkeys extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \EightyNine\Passkeys\Passkeys::class;
    }
}

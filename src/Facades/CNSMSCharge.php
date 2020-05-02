<?php

namespace Jacksonit\CNSMS\Facades;

use Illuminate\Support\Facades\Facade;

class CNSMSCharge extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'CNSMSCharge';
    }
}
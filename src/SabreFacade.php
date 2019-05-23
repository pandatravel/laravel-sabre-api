<?php

namespace Ammonkc\Sabre;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Ammonkc\Sabre\Skeleton\SkeletonClass
 */
class SabreFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'sabre';
    }
}

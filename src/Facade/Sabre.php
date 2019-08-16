<?php

namespace Ammonkc\Sabre\Facade;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Ammonkc\Sabre\Skeleton\SkeletonClass
 */
class Sabre extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return \Ammonkc\Sabre\Contracts\Sabre::class;
    }
}

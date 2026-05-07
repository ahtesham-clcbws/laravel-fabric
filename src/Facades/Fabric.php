<?php

namespace CLCBWS\Fabric\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \CLCBWS\Fabric\Contracts\FabricatorContract
 * @method static array build(string $modelClass, array $options = [])
 * @method static array introspect(string $modelClass)
 */
class Fabric extends Facade
{
    /**
     * Get the registered name of the component.
     */
    protected static function getFacadeAccessor(): string
    {
        return 'fabric';
    }
}

<?php

namespace CLCBWS\Fabric\Contracts;

interface FabricatorContract
{
    /**
     * Build the entire resource for a given model.
     */
    public function build(string $modelClass, array $options = []): array;
}

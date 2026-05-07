<?php

namespace CLCBWS\Fabric\Contracts;

interface LoomContract
{
    /**
     * Introspect a model and return its UI data contract.
     */
    public function introspect(string $modelClass): array;

    /**
     * Get foreign key relationships for the table.
     */
    public function getRelationships(string $table): array;
}

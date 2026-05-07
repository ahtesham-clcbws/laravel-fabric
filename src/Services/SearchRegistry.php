<?php

namespace CLCBWS\Fabric\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class SearchRegistry
{
    protected array $resources = [];
    protected array $actions = [];

    /**
     * Register a model as a searchable resource.
     */
    public function registerResource(string $model, string $route, string $icon = '📦', array $searchColumns = ['name', 'title'], string $group = 'Resources'): void
    {
        $this->resources[strtolower(\class_basename($model))] = [
            'model'   => $model,
            'route'   => $route,
            'icon'    => $icon,
            'columns' => $searchColumns,
            'group'   => $group,
        ];
    }

    /**
     * Register a quick action (e.g. "Create New Post").
     */
    public function registerAction(string $label, string $route, string $icon = '⚡', ?string $shortcut = null): void
    {
        $this->actions[] = [
            'label'    => $label,
            'route'    => $route,
            'icon'     => $icon,
            'shortcut' => $shortcut,
        ];
    }

    /**
     * Search across all registered resources and actions.
     */
    public function search(string $query): Collection
    {
        $results = collect();

        // 1. Search Actions
        foreach ($this->actions as $action) {
            if (\str_contains(\strtolower($action['label']), \strtolower($query))) {
                $results->push([
                    'title'       => $action['label'],
                    'description' => __('Quick Action'),
                    'route'       => $action['route'],
                    'icon'        => $action['icon'],
                    'type'        => 'action',
                ]);
            }
        }

        // 2. Search Resources (Models)
        foreach ($this->resources as $name => $config) {
            $model = $config['model'];
            
            // Search for the resource itself (navigation)
            if (\str_contains(\strtolower($name), \strtolower($query))) {
                $results->push([
                    'title'       => __('Manage ') . \Illuminate\Support\Str::plural($name),
                    'description' => __('Jump to resource list'),
                    'route'       => $config['route'],
                    'icon'        => $config['icon'],
                    'type'        => 'nav',
                ]);
            }

            // Perform deep search in the database
            $records = $model::query()
                ->where(function($q) use ($query, $config) {
                    foreach ($config['columns'] as $col) {
                        $q->orWhere($col, 'like', "%{$query}%");
                    }
                })
                ->limit(3)
                ->get();

            foreach ($records as $record) {
                $results->push([
                    'title'       => $record->{$config['columns'][0]} ?? $name . " #{$record->id}",
                    'description' => __('Result in ') . \Illuminate\Support\Str::plural($name),
                    'route'       => \str_replace('.index', '.show', $config['route']),
                    'params'      => ['record' => $record->id],
                    'icon'        => $config['icon'],
                    'type'        => 'record',
                ]);
            }
        }

        return $results;
    }

    public function getResources(): array
    {
        return $this->resources;
    }
}

<?php

declare(strict_types=1);

namespace CLCBWS\Fabric\Services\Concerns;

trait CompilesActivity
{
    /**
     * Compile a timeline for Spatie Activity Log.
     */
    protected function compileShowActivityLog(array $data): string
    {
        if (!($data['ecosystem']['activity'] ?? false)) {
            return "";
        }

        return "
                <div class=\"px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 border-t\">
                    <dt class=\"text-sm font-medium text-gray-900\">Activity History</dt>
                    <dd class=\"mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0\">
                        <ul role=\"list\" class=\"space-y-6\">
                            @foreach(\$record->activities()->latest()->take(10)->get() as \$activity)
                                <li class=\"relative flex gap-x-4\">
                                    <div class=\"absolute left-0 top-0 flex w-6 justify-center -bottom-6\">
                                        <div class=\"w-px bg-gray-200\"></div>
                                    </div>
                                    <div class=\"relative flex h-6 w-6 flex-none items-center justify-center bg-white\">
                                        <div class=\"h-1.5 w-1.5 rounded-full bg-gray-100 ring-1 ring-gray-300\"></div>
                                    </div>
                                    <p class=\"flex-auto py-0.5 text-xs leading-5 text-gray-500\">
                                        <span class=\"font-medium text-gray-900\">{{ \$activity->causer?->name ?? 'System' }}</span> 
                                        {{ \$activity->description }} 
                                        <span class=\"whitespace-nowrap\">{{ \$activity->created_at->diffForHumans() }}</span>
                                    </p>
                                </li>
                            @endforeach
                        </ul>
                    </dd>
                </div>";
    }
}

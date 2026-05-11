<?php

namespace CLCBWS\Fabric\Utils;

class TailwindCleaner
{
    protected static array $mapping = [
        // Layouts
        'tex4h da7vf uuht4' => 'grid grid-cols-1 md:grid-cols-2 gap-8',
        'xsmwa bax6l tex4h v74f4' => 'grid grid-cols-1 lg:grid-cols-2 gap-12',
        'grid grid-cols-1 md:grid-cols-3' => 'grid grid-cols-1 md:grid-cols-3 gap-6',
        
        // Typography
        'qcol8 c4t4j p50wb suamb hey6j' => 'text-4xl font-bold text-gray-800 sm:text-5xl lg:text-6xl dark:text-white',
        'fkl1d yymkp l3efg c4t4j' => 'mt-6 text-lg text-gray-600 dark:text-neutral-400',
        'a3olr i5qy2 lc836 yymkp f1ztf' => 'inline-block text-sm font-medium bg-clip-text text-transparent bg-linear-to-r from-blue-600 to-violet-600 uppercase tracking-wider',
        
        // Buttons
        'abuy9 aimp4 s6bei bnzaf inline-flex lp3ls items-center i220p offh6 text-[13px] h6qc0 edpyz bm0ff z0w76 mak94 dzdw5 cncwr wqd6j pnfdm focus:outline-hidden cw5w5 ja93f' => 'inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-lg shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-hidden focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all',
        
        // Inputs
        'peer rwnnd rrgib block w-full nck10 ijai8 edpyz rbu8c c4t4j kuo6g focus:outline-hidden jw8en u13cj' => 'peer block w-full py-3 px-4 border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400',
        
        // Containers
        'ei6q1 kgx4o m0lrh woryt relative nnhrf' => 'relative overflow-hidden bg-white dark:bg-neutral-900',
        'pn0si d8ttz w-full xxt8a cti9j gwqpr c4mnv lg:mx-auto' => 'max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8 py-20',
        
        // Minified garbage clean (Heuristic)
        'yymkp' => '',
        'c4t4j' => '',
        'lp3ls' => '',
        'edpyz' => '',
        'mak94' => '',
        'ijai8' => '',
        'dark:text-neutral-200' => 'dark:text-white',
        'dark:border-neutral-700' => 'dark:border-neutral-800',
    ];

    public static function clean(string $content): string
    {
        foreach (self::$mapping as $bad => $good) {
            if ($bad === '') continue;
            $content = str_replace($bad, $good, $content);
        }

        // Regex for cleaning single-character or short-minified classes left over
        // Only if they are inside a class="" attribute
        $content = preg_replace_callback('/class="([^"]+)"/', function($matches) {
            $classes = explode(' ', $matches[1]);
            $cleaned = array_filter($classes, function($c) {
                // Keep standard tailwind patterns (sm:, md:, lg:, dark:, hover:, [, ], -, numbers)
                // Filter out 5-character alphanumeric strings that don't have hyphens or colons
                if (strlen($c) === 5 && !str_contains($c, '-') && !str_contains($c, ':')) {
                    return false;
                }
                return strlen($c) > 0;
            });
            return 'class="' . implode(' ', array_unique($cleaned)) . '"';
        }, $content);

        return $content;
    }
}

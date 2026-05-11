<x-web-layout>
    <div class="max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8 py-24">
        <!-- Breadcrumb -->
        <nav class="mb-12" aria-label="Breadcrumb">
            <ol class="flex items-center space-x-2 text-sm text-gray-500">
                <li><a href="{{ route('fabric.docs.index') }}" class="hover:text-blue-600 transition-colors">Docs</a></li>
                <li><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 5l7 7-7 7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></li>
                <li><a href="{{ route('fabric.docs.template', $template) }}" class="hover:text-blue-600 transition-colors capitalize">{{ $template }}</a></li>
                <li><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 5l7 7-7 7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></li>
                <li class="font-medium text-gray-800 dark:text-neutral-200 capitalize">{{ $section }}</li>
            </ol>
        </nav>

        <!-- Common Fabric Assets for Preview -->
        <script src="{{ asset('vendor/fabric/common/js/preline.js') }}"></script>
        <script src="{{ asset('vendor/fabric/common/js/apexcharts.js') }}"></script>

        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800 dark:text-white capitalize">
                {{ str_replace('-', ' ', $section) }}
            </h1>
            <p class="text-gray-500 dark:text-neutral-500 mt-2">
                Template: <span class="text-gray-800 dark:text-neutral-200 font-medium">{{ $template }}</span>
            </p>
        </div>

        <!-- Playground Grid -->
        <div class="grid lg:grid-cols-3 gap-8">
            <!-- Preview Column -->
            <div class="lg:col-span-2">
                <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden dark:bg-neutral-900 dark:border-neutral-800">
                    <div class="p-4 border-b border-gray-200 dark:border-neutral-800 flex justify-between items-center bg-gray-50 dark:bg-neutral-800/50">
                        <div class="flex items-center space-x-3">
                            <span class="text-sm font-medium text-gray-800 dark:text-neutral-200">Live Preview</span>
                            <!-- Dark Mode Toggle -->
                            <button id="preview-dark-toggle" class="p-1 px-2 text-[10px] uppercase font-bold border border-gray-300 rounded-md hover:bg-gray-200 transition-all dark:border-neutral-700 dark:hover:bg-neutral-800 dark:text-neutral-400">
                                Toggle Dark Mode
                            </button>
                        </div>
                        <div class="flex space-x-2">
                            <span class="w-3 h-3 rounded-full bg-red-400"></span>
                            <span class="w-3 h-3 rounded-full bg-yellow-400"></span>
                            <span class="w-3 h-3 rounded-full bg-green-400"></span>
                        </div>
                    </div>
                    <div id="component-preview-container" class="min-h-[400px] bg-white p-4 transition-colors">
                        <!-- Dynamic Preview -->
                        @php
                            $stubPath = __DIR__ . "/../../../stubs/templates/{$template}/welcome.blade.php.stub";
                            $content = file_get_contents($stubPath);
                            
                            $startMarker = "<!-- {$section} -->";
                            $endMarker = "<!-- End {$section} -->";
                            
                            $startPos = strpos($content, $startMarker);
                            $endPos = strpos($content, $endMarker);
                            
                            if ($startPos !== false && $endPos !== false) {
                                $extracted = substr($content, $startPos, $endPos - $startPos + strlen($endMarker));
                                // Clean and resolve assets
                                $extracted = \CLCBWS\Fabric\Utils\TailwindCleaner::clean($extracted);
                                $extracted = str_replace(
                                    ['assets/', '../../assets/'],
                                    [asset("vendor/fabric/templates/{$template}/assets") . '/', asset("vendor/fabric/templates/{$template}/assets") . '/'],
                                    $extracted
                                );
                                echo $extracted;
                            } else {
                                echo "<div class='flex items-center justify-center h-full text-gray-500'>Preview markers not found.</div>";
                            }
                        @endphp
                    </div>
                </div>
            </div>

            <!-- Code/Actions Column -->
            <div class="space-y-6">
                <!-- Usage Card -->
                <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-6 dark:bg-neutral-900 dark:border-neutral-800">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-neutral-200 mb-4">Installation</h3>
                    <p class="text-sm text-gray-600 dark:text-neutral-400 mb-4">Run this command to extract this component into your project.</p>
                    <div class="bg-gray-100 p-3 rounded-lg dark:bg-neutral-800 mb-6">
                        <code class="text-sm text-blue-600 dark:text-blue-400">php artisan fabric:component {{ $template }}:{{ $section }}</code>
                    </div>

                    <h3 class="text-lg font-semibold text-gray-800 dark:text-neutral-200 mb-4">Blade Usage</h3>
                    <div class="bg-gray-100 p-3 rounded-lg dark:bg-neutral-800">
                        <code class="text-sm text-gray-800 dark:text-neutral-300">&lt;x-fabric.{{ $template }}.{{ $section }} /&gt;</code>
                    </div>
                </div>

                <!-- Template Context -->
                <div class="bg-blue-600 rounded-2xl p-6 text-white shadow-lg shadow-blue-600/20">
                    <h3 class="font-bold text-xl mb-2">Full Template</h3>
                    <p class="text-blue-100 text-sm mb-4">You can also generate the entire {{ $template }} site structure including all pages and routes.</p>
                    <div class="bg-white/10 p-2 rounded-lg text-xs font-mono mb-4">
                        php artisan fabric:site --template={{ $template }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('preview-dark-toggle').addEventListener('click', function() {
            const container = document.getElementById('component-preview-container');
            container.classList.toggle('dark');
            container.classList.toggle('bg-white');
            container.classList.toggle('bg-neutral-950');
        });
    </script>
</x-web-layout>

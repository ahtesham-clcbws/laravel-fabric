<div wire:ignore>
    <div id="{{ $chartId }}" style="min-height: {{ $height }};"></div>

    <script>
        document.addEventListener('livewire:navigated', () => {
            const options = {
                chart: {
                    type: '{{ $type }}',
                    height: '{{ $height }}',
                    toolbar: { show: false },
                    zoom: { enabled: false }
                },
                series: @json($series),
                ... @json($options)
            };

            const chart = new ApexCharts(document.querySelector("#{{ $chartId }}"), options);
            chart.render();

            $wire.on('chartUpdated', (newSeries) => {
                chart.updateSeries(newSeries);
            });
        }, { once: true });
    </script>
</div>

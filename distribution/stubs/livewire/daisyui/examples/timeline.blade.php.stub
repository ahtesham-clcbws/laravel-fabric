<ul class="timeline timeline-vertical">
    @foreach($events as $index => $event)
        <li>
            @if($index > 0) <hr /> @endif
            <div class="timeline-start text-sm opacity-60">{{ $event['date'] }}</div>
            <div class="timeline-middle text-{{ $event['color'] ?? 'primary' }}">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-5 w-5"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" /></svg>
            </div>
            <div class="timeline-end timeline-box shadow-md border-base-200">
                <div class="font-bold">{{ $event['title'] }}</div>
                <div class="text-sm text-base-content/70">{{ $event['description'] }}</div>
            </div>
            @if($index < count($events) - 1) <hr /> @endif
        </li>
    @endforeach
</ul>

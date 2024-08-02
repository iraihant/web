@props(['messages'])

@if ($messages)
<div id="dismiss" class="border bg-danger/10 text-danger border-danger/20 rounded px-4 py-2 flex justify-between items-center mb-2">
    <p>
        <ul>
            @foreach ((array) $messages as $message)
            <li>{{ $message }}</li>
        @endforeach
        </ul>
    </p>
</div>
@endif

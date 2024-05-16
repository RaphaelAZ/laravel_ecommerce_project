@php $color = $color ?? "red" @endphp

<div
    class="p-4 mb-4 text-sm text-{{ $color }}-800 rounded-lg bg-{{ $color }}-200 dark:bg-gray-800 dark:text-{{ $color }}-400 border border-{{ $color }}-700"
    role="alert">
    @if(isset($title))
        <span class="font-medium">{{ $title }}</span>
    @endif

    {{ $text }}
</div>

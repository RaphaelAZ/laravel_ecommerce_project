@if(!empty($label))
    <label
        class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"
        @if(isset($id)) for="{{ $id }}" @endif
    >
        {{ $label }}

        @if(isset($required) && (bool)$required===true)
            <span class="text-red-600">*</span>
        @endif
    </label>
@endif

<textarea
    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
    @if(isset($id)) id="{{ $id }}" @endif
    rows="{{ $rows ?? 4 }}"
    @if(!empty($name)) name="{{ $name }}" @endif
    @if(!empty($placeholder)) placeholder="{{ $placeholder }}" @endif
    @if(isset($required) && (bool)$required===true) required @endif
>{{ $value ?? "" }}</textarea>

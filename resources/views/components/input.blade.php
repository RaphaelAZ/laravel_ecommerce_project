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

<input
    class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 pe-10 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500  dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500"
    type="{{ $type ?? 'text' }}"
    @if(isset($id)) id="{{ $id }}" @endif
    @if(!empty($name)) name="{{ $name }}" @endif
    @if(!empty($placeholder)) placeholder="{{ $placeholder }}" @endif
    @if(isset($required) && (bool)$required===true) required @endif
/>

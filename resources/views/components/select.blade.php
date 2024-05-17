@if(!empty($label))
    <label
        @if(isset($id)) for="{{ $id }}" @endif
        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
    >
        {{ $label }}

        @if(isset($required) && (bool)$required===true)
            <span class="text-red-600">*</span>
        @endif
    </label>
@endif

<select
    class="bg-gray-50 border border-gray-300 text-gray-900 mb-6 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
    @if(isset($id)) id="{{ $id }}" @endif
    @if(!empty($name)) name="{{ $name }}" @endif
    @if(isset($required) && (bool)$required===true) required @endif
>
    @if(($authoriseEmpty ?? true) === true)
        <option
            value="__none__"
            @if(isset($selected) && !array_key_exists($selected, $options))
                selected
            @endif
        >
            Aucun
        </option>
    @endif

    @foreach($options as $key => $value)
        <option
            @if(isset($selected) && $selected==$key) selected="selected" @endif
            value="{{ $key }}"
        >
            {{ $value }}
        </option>
    @endforeach
</select>

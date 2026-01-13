<div
    x-data="{ value: @entangle($attributes->wire('model')) }"
    x-on:change="value = $event.target.value;"
    x-init="
        new Pikaday({
            field: $refs.input,
            format: 'DD/MM/YYYY',
            yearRange: [1968, 2030],
            minDate: new Date(),
            toString(date, format) {
                const day = date.getDate();
                const month = date.getMonth() + 1;
                const year = date.getFullYear();
                return `${day < 10 ? '0' + day : day}/${month < 10 ? '0' + month : month}/${year}`;
            }
        });
    " class="w-full">
    <div class="relative">
        <input {{$attributes->whereDoesntStartWith('wire:model')}}
            x-ref="input"
            x-bind:value="value"
            type="text"
            class="w-full pl-4 pr-10 py-2 leading-none rounded-lg shadow-sm focus:outline-none border-gray-300 text-gray-600 font-medium focus:ring focus:ring-blue-600 focus:ring-opacity-50"
        />
    </div>
</div>

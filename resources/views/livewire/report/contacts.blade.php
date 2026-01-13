<div class="grid flex-1 auto-cols-fr gap-y-8">
    <section class="fi-section rounded-xl bg-white shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10" id="data.datos-de-formulario">
        <header class="fi-section-header flex flex-col gap-3 px-6 py-4">
            <div class="flex items-center gap-3">
                <div class="grid flex-1 gap-y-1">
                    <h3 class="fi-section-header-heading text-base font-semibold leading-6 text-gray-950 dark:text-white">
                        Filtrar reporte
                    </h3>
                </div>
            </div>
        </header>

        <div class="fi-section-content-ctn border-t border-gray-200 dark:border-white/10">
            <div class="fi-section-content p-6">
                <div style="--cols-default: repeat(1, minmax(0, 1fr));" class="grid grid-cols-[--cols-default] fi-fo-component-ctn gap-6">
                    <div style="--col-span-default: 1 / -1;" class="col-[--col-span-default]">
                        <div>
                            <div style="--cols-default: repeat(1, minmax(0, 1fr)); --cols-sm: repeat(3, minmax(0, 1fr)); --cols-xl: repeat(12, minmax(0, 1fr)); --cols-2xl: repeat(12, minmax(0, 1fr));" class="grid grid-cols-[--cols-default] sm:grid-cols-[--cols-sm] xl:grid-cols-[--cols-xl] 2xl:grid-cols-[--cols-2xl] fi-fo-component-ctn gap-6">
                                <div style="--col-span-default: span 4 / span 4;" class="col-[--col-span-default]">
                                    <div data-field-wrapper="" class="fi-fo-field-wrp">
                                        <div class="grid gap-y-2">
                                            <div class="flex items-center justify-between gap-x-3 ">
                                                <label class="fi-fo-field-wrp-label inline-flex items-center gap-x-3" for="form_id">
                                                    <span class="text-sm font-medium leading-6 text-gray-950 dark:text-white">
                                                        Formulario<sup class="text-danger-600 dark:text-danger-400 font-medium">*</sup>
                                                    </span>
                                                </label>
                                            </div>
                                            <div class="grid gap-y-2">
                                                <div class="fi-input-wrp flex rounded-lg shadow-sm ring-1 transition duration-75 bg-white dark:bg-white/5 [&amp;:not(:has(.fi-ac-action:focus))]:focus-within:ring-2 ring-gray-950/10 dark:ring-white/20 [&amp;:not(:has(.fi-ac-action:focus))]:focus-within:ring-primary-600 dark:[&amp;:not(:has(.fi-ac-action:focus))]:focus-within:ring-primary-500 fi-fo-select">
                                                    <div class="min-w-0 flex-1">
                                                        <select class="fi-select-input block w-full border-none bg-transparent py-1.5 pe-8 text-base text-gray-950 transition duration-75 focus:ring-0 disabled:text-gray-500 disabled:[-webkit-text-fill-color:theme(colors.gray.500)] dark:text-white dark:disabled:text-gray-400 dark:disabled:[-webkit-text-fill-color:theme(colors.gray.400)] sm:text-sm sm:leading-6 [&amp;_optgroup]:bg-white [&amp;_optgroup]:dark:bg-gray-900 [&amp;_option]:bg-white [&amp;_option]:dark:bg-gray-900 ps-3" id="form_id" required="required" wire:model="form_id">
                                                            <option value="">Seleccione una opción</option>
                                                            @foreach($forms as $form)
                                                                <option value="{{$form['id']}}">{{$form['name']}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div style="--col-span-default: span 4 / span 4;" class="col-[--col-span-default]">
                                    <div data-field-wrapper="" class="fi-fo-field-wrp">
                                        <div class="grid gap-y-2">
                                            <div class="flex items-center justify-between gap-x-3 ">
                                                <label class="fi-fo-field-wrp-label inline-flex items-center gap-x-3" for="start_date">
                                                    <span class="text-sm font-medium leading-6 text-gray-950 dark:text-white">
                                                        Fecha de inicio
                                                    </span>
                                                </label>
                                            </div>
                                            <div class="grid gap-y-2">
                                                <div class="fi-input-wrp flex rounded-lg shadow-sm ring-1 transition duration-75 bg-white dark:bg-white/5 [&amp;:not(:has(.fi-ac-action:focus))]:focus-within:ring-2 ring-gray-950/10 dark:ring-white/20 [&amp;:not(:has(.fi-ac-action:focus))]:focus-within:ring-primary-600 dark:[&amp;:not(:has(.fi-ac-action:focus))]:focus-within:ring-primary-500 fi-fo-select">
                                                    <div class="min-w-0 flex-1">
                                                        <input class="fi-input block w-full border-none py-1.5 text-base text-gray-950 transition duration-75 placeholder:text-gray-400 focus:ring-0 disabled:text-gray-500 disabled:[-webkit-text-fill-color:theme(colors.gray.500)] disabled:placeholder:[-webkit-text-fill-color:theme(colors.gray.400)] dark:text-white dark:placeholder:text-gray-500 dark:disabled:text-gray-400 dark:disabled:[-webkit-text-fill-color:theme(colors.gray.400)] dark:disabled:placeholder:[-webkit-text-fill-color:theme(colors.gray.500)] sm:text-sm sm:leading-6 bg-white/0 ps-3 pe-3" id="start_date" required="required" type="date" wire:model="start_date">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div style="--col-span-default: span 4 / span 4;" class="col-[--col-span-default]">
                                    <div data-field-wrapper="" class="fi-fo-field-wrp">
                                        <div class="grid gap-y-2">
                                            <div class="flex items-center justify-between gap-x-3 ">
                                                <label class="fi-fo-field-wrp-label inline-flex items-center gap-x-3" for="end_date">
                                                    <span class="text-sm font-medium leading-6 text-gray-950 dark:text-white">
                                                        Fecha de fin
                                                    </span>
                                                </label>
                                            </div>
                                            <div class="grid gap-y-2">
                                                <div class="fi-input-wrp flex rounded-lg shadow-sm ring-1 transition duration-75 bg-white dark:bg-white/5 [&amp;:not(:has(.fi-ac-action:focus))]:focus-within:ring-2 ring-gray-950/10 dark:ring-white/20 [&amp;:not(:has(.fi-ac-action:focus))]:focus-within:ring-primary-600 dark:[&amp;:not(:has(.fi-ac-action:focus))]:focus-within:ring-primary-500 fi-fo-select">
                                                    <div class="min-w-0 flex-1">
                                                        <input class="fi-input block w-full border-none py-1.5 text-base text-gray-950 transition duration-75 placeholder:text-gray-400 focus:ring-0 disabled:text-gray-500 disabled:[-webkit-text-fill-color:theme(colors.gray.500)] disabled:placeholder:[-webkit-text-fill-color:theme(colors.gray.400)] dark:text-white dark:placeholder:text-gray-500 dark:disabled:text-gray-400 dark:disabled:[-webkit-text-fill-color:theme(colors.gray.400)] dark:disabled:placeholder:[-webkit-text-fill-color:theme(colors.gray.500)] sm:text-sm sm:leading-6 bg-white/0 ps-3 pe-3" id="end_date" required="required" type="date" wire:model="end_date">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="fi-form-actions">
        <div class="fi-ac gap-3 flex flex-wrap items-center justify-start">
            <button style="--c-400:var(--primary-400);--c-500:var(--primary-500);--c-600:var(--primary-600);" class="fi-btn relative grid-flow-col items-center justify-center font-semibold outline-none transition duration-75 focus-visible:ring-2 rounded-lg fi-color-custom fi-btn-color-primary fi-color-primary fi-size-md fi-btn-size-md gap-1.5 px-3 py-2 text-sm inline-grid shadow-sm bg-custom-600 text-white hover:bg-custom-500 focus-visible:ring-custom-500/50 dark:bg-custom-500 dark:hover:bg-custom-400 dark:focus-visible:ring-custom-400/50 fi-ac-action fi-ac-btn-action" type="button" wire:loading.attr="disabled" wire:click="process">
                Generar reporte
            </button>
            @if(count($contacts) > 0)
                <button wire:click.prevent="export" style="--c-400:var(--success-400);--c-500:var(--success-500);--c-600:var(--success-600);" class="fi-btn relative grid-flow-col items-center justify-center font-semibold outline-none transition duration-75 focus-visible:ring-2 rounded-lg fi-color-custom fi-btn-color-primary fi-color-primary fi-size-md fi-btn-size-md gap-1.5 px-3 py-2 text-sm inline-grid shadow-sm bg-custom-600 text-white hover:bg-custom-500 focus-visible:ring-custom-500/50 dark:bg-custom-500 dark:hover:bg-custom-400 dark:focus-visible:ring-custom-400/50 fi-ac-action fi-ac-btn-action" type="button" wire:loading.attr="disabled" wire:click="export">
                    Exportar en Excel
                </button>
            @endif
        </div>
    </div>
    @if(empty($contacts))
        <div class="fi-ta-content relative divide-y divide-gray-200 overflow-x-auto dark:divide-white/10 dark:border-t-white/10 !border-t-0">
            <div class="fi-ta-empty-state px-6 py-12">
                <div class="fi-ta-empty-state-content mx-auto grid max-w-lg justify-items-center text-center">
                    <div class="fi-ta-empty-state-icon-ctn mb-4 rounded-full bg-gray-100 p-3 dark:bg-gray-500/20">
                        <svg class="fi-ta-empty-state-icon h-6 w-6 text-gray-500 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"></path>
                        </svg>
                    </div>
                    <h4 class="fi-ta-empty-state-heading text-base font-semibold leading-6 text-gray-950 dark:text-white">
                        No se encontraron registros
                    </h4>
                </div>
            </div>
        </div>
    @else
        <div class="fi-ta-ctn divide-y divide-gray-200 overflow-hidden rounded-xl bg-white shadow-sm ring-1 ring-gray-950/5 dark:divide-white/10 dark:bg-gray-900 dark:ring-white/10">
            <div class="fi-ta-content relative divide-y divide-gray-200 overflow-x-auto dark:divide-white/10 dark:border-t-white/10 !border-t-0">
                <table class="fi-ta-table w-full table-auto divide-y divide-gray-200 text-start dark:divide-white/5">
                    <thead class="divide-y divide-gray-200 dark:divide-white/5">
                    <tr class="bg-gray-50 dark:bg-white/5">
                        @foreach($fields as $field)
                            @if($field['type'] !== \App\Concerns\Enums\Types::SEPARATOR_TITLE->value)
                            <th class="fi-ta-header-cell px-3 py-3.5 sm:first-of-type:ps-6 sm:last-of-type:pe-6 fi-table-header-cell-name">
                                <span class="group flex w-full items-center gap-x-1 whitespace-nowrap justify-start">
                                    <span class="fi-ta-header-cell-label text-sm font-semibold text-gray-950 dark:text-white">{{$field['name']}}</span>
                                </span>
                            </th>
                            @endif
                        @endforeach
                        <th class="fi-ta-header-cell px-3 py-3.5 sm:first-of-type:ps-6 sm:last-of-type:pe-6 fi-table-header-cell-name">
                            <span class="group flex w-full items-center gap-x-1 whitespace-nowrap justify-start">
                                <span class="fi-ta-header-cell-label text-sm font-semibold text-gray-950 dark:text-white">Fecha de registro</span>
                            </span>
                        </th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 whitespace-nowrap dark:divide-white/5">
                    @foreach($contacts as $contact)
                        <tr class="fi-ta-row [@media(hover:hover)]:transition [@media(hover:hover)]:duration-75 hover:bg-gray-50 dark:hover:bg-white/5">
                            @foreach($contact['fields'] as $item)
                                @isset($item['field'])
                                    @if($item['field']['type'] !== \App\Concerns\Enums\Types::SEPARATOR_TITLE->value)
                                        <td class="fi-ta-cell p-0 first-of-type:ps-1 last-of-type:pe-1 sm:first-of-type:ps-3 sm:last-of-type:pe-3 fi-table-cell-name" wire:key="7j3Dr5QDCawVlt5PmjnE.table.record.1.column.name">
                                            <div class="fi-ta-col-wrp">
                                                <div class="fi-ta-text grid w-full gap-y-1 px-3 py-4">
                                                    <div class="flex ">
                                                        <div class="flex max-w-max">
                                                            <div class="fi-ta-text-item inline-flex items-center gap-1.5">
                                                                @if(
                                                                    $item['field']['type'] === \App\Concerns\Enums\Types::TEXT->value ||
                                                                    $item['field']['type'] === \App\Concerns\Enums\Types::EMAIL->value ||
                                                                    $item['field']['type'] === \App\Concerns\Enums\Types::COUNTRY->value ||
                                                                    $item['field']['type'] === \App\Concerns\Enums\Types::SELECT->value ||
                                                                    $item['field']['type'] === \App\Concerns\Enums\Types::PRODUCT_SELECT->value ||
                                                                    $item['field']['type'] === \App\Concerns\Enums\Types::DNI->value ||
                                                                    $item['field']['type'] === \App\Concerns\Enums\Types::RUC->value ||
                                                                    $item['field']['type'] === \App\Concerns\Enums\Types::CELLPHONE->value ||
                                                                    $item['field']['type'] === \App\Concerns\Enums\Types::TEXTAREA->value)
                                                                    <span class="fi-ta-text-item-label text-sm leading-6 text-gray-950 dark:text-white">{{$item['value']}}</span>
                                                                @endif
                                                                @if($item['field']['type'] === \App\Concerns\Enums\Types::CHECKBOX->value)
                                                                    <span class="fi-ta-text-item-label text-sm leading-6 text-gray-950 dark:text-white">{{($item['value'] === '0' ? 'No' : 'Si')}}</span>
                                                                @endif
                                                                @if($item['field']['type'] === \App\Concerns\Enums\Types::DATE->value)
                                                                    <span class="fi-ta-text-item-label text-sm leading-6 text-gray-950 dark:text-white">{{date("d/m/Y", strtotime($item['value']))}}</span>
                                                                @endif
                                                                @if($item['field']['type'] === \App\Concerns\Enums\Types::FILE->value)
                                                                    <a target="_blank" class="underline fi-ta-text-item-label text-sm leading-6 text-gray-950 dark:text-white" href="{{url($item['value'])}}">Descargar</a>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    @endif
                                @else
                                    <td>-</td>
                                @endisset
                            @endforeach
                            <td>{{date("d/m/Y H:i", strtotime($contact['created_at']))}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
</div>

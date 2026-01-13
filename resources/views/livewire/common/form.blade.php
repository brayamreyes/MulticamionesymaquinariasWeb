<div class="sm:py-10 py-5 bg-[--bg] space-y-10">
    <div class="container relative z-20">
        <div class="py-12 rounded-2xl {{ $data['in_container'] ? 'bg-[#D4D4D4] sm:px-10 px-5' : '' }}">
            @isset($data['title'])
                <h1 class="text-primary text-2xl">{{$data['title']}}</h1>
            @endisset
            @isset($data['sub_title'])
                <p class="text-sm text-primary">{{$data['sub_title']}}</p>
            @endisset
            <form wire:submit.prevent="process">
                <div class="max-sm:flex max-sm:flex-col sm:grid grid-cols-12 gap-x-6 gap-y-3 mt-5">
                    @foreach($fields as $f => $field)
                        @php
                            $field_idx = 'form_data.' . $field['slug'];
                        @endphp
                        @if($field['show'])
                            <div style="--col-span-default: span {{$field['size']}} / span {{$field['size']}};" class="w-full col-[--col-span-default]@error($field_idx) is-invalid @enderror">
                                @if($field['type'] === \App\Concerns\Enums\Types::TEXT->value)
                                    <input type="text" placeholder="{{$field['name']}}{{($field['required'] ? '*' : '')}}" name="name" id="name" wire:model.blur="{{'form_data.' . $field['slug']}}" class="form-input" />
                                @endif
                                @if($field['type'] === \App\Concerns\Enums\Types::EMAIL->value)
                                    <input type="text" placeholder="{{$field['name']}}{{($field['required'] ? '*' : '')}}" name="name" id="name" wire:model="{{'form_data.' . $field['slug']}}" class="form-input" />
                                @endif
                                @if($field['type'] === \App\Concerns\Enums\Types::CELLPHONE->value)
                                    <input type="text" placeholder="{{$field['name']}}{{($field['required'] ? '*' : '')}}" name="name" id="name" wire:model="{{'form_data.' . $field['slug']}}" class="form-input" />
                                @endif
                                @if($field['type'] === \App\Concerns\Enums\Types::DNI->value)
                                    <input type="text" placeholder="{{$field['name']}}{{($field['required'] ? '*' : '')}}" name="name" id="name" wire:model="{{'form_data.' . $field['slug']}}" class="form-input" />
                                @endif
                                @if($field['type'] === \App\Concerns\Enums\Types::RUC->value)
                                    <input type="text" placeholder="{{$field['name']}}{{($field['required'] ? '*' : '')}}" name="name" id="name" wire:model="{{'form_data.' . $field['slug']}}" class="form-input" />
                                @endif
                                @if($field['type'] === \App\Concerns\Enums\Types::DATE->value)
                                    <x-inputs.date wire:model.live="{{'form_data.' . $field['slug']}}" id="datepicker" autocomplete="off" placeholder="{{$field['name']}}{{($field['required'] ? '*' : '')}}" />
                                @endif
                                @if($field['type'] === \App\Concerns\Enums\Types::TEXTAREA->value)
                                    <textarea class="form-textarea" wire:model="{{'form_data.' . $field['slug']}}" placeholder="{{$field['name']}}{{($field['required'] ? '*' : '')}}"></textarea>
                                @endif
                                @if($field['type'] === \App\Concerns\Enums\Types::CHECKBOX->value)
                                    <div class="form-check">
                                        <input type="checkbox" name="{{'form_data.' . $field['slug']}}" class="form-check-input" id="{{'form_data.' . $field['slug']}}" wire:model.live="{{'form_data.' . $field['slug']}}">
                                        @php
                                            $check_label = $field['name'];
                                            if (count($field['link']) > 0) {
                                                if (isset($field['link'][0]['initial_text'])) {
                                                    $check_label = $field['link'][0]['initial_text'];
                                                }
                                                if (isset($field['link'][0]['text'])) {
                                                    $check_label .= ' <a href="' . $field['link'][0]['url'] . '" target="_blank" class="text-secondary underline">' . $field['link'][0]['text'] . '</a>';
                                                }
                                            }
                                        @endphp
                                        <label class="text-[#656565]" for="{{'form_data.' . $field['slug']}}">{!! $check_label !!}{{($field['required'] ? '*' : '')}}</label>
                                    </div>
                                @endif
                                @if($field['type'] === \App\Concerns\Enums\Types::FILE->value)
                                    <label for="{{$field['slug']}}" class="block text-sm font-medium leading-6 text-primary">{{$field['name']}}{{($field['required'] ? '*' : '')}}</label>
                                    <div class="flex justify-center border border-dashed border-gray bg-white px-6 py-4">
                                        <div class="text-center">
                                            <div class="flex text-sm leading-6">
                                                <label for="{{$field['slug']}}" class="relative cursor-pointer rounded-md font-semibold text-gray focus-within:outline-none focus-within:ring-none focus-within:ring-offset-2">
                                                    <span>Cargar archivo</span>
                                                    <input id="{{$field['slug']}}" name="{{$field['slug']}}" wire:model="{{'form_data.' . $field['slug']}}" type="file" class="sr-only" accept=".pdf,.jpg,.jpeg,.png">
                                                </label>
                                                <p class="pl-1 text-primary">o arrástralo y suéltalo</p>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                @if($field['type'] === \App\Concerns\Enums\Types::SELECT->value)
                                    <select wire:model="{{'form_data.' . $field['slug']}}" name="product" id="product">
                                        <option value="">{{$field['name']}}{{($field['required'] ? '*' : '')}}</option>
                                        @foreach($field['options'] as $option)
                                            <option value="{{$option}}">{{$option}}</option>
                                        @endforeach
                                    </select>
                                @endif
                                @if($field['type'] === \App\Concerns\Enums\Types::COUNTRY->value)
                                    <select wire:model="{{'data.' . $field['slug']}}" name="product" id="product" required>
                                        <option value="">{{$field['name']}}{{($field['required'] ? '*' : '')}}</option>
                                        @foreach($countries as $c => $country)
                                            <option value="{{$c}}">{{$c}}</option>
                                        @endforeach
                                    </select>
                                @endif
                                @if($field['type'] === \App\Concerns\Enums\Types::PRODUCT_SELECT->value)
                                    <select wire:model="{{'data.' . $field['slug']}}" name="product" id="product" required>
                                        <option value="">{{$field['name']}}{{($field['required'] ? '*' : '')}}</option>
                                        @foreach($products as $product)
                                            <option value="{{$product['name']}}">{{$product['name']}}</option>
                                        @endforeach
                                    </select>
                                @endif
                                @if($field['type'] === \App\Concerns\Enums\Types::SEPARATOR_TITLE->value)
                                    <h5 class="font-semibold text-primary{{$f > 0 ? ' mt-3' : ''}} ">{{$field['name']}}</h5>
                                @endif
                                @error($field_idx) <span class="validation-error">{{ $message }}</span> @enderror
                            </div>
                        @endif
                    @endforeach
                    <div class="col-span-full">
                        <button type="submit" class="btn btn-secondary">{{$form['text_button']}}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <x-modal name="confirm-status">
        <x-slot:body>
            <div>
                <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-green-100">
                    <svg class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                    </svg>
                </div>
                <div class="mt-3 text-center sm:mt-5">
                    <h3 class="text-base font-semibold leading-6 text-gray-900" id="modal-title">{{$form['thanks_message'][0]['title']}}</h3>
                    <div class="mt-2">
                        {!! $form['thanks_message'][0]['content'] !!}
                    </div>
                </div>
            </div>
            <div class="mt-5 sm:mt-6 flex justify-center">
                <button type="button" class="btn btn-primary sm:px-10 px-6" x-data x-on:click="$dispatch('close-modal')">{{$form['thanks_message'][0]['text_button']}}</button>
            </div>
        </x-slot:body>
    </x-modal>
</div>

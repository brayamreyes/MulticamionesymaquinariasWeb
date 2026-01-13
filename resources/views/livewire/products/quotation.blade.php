<div>
    <div class="flex flex-col lg:flex-row h-auto bg-gray-600 max-lg:container max-lg:py-10 max-lg:gap-4">
        <div class="flex items-center gap-5 lg:gap-16 justify-start !ml-auto lg:px-16 w-full md:max-w-[50.5rem]">
            <div class="flex flex-col space-y-3 max-w-sm w-full">
                @if($product->brand->image)
                    <img class="max-w-[83px] w-full object-cover" src="{{url('storage/web/' . $product->brand->image)}}" alt="{{$product->brand->name}}">
                @else
                    <img class="max-w-[83px] w-full object-cover" src="https://fakeimg.pl/83x83/?text=marca" alt="">
                @endif
                <div class="flex justify-between">
                    <div>
                        <div class="flex flex-col w-full">
                            @if($product->type)
                                <p class="text-sm text-gray font-bold">{{ $product->type }}</p>
                            @endif
                            <p class="text-primary font-bold text-3xl">{{ $product->name }}</p>
                        </div>
                        <div class="flex flex-col space-y-1 *:text-[#6B6B6B] *:text-xs">
                            <p>Año: {{ $product->year_manufacture }}</p>
                            <p>Kilometraje: {{ $product->mileage }}</p>
                            <p>Horas: {{ $product->hours }}</p>
                        </div>
                    </div>
                    <div class="flex flex-col mt-6">
                        <p class="text-3xl font-bold text-primary">${{ number_format($product->dollar_final_price, 2) }}</p>
                        <p class="text-lg font-bold text-gray">S/{{ number_format($product->pen_final_price, 2) }}</p>
                    </div>
                </div>
            </div>
        </div>
        @if($product->image_2)
            <img class="w-full max-w-[814px] object-cover" src="{{url('storage/web/' . $product->image_2)}}" alt="{{$product->name}}">
        @else
            <img class="w-full max-w-[814px] object-cover" src="https://fakeimg.pl/814x400/?text=imagen" alt="{{$product->name}}">
        @endif
    </div>

    <div class="container py-10 lg:py-20 space-y-8 snap-start">
        <form wire:submit.prevent="process">
            <h1 class="text-primary text-3xl mb-2">¡Muy buena elección!</h1>
            <p class="text-primary">Por favor, completa tus datos y un asesor se comunicará contigo lo más pronto posible.</p>
            <div class="grid sm:grid-cols-12 gap-x-6 gap-y-3 mt-5">
                <div class="w-full col-span-6 @error('data.first_name') is-invalid @enderror">
                    <input type="text" placeholder="Nombre*" name="first_name" id="first_name" wire:model.live="data.first_name" class="form-input" />
                    @error('data.first_name') <span class="validation-error">{{ $message }}</span> @enderror
                </div>

                <div class="w-full col-span-6 @error('data.last_name') is-invalid @enderror">
                    <input type="text" placeholder="Apellidos*" name="last_name" id="last_name" wire:model.live="data.last_name" class="form-input" />
                    @error('data.last_name') <span class="validation-error">{{ $message }}</span> @enderror
                </div>

                <div class="w-full col-span-3 @error('data.dni') is-invalid @enderror">
                    <input type="text" placeholder="DNI*" name="dni" id="dni" wire:model.live="data.dni" class="form-input" />
                    @error('data.dni') <span class="validation-error">{{ $message }}</span> @enderror
                </div>

                <div class="w-full col-span-3 @error('data.ruc') is-invalid @enderror">
                    <input type="text" placeholder="RUC*" name="ruc" id="ruc" wire:model.live="data.ruc" class="form-input" />
                    @error('data.ruc') <span class="validation-error">{{ $message }}</span> @enderror
                </div>

                <div class="w-full col-span-6 @error('data.business_name') is-invalid @enderror">
                    <input type="text" placeholder="Razón social*" name="business_name" id="business_name" wire:model.live="data.business_name" class="form-input" />
                    @error('data.business_name') <span class="validation-error">{{ $message }}</span> @enderror
                </div>

                <div class="w-full col-span-6 @error('data.phone') is-invalid @enderror">
                    <input type="text" placeholder="Número de celular*" name="phone" id="phone" wire:model.live="data.phone" class="form-input" />
                    @error('data.phone') <span class="validation-error">{{ $message }}</span> @enderror
                </div>

                <div class="w-full col-span-6 @error('data.email') is-invalid @enderror">
                    <input type="text" placeholder="Correo electrónico*" name="email" id="email" wire:model.live="data.email" class="form-input" />
                    @error('data.email') <span class="validation-error">{{ $message }}</span> @enderror
                </div>

                <div class="w-full col-span-12 mt-6">
                    <div class="form-check">
                        <input type="checkbox" name="accept_privacy_policy" class="form-check-input" id="accept_privacy_policy" wire:model.live="data.accept_privacy_policy">
                        <label class="text-[#656565]" for="accept_privacy_policy">He leído y acepto la Política de Privacidad de Protección de Datos Personales</label>
                    </div>
                    @error('data.accept_privacy_policy') <span class="validation-error">{{ $message }}</span> @enderror
                </div>

                <div class="w-full col-span-12 mt-3">
                    <button type="submit" class="btn btn-secondary">Cotizar ahora</button>
                </div>
            </div>
        </form>
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
                    <h3 class="text-base font-semibold leading-6 text-gray-900" id="modal-title">Cotización registrada</h3>
                    <div class="mt-2">
                        Su cotización ha sido registrada con éxito. Muy pronto un asesor se pondrá en contacto con usted.
                    </div>
                </div>
            </div>
            <div class="mt-5 sm:mt-6 flex justify-center">
                <button type="button" class="btn btn-primary sm:px-10 px-6" x-data x-on:click="$dispatch('close-modal')">Aceptar</button>
            </div>
        </x-slot:body>
    </x-modal>
</div>

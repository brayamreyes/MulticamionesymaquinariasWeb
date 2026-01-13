<div style="--bg: {{$data['background']}};" class="sm:py-5 bg-[--bg]">
    <div class="sm:container relative z-20">
        <div class="bg-primary px-10 py-7 sm:rounded shadow sm:grid grid-cols-12 sm:-mt-[4.6rem] mt-0 gap-5 sm:space-y-0 space-y-3 items-center">
            <div class="col-span-3">
                <select class="!h-full" wire:change.prevent="change_category" wire:model="category_id">
                    <option>Equipo</option>
                    @foreach($categories as $category)
                        <option value="{{$category['id']}}">{{$category['name']}}</option>
                    @endforeach
                </select>
            </div>
            <div class="sm:col-span-3 col-span-6">
                <select class="!h-full" wire:change.prevent="change_brand" wire:model="brand_id">
                    <option>Marca</option>
                    @foreach($brands as $brand)
                        <option value="{{$brand['id']}}">{{$brand['name']}}</option>
                    @endforeach
                </select>
            </div>
            <div class="sm:col-span-3 col-span-6">
                <select class="!h-full" wire:model="model_id">
                    <option>Modelo</option>
                    @foreach($models as $model)
                        <option value="{{$model}}">{{$model}}</option>
                    @endforeach
                </select>
            </div>
            <div class="sm:col-span-3 col-span-6">
                <button type="button" wire:click.prevent="process" class="btn btn-secondary !w-full">Buscar</button>
            </div>
        </div>
    </div>
</div>

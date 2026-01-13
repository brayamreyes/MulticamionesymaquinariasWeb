@aware(['data'])
<div class="flex flex-col items-center justify-center gap-4 lg:gap-8 py-10 px-6 lg:p-10 max-w-4xl mx-auto">
    @foreach($data['general_specifications'] as $key => $element)
        <div class="relative border-b border-gray-200 w-full"  x-data="{selected:  null }">
            <button type="button" class="w-full lg:px-8 py-3 text-left flex items-center justify-between" @click="selected !== 1 ? selected = 1 : selected = null">
                <p class="text-lg text-gray">{{ $element['title'] }}</p>
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M10 0C4.48615 0 0 4.48615 0 10C0 15.5138 4.48615 20 10 20C15.5138 20 20 15.5138 20 10C20 4.48615 15.5138 0 10 0ZM10 1.53846C14.6823 1.53846 18.4615 5.31769 18.4615 10C18.4615 14.6823 14.6823 18.4615 10 18.4615C5.31769 18.4615 1.53846 14.6823 1.53846 10C1.53846 5.31769 5.31769 1.53846 10 1.53846ZM9.23077 5.38462V9.23077H5.38462V10.7692H9.23077V14.6154H10.7692V10.7692H14.6154V9.23077H10.7692V5.38462H9.23077Z" fill="#326BD6"/>
                </svg>
            </button>
            <div class="relative overflow-hidden transition-all max-h-0 duration-700" style="" x-ref="container1" x-bind:style="selected == 1 ? 'max-height: ' + $refs.container1.scrollHeight + 'px' : ''">
                @foreach($element['items'] as $key => $item)
                    <div class="p-3 flex justify-between max-w-2xl mx-auto *:text-gray">
                        <p>{{ $item['Nombre'] }}</p>
                        <p>{{ $item['Valor'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach
</div>

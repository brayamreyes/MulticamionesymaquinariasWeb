@aware(['data'])

<section class="bg-gray-600">
    <div class="lg:container">
        <div class="flex flex-col lg:flex-row justify-center items-center">
            <img src="{{ url('storage/web/' . $data['image']) }}" class="w-full lg:w-1/2 h-full min-h-[300px] max-h-[600px] lg:h-[600px] object-cover object-center max-lg:order-2" alt="{{ $data['title'] }}">
            <div class="flex flex-col max-lg:container max-lg:py-10 lg:p-12 justify-center items-start space-y-2 divide-y divide-gray-700">
                <div class="flex flex-col space-y-2">
                    <p class="text-primary text-2xl">{{ $data['title'] }}</p>
                    <p class="text-gray text-start text-sm">{{ $data['text'] }}</p>
                </div>
                <div class="flex flex-col items-center justify-center w-full" x-data="{selected:1}">
                    <div x-data="{selected:null}" class="w-full divide-y divide-gray-700">
                        @foreach($data['items'] as $key => $item)
                            <div class="relative border-b border-gray-200 w-full">
                                <button type="button" class="w-full px-6 py-3 text-left flex items-center justify-between" @click="selected !== ({{ $key }} + 1) ? (selected = {{ $key }} + 1, $refs.container.forEach(container => { container.style.maxHeight = null }), $refs.container{{ $key }}.style.maxHeight = $refs.container{{ $key }}.scrollHeight + 'px') : selected = null">
                                    <p class="text-secondary">{{ $item['title'] }}</p>
                                    <svg x-show="selected !== ({{ $key }} + 1)" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M10 0C4.48615 0 0 4.48615 0 10C0 15.5138 4.48615 20 10 20C15.5138 20 20 15.5138 20 10C20 4.48615 15.5138 0 10 0ZM10 1.53846C14.6823 1.53846 18.4615 5.31769 18.4615 10C18.4615 14.6823 14.6823 18.4615 10 18.4615C5.31769 18.4615 1.53846 14.6823 1.53846 10C1.53846 5.31769 5.31769 1.53846 10 1.53846ZM9.23077 5.38462V9.23077H5.38462V10.7692H9.23077V14.6154H10.7692V10.7692H14.6154V9.23077H10.7692V5.38462H9.23077Z" fill="#326BD6"/>
                                    </svg>
                                    <svg x-show="selected === ({{ $key }} + 1)" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M10 0C4.48615 0 0 4.48615 0 10C0 15.5138 4.48615 20 10 20C15.5138 20 20 15.5138 20 10C20 4.48615 15.5138 0 10 0ZM10 1.53846C14.6823 1.53846 18.4615 5.31769 18.4615 10C18.4615 14.6823 14.6823 18.4615 10 18.4615C5.31769 18.4615 1.53846 14.6823 1.53846 10C1.53846 5.31769 5.31769 1.53846 10 1.53846ZM5.38462 9.23077V10.7692H14.6154V9.23077H5.38462Z" fill="#326BD6"/>
                                    </svg>
                                </button>
                                <div class="relative overflow-hidden transition-all max-h-0 duration-700" x-ref="container{{ $key }}" x-bind:style="selected == ({{ $key }} + 1) ? 'max-height: ' + $refs.container{{ $key }}.scrollHeight + 'px' : ''">
                                        <div class="py-1 px-6 flex max-w-2xl mx-auto [&>*>li]:list-disc *:text-xs *:text-gray">
                                            {!! $item['content'] !!}
                                        </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

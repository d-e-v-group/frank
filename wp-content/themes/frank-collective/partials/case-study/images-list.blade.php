@if(get_field('images_list'))
    @foreach((array)get_field('images_list') as $image)
        <div data-appear-fade-in>
            <div class="img-hold">
                {{ helper::image($image['image'], 'full') }}
                @if($image['caption'])
                    <p>{{ $image['caption'] }}</p>
                @endif
            </div>
        </div>
    @endforeach
@endif
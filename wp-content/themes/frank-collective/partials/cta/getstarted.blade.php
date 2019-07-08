@if(get_field('get_started_enable') && get_field('get_started_enable') !== 'none')
    @include('partials/cta/'.get_field('get_started_enable'))
@endif
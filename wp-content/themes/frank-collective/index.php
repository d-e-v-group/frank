@if( ! is_404() )

@include('views/articles')

@else

@include('views/404')

@endif
@layout('layouts/master')
<?php /* Template Name: Home 2020*/ ?>
@section('body-class', 'page-homepage')
@section('content')
<?php while ( have_posts() ) : the_post(); ?>
<div class="root barba-container" data-namespace="homepage" data-page-id="Homepage" data-transition-in="homepage_in" data-transition-out="homepage_out" data-page-init="homepage_init">
    <div class="hp-slider">
        <div class="content" >
            <div class="container">
            @if( have_rows('slide_module'))
                while ( have_rows('slide_module') ) : the_row();    
                    <div>client name: {{ get_sub_field('client_name') }}</div>
                @endwhile
            @endif
            </div>
        </div>
    </div>
</div>
<?php endwhile; ?>
@endsection


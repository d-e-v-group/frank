@layout('layouts/master')
@section('content')
<?php while ( have_posts() ) : the_post(); ?>
<div class="root barba-container" data-namespace="default" data-page-id="Default" data-transition-in="default_in" data-transition-out="default_out" data-page-init="default_init">
    <div class="main default-content">
        <section class="general-content-block container">
            <div class="grid">
                <div class="col-sm-10 col-sm-offset-1 col-md-6 col-md-offset-3">
                    @if(get_field('image'))
                        <div class="featured-image" >
                            {{ helper::image(get_field('image'), 'full') }}
                        </div>
                    @elseif(has_post_thumbnail())
                    <div class="featured-image" >
                            {{ helper::image(get_post_thumbnail_id(), 'full') }}
                        </div>
                    @endif
                    <div data-big-header>
                        <h2>{{ get_field('position') }}</h2>
                    </div>
                    <div data-appear-block>
	                    <?php $term_obj_list = get_the_terms( get_the_ID(), 'city' );?>
                        @if($term_obj_list)
                            <h5>{{ $term_obj_list[0]->name }}</h5>
                        @endif
                        @if(get_field('content'))
                        {{ get_field('content') }}
                        @else
                        {{ the_content() }}
                        @endif
                        <a href="/careers" class="link-u">Back to Careers</a>
                    </div>
                </div>
            </div>
        </section>
    </div>
    @include('partials/cta/contact')
</div>
<?php endwhile ?>
@endsection
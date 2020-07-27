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
                        <h2>{{ get_the_title() }}</h2>
                    </div>
                    <div data-appear-block>
                        @if(get_field('content'))
                        {{ get_field('content') }}
                        @else
                        {{ the_content() }}
                        @endif
                        @if(get_post_type() == 'blog')
                        <a href="/blog" class="link-u">Back to Blog</a>
                        @else
                        <a href="/articles" class="link-u">Back to Articles</a>
                        @endif

                    </div>
                </div>
            </div>
        </section>
    </div>
    @include('partials/cta/contact')
</div>
<?php endwhile ?>
@endsection
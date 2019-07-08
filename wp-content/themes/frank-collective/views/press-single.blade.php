@layout('layouts/master')
@section('content')
<?php while ( have_posts() ) : the_post(); ?>
<div class="root barba-container" data-namespace="default" data-page-id="Default" data-transition-in="default_in" data-transition-out="default_out" data-page-init="default_init">
    <div class="main default-content">
        <section class="general-content-block container">
            <div class="grid">
                <div class="col-sm-10 col-sm-offset-1 col-md-6 col-md-offset-3">
                    <div data-big-header>
                    <h3>{{ get_the_title() }}</h3>
                    </div>
                    <div data-appear-block>
                    <time>{{ get_field('date') }}</time>
                    {{ get_field('content') }}
                    </div>
                    <a href="/press" class="link-u">Back to Press</a>
                </div>
            </div>
        </section>
    </div>
    @include('partials/cta/contact')
</div>
<?php endwhile ?>
@endsection
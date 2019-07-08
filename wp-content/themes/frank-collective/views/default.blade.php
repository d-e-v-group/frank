@layout('layouts/master')
@section('content')
<?php while ( have_posts() ) : the_post(); ?>
<div class="root barba-container" data-namespace="default" data-page-id="Default" data-transition-in="default_in" data-transition-out="default_out" data-page-init="default_init">
    <div class="main default-content">
        <section class="general-content-block container">
            <div class="grid">
                <div class="col-md-6">
                    <h2>{{ get_the_title() }}</h2>
                    {{ the_content() }}
                </div>
            </div>
        </section>
    </div>
    @include('partials/cta/contact')
</div>
<?php endwhile ?>
@endsection
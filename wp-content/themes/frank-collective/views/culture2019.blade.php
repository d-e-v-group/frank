@layout('layouts/master')
<?php /* Template Name: Culture 2019 */ ?>
@section('content')
<?php while ( have_posts() ) : the_post(); ?>
<div class="root" class="culutre-v2-page" data-page-id="Culture" data-namespace="culture" data-transition-in="culture_2_in" data-transition-out="culture_2_out" data-page-init="culture_2_init">
    <div class="culture-wrap">
      <section id="culture-main" data-nav-dark data-dark>
        <div class="culture-message">
          <?php if (get_field('main_text')): ?>
            <h1><?php the_field('main_text'); ?></h1>
          <?php endif; ?>  
        
          <?php if (get_field('secondary_text')): ?>
            <?php the_field('secondary_text'); ?>
          <?php endif; ?>  

          <?php if (get_field('jobs_text')): ?>
            <h3><?php the_field('jobs_text'); ?></h3>
          <?php endif; ?>          

          <a href="#" class="jobs-link">jobs@frankcollective.com</a>
        </div>


        <?php $numb = 0; ?>
        <div class="culture-images">
            @if(get_field('images'))
                @foreach((array) get_field('images') as $item)
                <?php $numb++; ?>
                <div class="culture-image img-<?php echo $numb; ?>">{{ helper::image($item['image'], 'full') }}</div>
                @endforeach
            @endif
        </div>
      </section>
    </div>
    @include('partials/cta/contact')
    @include('partials/modal')
</div>
<?php endwhile; ?>
@endsection